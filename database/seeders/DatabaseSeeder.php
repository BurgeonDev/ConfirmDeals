<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class, // Optional: Only if you're using Spatie
            UserSeeder::class,

            CategorySeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            LocalitySeeder::class,
            AdSeeder::class,
        ]);
    }
}
