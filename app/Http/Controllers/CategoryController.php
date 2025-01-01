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
    //     $ads = Ad::where('is_verified', true)->paginate(30);
    //     $cities = City::all();
    //     return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
    // }

    public function cat()
    {
        $categories = Category::all();
        // Change the is_verified check to use status and check for 'verified'
        $ads = Ad::where('status', 'verified')->paginate(30); // Use status instead of is_verified
        $cities = City::all();

        return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
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
    public function catt(Request $request)
    {
        $categories = Category::all();
        $cities = City::all();

        // Use status field instead of is_verified
        $ads = Ad::query()->where('status', 'verified'); // Filter by verified ads

        // Search filter
        if ($request->filled('search')) {
            $ads->where('title', 'like', '%' . $request->search . '%');
        }

        // Location filter
        if ($request->filled('city')) {
            $ads->whereHas('city', function ($query) use ($request) {
                $query->where('name', $request->city);
            });

            if ($request->filled('locality')) {
                $ads->whereHas('locality', function ($query) use ($request) {
                    $query->where('name', $request->locality);
                });
            }
        }

        // Category filter
        if ($request->filled('category')) {
            $ads->where('category_id', $request->category);
        }

        // Price range filter
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $ads->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $ads = $ads->paginate(30);

        return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
    }
}
