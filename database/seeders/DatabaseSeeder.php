<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@shaheq.com',
            'password' => bcrypt('password'),
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@shaheq.com',
            'password' => bcrypt('password'),
        ]);

        // Run other seeders
        $this->call([
            TripSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
