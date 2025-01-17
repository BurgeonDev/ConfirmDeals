<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'coins' => '500',
            // 'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password
            // 'remember_token' => Str::random(10),
        ];
    }
}
