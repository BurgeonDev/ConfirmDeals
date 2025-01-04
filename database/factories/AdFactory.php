<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    protected $model = Ad::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['product', 'service']),
            'status' => $this->faker->randomElement(['verified', 'cancel', 'expired', 'pending']),
            'pictures' => json_encode([$this->faker->imageUrl(640, 480, 'business', true, 'Ad')]),
            'price' => $this->faker->numberBetween(500, 50000),
            'country_id' => $this->faker->numberBetween(1, 3),
            'city_id' => $this->faker->numberBetween(1, 5),
            'locality_id' => $this->faker->numberBetween(1, 5),
            'coins_needed' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 3),
            'is_featured' => $this->faker->boolean, // Generate a random boolean (0 or 1)
            'days_featured' => $this->faker->optional()->numberBetween(1, 30), // Optional field, can be null
            'featured_until' => $this->faker->optional()->dateTimeBetween('now', '+30 days'), // Optional field
        ];
    }
}
