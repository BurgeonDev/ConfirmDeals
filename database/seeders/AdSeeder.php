<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;

class AdSeeder extends Seeder
{
    public function run()
    {
        // Seed 1,000 ads
        Ad::factory()->count(1000)->create();
    }
}
