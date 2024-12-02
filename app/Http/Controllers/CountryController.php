<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $countries = Country::paginate(10);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')->with('success', 'Country created successfully!');
    }


    public function edit(Country $country)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'name')->ignore($country->id),
            ],
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')->with('success', 'Country updated successfully!');
    }


    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Country deleted successfully!');
    }
}
