<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'Karachi', 'country_id' => 1],
            ['name' => 'Lahore', 'country_id' => 1],
            ['name' => 'New York', 'country_id' => 2],
            ['name' => 'Los Angeles', 'country_id' => 2],
            ['name' => 'Mumbai', 'country_id' => 3],
            ['name' => 'Delhi', 'country_id' => 3],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
