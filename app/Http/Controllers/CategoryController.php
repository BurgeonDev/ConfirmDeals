<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }



    public function cat()
    {
        $categories = Category::all();
        $cities = City::all();

        // Retrieve the values from the app_config table
        $featuredAdsCount = (int) DB::table('app_config')->where('key', 'featured_ads')->value('value'); // Get the number of featured ads
        $paginationValue = (int) DB::table('app_config')->where('key', 'pagination_value')->value('value'); // Get the pagination value

        // Retrieve featured ads dynamically based on the value in app_config
        $featuredAds = Ad::where('status', 'verified')
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take($featuredAdsCount) // Use the value from app_config
            ->with(['user' => function ($query) {
                $query->withAvg('feedbacks', 'rating'); // Get average ratings for each user
            }])
            ->get();

        // Retrieve remaining ads with pagination dynamically based on the value in app_config
        $remainingAds = Ad::where('status', 'verified')
            ->where('is_featured', false)
            ->with(['user' => function ($query) {
                $query->withAvg('feedbacks', 'rating');
            }])
            ->paginate($paginationValue); // Use the value from app_config

        // Merge featured ads and remaining ads into a single collection
        $ads = $featuredAds->merge($remainingAds->items());

        return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    }

    // public function cat()
    // {
    //     $categories = Category::all();
    //     $cities = City::all();

    //     // Retrieve featured ads
    //     $featuredAds = Ad::where('status', 'verified')
    //         ->where('is_featured', true)
    //         ->inRandomOrder()
    //         ->take(6)
    //         ->with(['user' => function ($query) {
    //             $query->withAvg('feedbacks', 'rating'); // Get average ratings for each user
    //         }])
    //         ->get();

    //     // Retrieve remaining ads with pagination
    //     $remainingAds = Ad::where('status', 'verified')
    //         ->where('is_featured', false)
    //         ->with(['user' => function ($query) {
    //             $query->withAvg('feedbacks', 'rating');
    //         }])
    //         ->paginate(30);

    //     // Merge featured ads and remaining ads into a single collection
    //     $ads = $featuredAds->merge($remainingAds->items());

    //     return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    // }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }


    public function edit(Category $category)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }


    // public function catt(Request $request)
    // {
    //     $categories = Category::all();
    //     $cities = City::all();

    //     // Start the query for verified ads
    //     $adsQuery = Ad::query()->where('status', 'verified');

    //     // Search filter
    //     if ($request->filled('search')) {
    //         $adsQuery->where('title', 'like', '%' . $request->search . '%');
    //     }

    //     // Location filter
    //     if ($request->filled('city')) {
    //         $adsQuery->whereHas('city', function ($query) use ($request) {
    //             $query->where('name', $request->city);
    //         });

    //         // Locality filter if city is selected
    //         if ($request->filled('locality')) {
    //             $adsQuery->whereHas('locality', function ($query) use ($request) {
    //                 $query->where('name', $request->locality);
    //             });
    //         }
    //     }

    //     // Category filter
    //     if ($request->filled('category')) {
    //         $adsQuery->where('category_id', $request->category);
    //     }

    //     // Price range filter
    //     if ($request->filled('price_min') && $request->filled('price_max')) {
    //         $adsQuery->whereBetween('price', [$request->price_min, $request->price_max]);
    //     }

    //     // Type filter
    //     if ($request->filled('type')) {
    //         $types = $request->input('type');
    //         if (!in_array('all', $types)) {
    //             $adsQuery->whereIn('type', $types);
    //         }
    //     }

    //     // Retrieve the featured ads based on the same filters (max 6)
    //     $featuredAds = Ad::where('status', 'verified')
    //         ->where('is_featured', true)
    //         ->where(function ($query) use ($request) {
    //             if ($request->filled('search')) {
    //                 $query->where('title', 'like', '%' . $request->search . '%');
    //             }
    //             if ($request->filled('city')) {
    //                 $query->whereHas('city', function ($query) use ($request) {
    //                     $query->where('name', $request->city);
    //                 });
    //             }
    //             if ($request->filled('locality')) {
    //                 $query->whereHas('locality', function ($query) use ($request) {
    //                     $query->where('name', $request->locality);
    //                 });
    //             }
    //             if ($request->filled('category')) {
    //                 $query->where('category_id', $request->category);
    //             }
    //             if ($request->filled('price_min') && $request->filled('price_max')) {
    //                 $query->whereBetween('price', [$request->price_min, $request->price_max]);
    //             }
    //             if ($request->filled('type')) {
    //                 $types = $request->input('type');
    //                 if (!in_array('all', $types)) {
    //                     $query->whereIn('type', $types);
    //                 }
    //             }
    //         })
    //         ->inRandomOrder()
    //         ->take(6)
    //         ->get();

    //     // Retrieve remaining ads (non-featured) based on the same filters
    //     $remainingAds = $adsQuery->where('is_featured', false)
    //         ->paginate(30);

    //     // Merge featured ads and remaining ads into a single collection
    //     $ads = $featuredAds->merge($remainingAds->items());

    //     // Return to view with the variables
    //     return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    // }
    public function catt(Request $request)
    {
        $categories = Category::all();
        $cities = City::all();

        // Retrieve the values from the app_config table
        $featuredAdsCount = (int) DB::table('app_config')->where('key', 'featured_ads')->value('value'); // Get the number of featured ads
        $paginationValue = (int) DB::table('app_config')->where('key', 'pagination_value')->value('value'); // Get the pagination value

        // Start the query for verified ads
        $adsQuery = Ad::query()->where('status', 'verified');

        // Search filter
        if ($request->filled('search')) {
            $adsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        // Location filter
        if ($request->filled('city')) {
            $adsQuery->whereHas('city', function ($query) use ($request) {
                $query->where('name', $request->city);
            });

            // Locality filter if city is selected
            if ($request->filled('locality')) {
                $adsQuery->whereHas('locality', function ($query) use ($request) {
                    $query->where('name', $request->locality);
                });
            }
        }

        // Category filter
        if ($request->filled('category')) {
            $adsQuery->where('category_id', $request->category);
        }

        // Price range filter
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $adsQuery->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        // Type filter
        if ($request->filled('type')) {
            $types = $request->input('type');
            if (!in_array('all', $types)) {
                $adsQuery->whereIn('type', $types);
            }
        }

        // Retrieve featured ads dynamically based on the value in app_config (max $featuredAdsCount)
        $featuredAds = Ad::where('status', 'verified')
            ->where('is_featured', true)
            ->where(function ($query) use ($request) {
                if ($request->filled('search')) {
                    $query->where('title', 'like', '%' . $request->search . '%');
                }
                if ($request->filled('city')) {
                    $query->whereHas('city', function ($query) use ($request) {
                        $query->where('name', $request->city);
                    });
                }
                if ($request->filled('locality')) {
                    $query->whereHas('locality', function ($query) use ($request) {
                        $query->where('name', $request->locality);
                    });
                }
                if ($request->filled('category')) {
                    $query->where('category_id', $request->category);
                }
                if ($request->filled('price_min') && $request->filled('price_max')) {
                    $query->whereBetween('price', [$request->price_min, $request->price_max]);
                }
                if ($request->filled('type')) {
                    $types = $request->input('type');
                    if (!in_array('all', $types)) {
                        $query->whereIn('type', $types);
                    }
                }
            })
            ->inRandomOrder()
            ->take($featuredAdsCount) // Use the value from app_config
            ->get();

        // Retrieve remaining ads (non-featured) dynamically based on the value in app_config (pagination)
        $remainingAds = $adsQuery->where('is_featured', false)
            ->paginate($paginationValue); // Use the value from app_config

        // Merge featured ads and remaining ads into a single collection
        $ads = $featuredAds->merge($remainingAds->items());

        // Return to view with the variables
        return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    }
}
