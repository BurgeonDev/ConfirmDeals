<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CoinsTableSeeder::class,
            ProfessionsSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            LocalitySeeder::class,
            UserSeeder::class,
            AdSeeder::class,

        ]);
    }
}
