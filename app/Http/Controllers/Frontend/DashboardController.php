<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->where('status', '=', 'pending') // Use status for unverified ads
            ->count();

        $ads = Ad::where('user_id', $userId)
            ->with('category')
            ->get();
        ////////////////////////////
        // Count cancelled ads
        $cancelledAdsCount = Ad::where('user_id', $userId)
            ->where('status', 'cancel') // Assuming 'cancelled' is the status for cancelled ads
            ->count();

        // Count featured ads
        $featuredAdsCount = Ad::where('user_id', $userId)
            ->where('is_featured', true) // Assuming 'is_featured' is the field for featured ads
            ->count();

        // Count deals where the user is either the bidder or the ad owner
        $dealsCount = Bid::join('ads', 'bids.ad_id', '=', 'ads.id')
            ->where(function ($query) use ($userId) {
                $query->where('bids.user_id', $userId) // The user placed the bid
                    ->orWhere('ads.user_id', $userId); // The user owns the ad
            })
            ->where('bids.status', 'accepted') // Only count accepted bids as deals
            ->count();


        $totalFields = 12;
        $completedFields = 0;

        $user = Auth::user();
        if ($user->first_name) $completedFields++;
        if ($user->last_name) $completedFields++;
        if ($user->email) $completedFields++;
        if ($user->password) $completedFields++;
        if ($user->is_active) $completedFields++;
        if ($user->coins) $completedFields++;
        if ($user->profession_id) $completedFields++;
        if ($user->profile_pic) $completedFields++;
        if ($user->phone_number) $completedFields++;
        if ($user->country_id) $completedFields++;
        if ($user->city_id) $completedFields++;
        if ($user->locality_id) $completedFields++;

        // Calculate profile completion percentage
        $completionPercentage = round(($completedFields / $totalFields) * 100);

        return view('frontend.dashboard.dashboard', [
            'ads' => $ads,
            'verifiedAdsCount' => $verifiedAdsCount,
            'unverifiedAdsCount' => $unverifiedAdsCount,
            'activities' => $allActivities,
            'cancelledAdsCount' => $cancelledAdsCount,
            'featuredAdsCount' => $featuredAdsCount,
            'dealsCount' => $dealsCount,
            'completionPercentage' => $completionPercentage,
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
