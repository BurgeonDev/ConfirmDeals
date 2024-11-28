<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    // List all coin packages available
    public function index()
    {
        $coins = Coin::all();
        return view('admin.coins.index', compact('coins'));
    }

    // Show the coin details (price ranges)
    public function show($id)
    {
        $coin = Coin::findOrFail($id);
        return view('admin.coins.show', compact('coin'));
    }
    public function edit($id)
    {
        $coin = Coin::findOrFail($id);
        return view('admin.coins.edit', compact('coin'));
    }

    // Update the coin package (for admin)
    public function update(Request $request, $id)
    {
        $coin = Coin::findOrFail($id);

        $request->validate([
            'count' => 'required|integer|min:1',
            'from_price' => 'required|numeric|min:0',
            'to_price' => 'required|numeric|min:0',
        ]);

        $coin->update([
            'count' => $request->count,
            'from_price' => $request->from_price,
            'to_price' => $request->to_price,
        ]);

        return redirect()->route('coins.index')->with('success', 'Coin package updated successfully.');
    }

    // Create a new coin package
    public function create()
    {
        return view('admin.coins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1',
            'from_price' => 'required|numeric|min:0',
            'to_price' => 'required|numeric|min:0',
        ]);

        Coin::create([
            'count' => $request->count,
            'from_price' => $request->from_price,
            'to_price' => $request->to_price,
        ]);

        return redirect()->route('coins.index')->with('success', 'Coin package created successfully.');
    }

    // Delete a coin package
    public function destroy($id)
    {
        $coin = Coin::findOrFail($id);
        $coin->delete();

        return redirect()->route('coins.index')->with('success', 'Coin package deleted successfully.');
    }
}
