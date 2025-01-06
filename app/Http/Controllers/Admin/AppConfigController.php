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
        // Validate the incoming request to ensure values are not null or empty
        $request->validate([
            'featured_ads' => 'required|numeric',
            'pagination_value' => 'required|numeric',
            'product_ads_commission' => 'nullable|numeric|min:0|max:100', // Commission between 0 and 100
            'service_ads_commission' => 'nullable|numeric|min:0|max:100', // Commission between 0 and 100
        ]);

        // Get the current user ID
        $userId = auth()->id();

        // Use default values if a field is empty
        $commission = $request->product_ads_commission ?? 0;
        $serviceCommission = $request->service_ads_commission ?? 0;

        // Update or insert configuration values
        $this->updateOrInsertConfig('featured_ads', $request->featured_ads, $userId);
        $this->updateOrInsertConfig('pagination_value', $request->pagination_value, $userId);
        $this->updateOrInsertConfig('product_ads_commission', $commission, $userId);
        $this->updateOrInsertConfig('service_ads_commission', $serviceCommission, $userId);

        return redirect()->back()->with('success', 'Configurations updated successfully');
    }

    // Helper method for updating or inserting configuration values
    private function updateOrInsertConfig($key, $value, $userId)
    {
        // Check if the record exists
        $config = DB::table('app_config')->where('key', $key)->first();

        if ($config) {
            // Record exists, so we just update it
            DB::table('app_config')
                ->where('key', $key)
                ->update([
                    'value' => $value,
                    'updated_by' => $userId, // Update the 'updated_by' field
                    'updated_at' => now(),
                ]);
        } else {
            // Record does not exist, so we insert a new record
            DB::table('app_config')->insert([
                'key' => $key,
                'value' => $value,
                'created_by' => $userId, // Set 'created_by' on insertion
                'updated_by' => $userId, // Set 'updated_by' on insertion
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
