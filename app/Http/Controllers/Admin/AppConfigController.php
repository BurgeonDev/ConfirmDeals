<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppConfigController extends Controller
{
    // Display the current app config values
    public function index()
    {
        // Retrieve all configuration settings from the app_config table
        $configurations = DB::table('app_config')->get();

        return view('admin.config.index', compact('configurations'));
    }

    // Update configuration values
    public function update(Request $request)
    {
        // Validate the incoming request to ensure the commission values are between 0 and 100
        $request->validate([
            'featured_ads' => 'required|numeric',
            'pagination_value' => 'required|numeric',
            'product_ads_commission' => 'required|numeric|min:0|max:100', // Ensure commission is between 0 and 100
            'service_ads_commission' => 'required|numeric|min:0|max:100', // Ensure commission is between 0 and 100
        ]);

        // Update the configuration values in the app_config table
        DB::table('app_config')->updateOrInsert(
            ['key' => 'featured_ads'],
            ['value' => $request->featured_ads]
        );
        DB::table('app_config')->updateOrInsert(
            ['key' => 'pagination_value'],
            ['value' => $request->pagination_value]
        );
        DB::table('app_config')->updateOrInsert(
            ['key' => 'product_ads_commission'],
            ['value' => $request->product_ads_commission] // Store as entered (no conversion to decimal)
        );
        DB::table('app_config')->updateOrInsert(
            ['key' => 'service_ads_commission'],
            ['value' => $request->service_ads_commission] // Store as entered (no conversion to decimal)
        );

        return redirect()->back()->with('success', 'Configurations updated successfully');
    }
}
