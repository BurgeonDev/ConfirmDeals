<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;

class AdSeeder extends Seeder
{
    public function run()
    {
        Ad::create([
            'title' => 'Premium Sofa Set',
            'description' => 'A luxurious 7-seater sofa set in excellent condition.',
            'type' => 'product',
            'is_verified' => true,
            'pictures' => json_encode(['sofa1.jpg', 'sofa2.jpg']),
            'price' => 25000,
            'country_id' => 1,
            'city_id' => 2,
            'locality_id' => 1,
            'coins_needed' => 50,
            'category_id' => 1,
            'user_id' => 1,
        ]);

        Ad::create([
            'title' => 'House Cleaning Service',
            'description' => 'Professional house cleaning services with a team of experienced cleaners.',
            'type' => 'service',
            'is_verified' => false,
            'pictures' => json_encode(['cleaning1.jpg']),
            'price' => 1000,
            'country_id' => 1,
            'city_id' => 2,
            'locality_id' => 2,
            'coins_needed' => 20,
            'category_id' => 1,
            'user_id' => 1,
        ]);
    }
}
