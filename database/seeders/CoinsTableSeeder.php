<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the coins table
        DB::table('coins')->insert([
            'price_in_pkr' => 1000.00,        // Price of one coin in PKR
            'equivalence' => 1,               // Number of coins per unit
            'free_coins' => 100,              // Sample free coins (for testing purposes)
            'featured_ad_rate' => 50,         // Sample featured ad rate (for testing purposes)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
