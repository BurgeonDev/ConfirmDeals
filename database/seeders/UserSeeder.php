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
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_active' => true,
                'is_email_verified' => true,
                'coins' => 10,
                'rating' => 0,
                'profession_id' => null, // Hashed password
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
