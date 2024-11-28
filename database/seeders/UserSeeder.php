<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a default admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Replace with a secure password
            'is_active' => true,
            'is_email_verified' => true,
            'coins' => 0,
            'rating' => 0,
            'profession_id' => null, // If professions are not yet assigned
            'role' => 'SuperAdmin', // Ensure the role field supports this value
        ]);

        // Optionally, if you're using Spatie Roles & Permissions
        if (method_exists($admin, 'assignRole')) {
            $admin->assignRole('SuperAdmin');
        }

        echo "Admin user created: Email: admin@example.com, Password: password\n";
    }
}
