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
        $ads = Ad::where('is_verified', true)->paginate(30);
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
    public function indexx(Request $request)
    {
        // Get all categories and cities for dropdowns
        $categories = Category::all();
        $cities = City::all();

        // Start the query to filter ads
        $query = Ad::where('is_verified', true);

        // Apply filters based on the request parameters
        if ($request->has('keyword') && $request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('category') && $request->category !== 'none') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('city') && $request->city !== 'none') {
            $query->where('city', $request->city);
        }

        // Paginate the results
        $ads = $query->paginate(30);

        // Return the view with the necessary data
        return view('frontend.categories.index', compact('ads', 'categories', 'cities'));
    }
}
