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
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
