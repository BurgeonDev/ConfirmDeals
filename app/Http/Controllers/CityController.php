<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $cities = City::with('country')->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $countries = Country::all();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'country_id' => 'required|exists:countries,id',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')->with('success', 'City created successfully!');
    }

    public function edit(City $city)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $countries = Country::all();
        return view('admin.cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities', 'name')->ignore($city->id),
            ],
            'country_id' => 'required|exists:countries,id',
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success', 'City updated successfully!');
    }


    public function destroy(City $city)
    {
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'City deleted successfully!');
    }
}
