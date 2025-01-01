<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Pakistan'],
            ['name' => 'United States'],
            ['name' => 'India'],
            ['name' => 'United Kingdom'],
            ['name' => 'Canada'],
            ['name' => 'Australia'],
            ['name' => 'Germany'],
            ['name' => 'France'],
            ['name' => 'China'],
            ['name' => 'Japan'],
            ['name' => 'Brazil'],
            ['name' => 'South Africa'],
            ['name' => 'Mexico'],
            ['name' => 'Russia'],
            ['name' => 'Italy'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
