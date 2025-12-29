<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Booking;
use App\Models\TripCategory;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $featuredTrips = Trip::where('is_featured', true)
                           ->where('is_active', true)
                           ->take(6)
                           ->get();
        
        $recentTrips = Trip::where('is_active', true)
                          ->latest()
                          ->take(3)
                          ->get();

        $monthtrips = Trip::whereYear('start_date', now()->year)
                          ->whereMonth('start_date', now()->month)
                          ->where('is_active', true)
                          ->orderBy('start_date')
                          ->get();
             
        
             
        
        $categories = TripCategory::where('is_active', true)->get();
        
        return view('index', compact('featuredTrips', 'recentTrips', 'categories', 'monthtrips'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        $stats = [
            'total_trips' => Trip::where('is_active', true)->count(),
            'total_guides' => Guide::where('is_active', true)->count(),
            'total_bookings' => Booking::count(),
            'total_categories' => TripCategory::where('is_active', true)->count(),
        ];
        
        return view('about', compact('stats'));
    }

    /**
     * Display the destinations page
     */
    public function destinations()
    {
        $trips = Trip::with('category')
                    ->where('is_active', true)
                    ->paginate(12);
        
        $categories = TripCategory::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->get();
        
        return view('destinations', compact('trips', 'categories'));
    }

    /**
     * Display the experiences page
     */
    public function experiences()
    {
        $trips = Trip::where('type', 'experience')
                    ->where('is_active', true)
                    ->paginate(12);
        
        $categories = TripCategory::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->get();
        
        return view('experiences', compact('trips', 'categories'));
    }

    /**
     * Display the booking page
     */
    public function booking()
    {
        $trips = Trip::where('start_date', '>=', now())
                    ->where('is_active', true)
                    ->orderBy('start_date')
                    ->take(6)
                    ->get();
        return view('booking', compact('trips'));
    }

    /**
     * Show booking form for a specific trip
     */
    public function showBookingForm($tripId)
    {
        $trip = Trip::with(['category', 'guide'])->findOrFail($tripId);

        if (!$trip->isAvailableForBooking()) {
            return redirect()->back()->with('error', 'هذه الرحلة غير متاحة للحجز حالياً');
        }

        return view('booking-form', compact('trip'));
    }

    /**
     * Show booking form for a specific trip by slug
     */
    public function showBookingFormBySlug($slug)
    {
     
        // Add debug to see if we reach here
        try {
            $trip = Trip::where('slug', $slug)->first();
                   
            // Check if the view exists
            if (!view()->exists('booking-form')) {
                \Log::error('Booking form view does not exist');
                return response()->json(['error' => 'View not found'], 500);
            }
            
            return view('booking-form', compact('trip'));
            
        } catch (\Exception $e) {
            \Log::error('Error in showBookingFormBySlug:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show multi-step booking form
     */

     public function bookTrip(Request $request, $tripId)
    {
        $trip = Trip::findOrFail($tripId);

        // Validate basic info
        $request->validate([
            'participant_name'  => 'required|string|max:255',
            'participant_email' => 'required|email|max:255',
            'participant_phone' => 'required|string|max:20',
            'notes'             => 'nullable|string|max:1000',
        ]);


        if (!$trip->isAvailableForBooking()) {
            return redirect()->back()->with('error', 'هذه الرحلة غير متاحة للحجز حالياً');
        }

        // Get or create user
        $userId = auth()->id();

        if (!$userId) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => $request->participant_email],
                [
                    'name' => $request->participant_name,
                    'password' => bcrypt('temp_password_' . time()),
                    'phone_number' => $request->participant_phone,
                ]
            );
            $userId = $user->id;
            \Log::info('User created:', ['user_id' => $userId]);
        }

        // Create booking with pending status
        $booking = Booking::create([
            'trip_id'         => $trip->id,
            'user_id'         => $userId,
            'phone_number'    => $request->participant_phone,
            'participants_count' => 1,
            'total_amount'    => $trip->price,
            'booking_date'    => now(),
            'status'          => 'pending',
            'payment_status'  => 'pending',
            'payment_method'  => 'pending',
            'notes'           => $request->notes,
        ]);

        // Increment trip bookings
        $trip->incrementBookings();

        return redirect()->route('trip.book.steps', ['bookingId' => $booking->id])
            ->with([
                'success' => 'تم حفظ بياناتك. برجاء اختيار طريقة الدفع لإكمال الحجز.',
                'booking_id' => $booking->id,
                'trip_id' => $trip->id
            ]);
    }

    public function showBookingSteps($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $trip = $booking->trip;
        $user = $booking->user;
        
        return view('booking-steps', compact('booking', 'trip', 'user'));
    }

    // POST - حفظ بيانات الدفع وتحديث حالة الحجز
    public function submitBookingConfirmation(Request $request, $bookingId)
    {
        $booking = Booking::with(['trip.category', 'trip.guide', 'user'])
            ->findOrFail($bookingId);

        // Validate payment method
        $request->validate([
            'payment_method' => 'required|in:visa,mada,paypal,apple_pay,tabby,tamara,bank_transfer',
        ]);

        // Update booking with payment details
        $booking->update([
            'payment_method' => $request->payment_method,
            'status'         => 'confirmed',
            'payment_status' => 'pending',
        ]);

        // TODO: send confirmation email to user

        // Redirect للعرض
        return redirect()->route('booking.confirmation', $booking->id)
            ->with('success', 'تم إرسال طلب الحجز بنجاح. سنتواصل معك قريباً لتأكيد الحجز.');
    }


    // GET - عرض صفحة التأكيد بعد التحديث
    public function showBookingConfirmation($bookingId)
    {
        $booking = Booking::with(['trip.category', 'trip.guide', 'user'])
            ->findOrFail($bookingId);

        return view('booking-confirmation', compact('booking'));
    }


    public function showMyBookings()
    {
        if (!auth()->check()) {
            return redirect()->route('home')->with('error', 'يجب تسجيل الدخول لعرض حجوزاتك');
        }

        $bookings = Booking::with(['trip.category', 'trip.guide'])
                         ->where('user_id', auth()->id())
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        return view('my-bookings', compact('bookings'));
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Check if user owns this booking or is admin
        if (auth()->check() && $booking->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بإلغاء هذا الحجز');
        }

        // Check if booking can be cancelled
        if ($booking->status === 'cancelled') {
            return redirect()->back()->with('error', 'هذا الحجز مُلغى بالفعل');
        }

        if ($booking->status === 'completed') {
            return redirect()->back()->with('error', 'لا يمكن إلغاء حجز مكتمل');
        }

        // Update booking status
        $booking->update([
            'status' => 'cancelled',
            'payment_status' => 'refunded'
        ]);

        // Decrement trip bookings count
        $booking->trip->decrementBookings();

        return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
    }

    /**
     * Display the stories page
     */
    public function stories()
    {
        $trips = Trip::where('has_story', true)
                    ->where('is_active', true)
                    ->paginate(9);
        
        $featuredStory = Trip::where('has_story', true)
                            ->where('is_active', true)
                            ->where('is_featured', true)
                            ->first();
        
        return view('stories', compact('trips', 'featuredStory'));
    }

    /**
     * Display the guides page
     */
    public function guides()
    {
        $guides = Guide::where('is_active', true)->get();
        return view('guides', compact('guides'));
    }

    /**
     * Display a specific trip
     */
    public function showTrip($id)
    {
        $trip = Trip::with(['category', 'guide', 'reviews.user'])
                   ->where('is_active', true)
                   ->findOrFail($id);
        
        $relatedTrips = Trip::where('category_id', $trip->category_id)
                           ->where('id', '!=', $id)
                           ->where('is_active', true)
                           ->take(3)
                           ->get();
        
        return view('trip-details', compact('trip', 'relatedTrips'));
    }

    /**
     * Search trips
     */
    public function searchTrips(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $priceRange = $request->get('price_range');
        
        $trips = Trip::where('is_active', true);
        
        if ($query) {
            $trips->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%");
            });
        }
        
        if ($category) {
            $trips->where('category_id', $category);
        }
        
        if ($priceRange) {
            switch ($priceRange) {
                case 'low':
                    $trips->where('price', '<=', 500);
                    break;
                case 'medium':
                    $trips->whereBetween('price', [500, 1000]);
                    break;
                case 'high':
                    $trips->where('price', '>=', 1000);
                    break;
            }
        }
        
        $trips = $trips->with('category')->paginate(12);
        
        return view('search-results', compact('trips', 'query', 'category', 'priceRange'));
    }

    /**
     * Get featured trips for homepage (API)
     */
    public function getFeaturedTrips()
    {
        $trips = Trip::where('is_featured', true)
                    ->where('is_active', true)
                    ->take(6)
                    ->get();
        
        return response()->json($trips);
    }

    /**
     * Get trips by category
     */
    public function getTripsByCategory($categoryId)
    {
        $trips = Trip::where('category_id', $categoryId)
                    ->where('is_active', true)
                    ->paginate(12);
        
        $categories = TripCategory::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->get();
        
        return view('destinations', compact('trips', 'categories'));
    }

    /**
     * Get upcoming trips (API)
     */
    public function getUpcomingTrips()
    {
        $trips = Trip::where('start_date', '>=', now())
                    ->where('is_active', true)
                    ->orderBy('start_date')
                    ->take(6)
                    ->get();
        
        return response()->json($trips);
    }


    /**
     * Get booking details for AJAX
     */
    public function getBookingDetails($bookingId)
    {
        $booking = Booking::with(['trip.category', 'trip.guide'])
                         ->findOrFail($bookingId);

        return response()->json([
            'booking' => $booking,
            'trip' => $booking->trip,
            'total_amount_formatted' => number_format($booking->total_amount, 0) . ' ريال'
        ]);
    }

    /**
     * Check trip availability for AJAX
     */
    public function checkTripAvailability($tripId)
    {
        $trip = Trip::findOrFail($tripId);
        
        return response()->json([
            'available' => $trip->isAvailableForBooking(),
            'remaining_spots' => $trip->remaining_spots,
            'max_participants' => $trip->max_participants,
            'price' => $trip->price,
            'formatted_price' => $trip->formatted_price
        ]);
    }

    /**
     * Calculate booking total for AJAX
     */
    public function calculateBookingTotal(Request $request, $tripId)
    {
        $trip = Trip::findOrFail($tripId);
        $participantsCount = $request->get('participants_count', 1);
        
        if ($participantsCount < 1 || $participantsCount > $trip->max_participants) {
            return response()->json(['error' => 'عدد المشاركين غير صحيح'], 400);
        }

        $totalAmount = $trip->price * $participantsCount;
        
        return response()->json([
            'total_amount' => $totalAmount,
            'formatted_total' => number_format($totalAmount, 0) . ' ريال',
            'price_per_person' => $trip->price,
            'formatted_price_per_person' => $trip->formatted_price,
            'participants_count' => $participantsCount
        ]);
    }

}
