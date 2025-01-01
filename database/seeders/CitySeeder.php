<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            // Pakistan
            ['name' => 'Karachi', 'country_id' => 1],
            ['name' => 'Lahore', 'country_id' => 1],
            ['name' => 'Islamabad', 'country_id' => 1],
            ['name' => 'Rawalpindi', 'country_id' => 1],
            // United States
            ['name' => 'New York', 'country_id' => 2],
            ['name' => 'Los Angeles', 'country_id' => 2],
            ['name' => 'Chicago', 'country_id' => 2],
            ['name' => 'Houston', 'country_id' => 2],
            // India
            ['name' => 'Mumbai', 'country_id' => 3],
            ['name' => 'Delhi', 'country_id' => 3],
            ['name' => 'Bangalore', 'country_id' => 3],
            ['name' => 'Hyderabad', 'country_id' => 3],
            // United Kingdom
            ['name' => 'London', 'country_id' => 4],
            ['name' => 'Manchester', 'country_id' => 4],
            ['name' => 'Birmingham', 'country_id' => 4],
            ['name' => 'Liverpool', 'country_id' => 4],
            // Canada
            ['name' => 'Toronto', 'country_id' => 5],
            ['name' => 'Vancouver', 'country_id' => 5],
            ['name' => 'Montreal', 'country_id' => 5],
            ['name' => 'Calgary', 'country_id' => 5],
            // Australia
            ['name' => 'Sydney', 'country_id' => 6],
            ['name' => 'Melbourne', 'country_id' => 6],
            ['name' => 'Brisbane', 'country_id' => 6],
            ['name' => 'Perth', 'country_id' => 6],
            // Germany
            ['name' => 'Berlin', 'country_id' => 7],
            ['name' => 'Munich', 'country_id' => 7],
            ['name' => 'Hamburg', 'country_id' => 7],
            ['name' => 'Frankfurt', 'country_id' => 7],
            // France
            ['name' => 'Paris', 'country_id' => 8],
            ['name' => 'Marseille', 'country_id' => 8],
            ['name' => 'Lyon', 'country_id' => 8],
            ['name' => 'Toulouse', 'country_id' => 8],
            // China
            ['name' => 'Beijing', 'country_id' => 9],
            ['name' => 'Shanghai', 'country_id' => 9],
            ['name' => 'Guangzhou', 'country_id' => 9],
            ['name' => 'Shenzhen', 'country_id' => 9],
            // Japan
            ['name' => 'Tokyo', 'country_id' => 10],
            ['name' => 'Osaka', 'country_id' => 10],
            ['name' => 'Kyoto', 'country_id' => 10],
            ['name' => 'Sapporo', 'country_id' => 10],
            // Brazil
            ['name' => 'São Paulo', 'country_id' => 11],
            ['name' => 'Rio de Janeiro', 'country_id' => 11],
            ['name' => 'Salvador', 'country_id' => 11],
            ['name' => 'Brasília', 'country_id' => 11],
            // South Africa
            ['name' => 'Cape Town', 'country_id' => 12],
            ['name' => 'Johannesburg', 'country_id' => 12],
            ['name' => 'Durban', 'country_id' => 12],
            ['name' => 'Pretoria', 'country_id' => 12],
            // Mexico
            ['name' => 'Mexico City', 'country_id' => 13],
            ['name' => 'Guadalajara', 'country_id' => 13],
            ['name' => 'Monterrey', 'country_id' => 13],
            ['name' => 'Cancún', 'country_id' => 13],
            // Russia
            ['name' => 'Moscow', 'country_id' => 14],
            ['name' => 'Saint Petersburg', 'country_id' => 14],
            ['name' => 'Novosibirsk', 'country_id' => 14],
            ['name' => 'Yekaterinburg', 'country_id' => 14],
            // Italy
            ['name' => 'Rome', 'country_id' => 15],
            ['name' => 'Milan', 'country_id' => 15],
            ['name' => 'Naples', 'country_id' => 15],
            ['name' => 'Turin', 'country_id' => 15],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
