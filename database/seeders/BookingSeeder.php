<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\TripReview;
use App\Models\User;
use App\Models\Trip;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users and trips
        $users = User::all();
        $trips = Trip::all();

        if ($users->isEmpty() || $trips->isEmpty()) {
            return;
        }

        // Create sample bookings
        $bookings = [
            [
                'trip_id' => $trips->first()->id,
                'user_id' => $users->first()->id,
                'participants_count' => 2,
                'total_amount' => 900.00,
                'booking_date' => Carbon::now()->subDays(5),
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'notes' => 'رحلة مميزة، نتطلع إليها',
                'emergency_contact' => [
                    'name' => 'أحمد محمد',
                    'phone' => '0501234567'
                ],
                'special_requirements' => ['وجبات نباتية', 'غرفة منفصلة']
            ],
            [
                'trip_id' => $trips->skip(1)->first()->id,
                'user_id' => $users->count() > 1 ? $users->skip(1)->first()->id : $users->first()->id,
                'participants_count' => 1,
                'total_amount' => 350.00,
                'booking_date' => Carbon::now()->subDays(3),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'bank_transfer',
                'notes' => 'أول تجربة غطس',
                'emergency_contact' => [
                    'name' => 'فاطمة علي',
                    'phone' => '0507654321'
                ],
                'special_requirements' => null
            ],
            [
                'trip_id' => $trips->skip(2)->first()->id,
                'user_id' => $users->first()->id,
                'participants_count' => 3,
                'total_amount' => 1800.00,
                'booking_date' => Carbon::now()->subDays(1),
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'notes' => 'رحلة عائلية',
                'emergency_contact' => [
                    'name' => 'محمد السعد',
                    'phone' => '0509876543'
                ],
                'special_requirements' => ['أطفال', 'وجبات خاصة']
            ]
        ];

        foreach ($bookings as $bookingData) {
            $booking = Booking::create($bookingData);
            
            // Update trip bookings count
            $trip = $booking->trip;
            $trip->increment('total_bookings');
        }

        // Create sample reviews
        $reviews = [
            [
                'trip_id' => $trips->first()->id,
                'user_id' => $users->first()->id,
                'rating' => 5,
                'comment' => 'رحلة رائعة وممتازة، الدليل محترف جداً والخدمات ممتازة. أنصح بها بشدة!',
                'is_approved' => true,
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'trip_id' => $trips->skip(1)->first()->id,
                'user_id' => $users->count() > 1 ? $users->skip(1)->first()->id : $users->first()->id,
                'rating' => 4,
                'comment' => 'تجربة غطس جميلة، المياه صافية والشعاب المرجانية رائعة. سأكرر التجربة.',
                'is_approved' => true,
                'created_at' => Carbon::now()->subDays(1)
            ],
            [
                'trip_id' => $trips->first()->id,
                'user_id' => $users->count() > 1 ? $users->skip(1)->first()->id : $users->first()->id,
                'rating' => 5,
                'comment' => 'أفضل رحلة تسلق قمت بها، المناظر خلابة والتنظيم ممتاز.',
                'is_approved' => true,
                'created_at' => Carbon::now()->subHours(12)
            ]
        ];

        foreach ($reviews as $reviewData) {
            TripReview::create($reviewData);
        }

        // Update trip ratings
        foreach ($trips as $trip) {
            $avgRating = TripReview::where('trip_id', $trip->id)
                                 ->where('is_approved', true)
                                 ->avg('rating');
            
            if ($avgRating) {
                $trip->update(['rating' => round($avgRating, 1)]);
            }
        }
    }
}
