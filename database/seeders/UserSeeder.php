<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{


    public function run()
    {
        // Create the first user (Admin with ID 1)
        $adminUser = User::updateOrCreate(
            ['id' => 1], // Ensure user with ID 1
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_active' => true,
                'is_email_verified' => true,
                'coins' => 100,
                'rating' => 0,
                'phone_number' => '234-2342-563',
                'profession_id' => 1,
                'country_id' => 1,
                'city_id' => 1,
                'locality_id' => 1,
            ]
        );

        // Automatically assign the "Admin" role to user with ID 1
        if ($adminUser) {
            $adminUser->assignRole('SuperAdmin');
        }

        // Create additional random users
        User::factory(5)->create();
    }
}
