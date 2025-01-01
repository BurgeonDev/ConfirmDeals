<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locality;

class LocalitySeeder extends Seeder
{
    public function run()
    {
        $localities = [
            ['name' => 'Clifton', 'city_id' => 1],
            ['name' => 'Gulshan', 'city_id' => 1],
            ['name' => 'Johar Town', 'city_id' => 2],
            ['name' => 'Gulberg', 'city_id' => 2],
            ['name' => 'Manhattan', 'city_id' => 3],
            ['name' => 'Brooklyn', 'city_id' => 3],
            ['name' => 'Adha', 'city_id' => 4],
            ['name' => 'Besrha', 'city_id' => 5],
            ['name' => 'kcety', 'city_id' => 6],
        ];

        foreach ($localities as $locality) {
            Locality::create($locality);
        }
    }
}
