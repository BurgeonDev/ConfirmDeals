<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'key' => 'free_coins',
            'value' => '50', // Default free coins value
        ]);
        DB::table('settings')->insert([
            'key' => 'featured_ad_rate',
            'value' => '2', // Default free coins value
        ]);
    }
}
