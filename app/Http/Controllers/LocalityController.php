<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Locality;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    public function index()
    {
        $localities = Locality::with('city')->paginate(10);
        return view('admin.localities.index', compact('localities'));
    }

    public function create()
    {
        $cities = City::all();
        return view('admin.localities.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        Locality::create($request->all());

        return redirect()->route('localities.index')->with('success', 'Locality created successfully!');
    }

    public function edit(Locality $locality)
    {
        $cities = City::all();
        return view('admin.localities.edit', compact('locality', 'cities'));
    }

    public function update(Request $request, Locality $locality)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $locality->update($request->all());

        return redirect()->route('localities.index')->with('success', 'Locality updated successfully!');
    }

    public function destroy(Locality $locality)
    {
        $locality->delete();

        return redirect()->route('localities.index')->with('success', 'Locality deleted successfully!');
    }
}
