<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Locality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocalityController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $localities = Locality::with('city')->paginate(10);
        return view('admin.localities.index', compact('localities'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $cities = City::all();
        return view('admin.localities.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:localities,name,NULL,id,city_id,' . $request->city_id,
            'city_id' => 'required|exists:cities,id',
        ]);

        Locality::create($request->all());

        return redirect()->route('localities.index')->with('success', 'Locality created successfully!');
    }



    public function edit(Locality $locality)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $cities = City::all();
        return view('admin.localities.edit', compact('locality', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $locality = Locality::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:localities,name,' . $locality->id . ',id,city_id,' . $request->city_id,
            'city_id' => 'required|exists:cities,id',
        ]);

        // Update the locality with the validated data
        $locality->update($request->all());

        return redirect()->route('localities.index')->with('success', 'Locality updated successfully!');
    }



    public function destroy(Locality $locality)
    {
        $locality->delete();

        return redirect()->route('localities.index')->with('success', 'Locality deleted successfully!');
    }
}
