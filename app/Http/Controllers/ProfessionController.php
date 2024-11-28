<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $professions = Profession::all();
        return
            view('admin.professions.index', compact('professions'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.professions.create'); // Return a form view if needed
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:professions,name|max:255',
        ]);

        Profession::create($request->all());

        return redirect()->route('professions.index')->with('success', 'Profession created successfully.');
    }

    public function show(Profession $profession)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return response()->json($profession); // Optionally return as JSON for APIs
    }

    public function edit(Profession $profession)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.professions.edit', compact('profession')); // Return edit form view if needed
    }

    public function update(Request $request, Profession $profession)
    {
        $request->validate([
            'name' => 'required|unique:professions,name,' . $profession->id . '|max:255',
        ]);

        $profession->update($request->all());

        return redirect()->route('professions.index')->with('success', 'Profession updated successfully.');
    }

    public function destroy(Profession $profession)
    {
        $profession->delete();

        return redirect()->route('professions.index')->with('success', 'Profession deleted successfully.');
    }
}
