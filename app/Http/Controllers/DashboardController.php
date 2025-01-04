<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Locality;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }

        $countries = Country::count();
        $cities = City::count();
        $localities = Locality::count();
        $ads = Ad::where('status', 'verified')->count();
        $disableAds = Ad::where('status', 'cancel')->count();
        $categories = Category::count();
        $professions = Profession::count();
        $users = User::where('is_active', true)->count();
        // Additional counts
        $featuredAds = Ad::where('is_featured', true)->count(); // Count featured ads
        $expiredAds = Ad::where('status', 'expired')->count(); // Count expired ads
        $pendingAds = Ad::where('status', 'pending')->count(); // Count pending ads

        return view('admin.Dashboard', compact(
            'countries',
            'cities',
            'localities',
            'ads',
            'users',
            'disableAds',
            'categories',
            'professions',
            'featuredAds',
            'expiredAds',
            'pendingAds'
        ));
    }
}
