<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_config')->insert([
            ['key' => 'featured_ads', 'value' => '5'], // Number to show featured ads
            ['key' => 'pagination_value', 'value' => '20'], // Number of ads to show per page
            ['key' => 'product_ads_commission', 'value' => '0.25'], // Commission for buyer-seller
            ['key' => 'service_ads_commission', 'value' => '0.25'], // Commission for service ads

        ]);
    }
}
