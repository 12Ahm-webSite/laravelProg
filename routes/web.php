<?php use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\FrontController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\LanguageController;
 
// Language Switching Route
Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Frontend Routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/destinations', [FrontController::class, 'destinations'])->name('destinations');
Route::get('/experiences', [FrontController::class, 'experiences'])->name('experiences');
Route::get('/booking', [FrontController::class, 'booking'])->name('booking');
Route::get('/stories', [FrontController::class, 'stories'])->name('stories');
Route::get('/guides', [FrontController::class, 'guides'])->name('guides');

// Trip Routes - REORDERED
Route::get('/my-trip/{slug}/book', [FrontController::class, 'showBookingFormBySlug'])->name('trip.book.slug'); // MOVED UP
Route::get('/trip/{id}', [FrontController::class, 'showTrip'])->name('trip.show');
Route::get('/search', [FrontController::class, 'searchTrips'])->name('trips.search');
Route::get('/category/{categoryId}', [FrontController::class, 'getTripsByCategory'])->name('trips.category');

// Booking Routes - FIXED ORDER
Route::get('/trip/{tripId}/book', [FrontController::class, 'showBookingForm'])->name('trip.book'); 
Route::get('/trip/{bookingId}/book/steps', [FrontController::class, 'showBookingSteps'])->name('trip.book.steps'); 
Route::post('/trip/{tripId}/book', [FrontController::class, 'bookTrip'])->name('trip.book.submit'); 
Route::post('/booking/{bookingId}/confirmation', [FrontController::class, 'submitBookingConfirmation'])->name('booking.confirmation.submit');
Route::get('/booking/{bookingId}/confirmation', [FrontController::class, 'showBookingConfirmation'])->name('booking.confirmation'); 
Route::get('/my-bookings', [FrontController::class, 'showMyBookings'])->name('my.bookings');
Route::post('/booking/{bookingId}/cancel', [FrontController::class, 'cancelBooking'])->name('booking.cancel');
// API Routes for AJAX 
Route::get('/api/featured-trips', [FrontController::class, 'getFeaturedTrips'])->name('api.featured-trips'); 
Route::get('/api/upcoming-trips', [FrontController::class, 'getUpcomingTrips'])->name('api.upcoming-trips'); 
Route::get('/api/booking/{bookingId}', [FrontController::class, 'getBookingDetails'])->name('api.booking.details'); 
Route::get('/api/trip/{tripId}/availability', [FrontController::class, 'checkTripAvailability'])->name('api.trip.availability'); 
Route::post('/api/trip/{tripId}/calculate-total', [FrontController::class, 'calculateBookingTotal'])->name('api.trip.calculate-total');


/*
|--------------------------------------------------------------------------
| Breeze / Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// auth scaffolding routes
require __DIR__.'/auth.php';
