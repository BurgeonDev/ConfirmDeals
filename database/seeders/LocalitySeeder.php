<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locality;

class LocalitySeeder extends Seeder
{
    public function run()
    {
        $localities = [
            // Pakistan
            ['name' => 'Clifton', 'city_id' => 1],
            ['name' => 'Gulshan', 'city_id' => 1],
            ['name' => 'Johar Town', 'city_id' => 2],
            ['name' => 'Gulberg', 'city_id' => 2],
            ['name' => 'F-10', 'city_id' => 3],
            ['name' => 'G-9', 'city_id' => 3],
            // United States
            ['name' => 'Manhattan', 'city_id' => 4],
            ['name' => 'Brooklyn', 'city_id' => 4],
            ['name' => 'Hollywood', 'city_id' => 5],
            ['name' => 'Santa Monica', 'city_id' => 5],
            // India
            ['name' => 'Bandra', 'city_id' => 6],
            ['name' => 'Andheri', 'city_id' => 6],
            ['name' => 'Connaught Place', 'city_id' => 7],
            ['name' => 'Karol Bagh', 'city_id' => 7],
            // United Kingdom
            ['name' => 'Soho', 'city_id' => 8],
            ['name' => 'Covent Garden', 'city_id' => 8],
            ['name' => 'Digbeth', 'city_id' => 9],
            ['name' => 'Hockley', 'city_id' => 9],
            // Canada
            ['name' => 'Downtown Toronto', 'city_id' => 10],
            ['name' => 'Kitsilano', 'city_id' => 11],
            ['name' => 'Plateau Mont-Royal', 'city_id' => 12],
            ['name' => 'Bowness', 'city_id' => 13],
            // Australia
            ['name' => 'Bondi Beach', 'city_id' => 14],
            ['name' => 'Northbridge', 'city_id' => 15],
            ['name' => 'South Bank', 'city_id' => 16],
            ['name' => 'Fremantle', 'city_id' => 17],
            // Germany
            ['name' => 'Charlottenburg', 'city_id' => 18],
            ['name' => 'Schwabing', 'city_id' => 19],
            ['name' => 'HafenCity', 'city_id' => 20],
            ['name' => 'Altstadt', 'city_id' => 21],
            // France
            ['name' => 'Le Marais', 'city_id' => 22],
            ['name' => 'Latin Quarter', 'city_id' => 23],
            ['name' => 'La Confluence', 'city_id' => 24],
            ['name' => 'Vieux Lyon', 'city_id' => 25],
            // China
            ['name' => 'Hutongs', 'city_id' => 26],
            ['name' => 'Pudong', 'city_id' => 27],
            ['name' => 'Shenzhen Bay', 'city_id' => 28],
            ['name' => 'Futian', 'city_id' => 29],
            // Japan
            ['name' => 'Shinjuku', 'city_id' => 30],
            ['name' => 'Harajuku', 'city_id' => 31],
            ['name' => 'Shibuya', 'city_id' => 32],
            ['name' => 'Asakusa', 'city_id' => 33],
        ];

        foreach ($localities as $locality) {
            Locality::create($locality);
        }
    }
}
