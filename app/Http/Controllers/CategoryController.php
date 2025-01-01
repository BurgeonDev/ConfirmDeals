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


    public function cat()
    {
        $categories = Category::all();
        $cities = City::all();

        // Get featured ads first, then other ads
        $ads = Ad::where('status', 'verified')
            ->orderByDesc('is_featured') // Featured ads first
            ->paginate(30);

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

        // Start query with verified ads
        $ads = Ad::query()->where('status', 'verified');

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

        // Order by featured ads first, then other ads
        $ads = $ads->orderByDesc('is_featured')->paginate(30);

        return view('frontend.categories.index', compact('categories', 'ads', 'cities'));
    }
}
