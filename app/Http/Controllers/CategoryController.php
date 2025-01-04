<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
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


    // public function cat()
    // {
    //     $categories = Category::all();
    //     $cities = City::all();

    //     // Get featured ads first, then other ads
    //     $ads = Ad::where('status', 'verified')
    //         ->orderByDesc('is_featured') // Featured ads first
    //         ->paginate(30);

    //     return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
    // }

    public function cat()
    {
        $categories = Category::all();
        $cities = City::all();

        // Retrieve ads with first 6 featured ads in random order
        $featuredAds = Ad::where('status', 'verified')
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take(6)
            ->get();

        $remainingAds = Ad::where('status', 'verified')
            ->where('is_featured', false)
            ->paginate(30);  // This is a paginated result

        // Merge featured ads and remaining ads into a single collection
        $ads = $featuredAds->merge($remainingAds->items());

        return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    }

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

    //     // Start query with verified ads
    //     $ads = Ad::query()->where('status', 'verified');

    //     // Search filter
    //     if ($request->filled('search')) {
    //         $ads->where('title', 'like', '%' . $request->search . '%');
    //     }

    //     // Location filter
    //     if ($request->filled('city')) {
    //         $ads->whereHas('city', function ($query) use ($request) {
    //             $query->where('name', $request->city);
    //         });

    //         if ($request->filled('locality')) {
    //             $ads->whereHas('locality', function ($query) use ($request) {
    //                 $query->where('name', $request->locality);
    //             });
    //         }
    //     }

    //     // Category filter
    //     if ($request->filled('category')) {
    //         $ads->where('category_id', $request->category);
    //     }

    //     // Price range filter
    //     if ($request->filled('price_min') && $request->filled('price_max')) {
    //         $ads->whereBetween('price', [$request->price_min, $request->price_max]);
    //     }

    //     // Order by featured ads first, then other ads
    //     $ads = $ads->orderByDesc('is_featured')->paginate(30);

    //     return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
    // }


    public function catt(Request $request)
    {
        $categories = Category::all();
        $cities = City::all();

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

        // Step 1: Retrieve the featured ads based on the same filters (max 6)
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
            })
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Step 2: Retrieve remaining ads (non-featured) based on the same filters
        $remainingAds = $adsQuery->where('is_featured', false)
            ->paginate(30);

        // Step 3: Merge featured ads and remaining ads into a single collection
        $ads = $featuredAds->merge($remainingAds->items());

        // Return to view with the variables
        return view('frontend.categories.index', compact('categories', 'ads', 'cities', 'remainingAds'));
    }
}
