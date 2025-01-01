<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        // Fetch session data for login activities
        $loginActivities = DB::table('sessions')
            ->where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'title' => 'Logged in',
                    'time' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'icon' => 'lni lni-alarm', // Icon for login
                ];
            });

        // Combine all activities
        $allActivities = $loginActivities;

        // Fetch ads data based on the status field
        $verifiedAdsCount = Ad::where('user_id', $userId)
            ->where('status', 'verified') // Use status instead of is_verified
            ->count();

        $unverifiedAdsCount = Ad::where('user_id', $userId)
            ->where('status', '!=', 'verified') // Use status for unverified ads
            ->count();

        $ads = Ad::where('user_id', $userId)
            ->with('category')
            ->get();

        return view('frontend.dashboard.dashboard', [
            'ads' => $ads,
            'verifiedAdsCount' => $verifiedAdsCount,
            'unverifiedAdsCount' => $unverifiedAdsCount,
            'activities' => $allActivities,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
