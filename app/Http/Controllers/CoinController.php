<?php


namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        $coins = Coin::all();
        return view('admin.coins.index', compact('coins'));
    }

    public function create()
    {
        return view('admin.coins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_in_pkr' => 'required|numeric|min:0',
            'equivalence' => 'required|integer|min:1',
        ]);

        Coin::create([
            'price_in_pkr' => $validated['price_in_pkr'],
            'equivalence' => $validated['equivalence'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('coins.index')->with('success', 'Coin added successfully.');
    }

    public function show(Coin $coin)
    {
        return view('admin.coins.show', compact('coin'));
    }

    public function edit(Coin $coin)
    {
        return view('admin.coins.edit', compact('coin'));
    }

    public function update(Request $request, Coin $coin)
    {
        $validated = $request->validate([
            'price_in_pkr' => 'required|numeric|min:0',
            'equivalence' => 'required|integer|min:1',
        ]);

        $coin->update([
            'price_in_pkr' => $validated['price_in_pkr'],
            'equivalence' => $validated['equivalence'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('coins.index')->with('success', 'Coin updated successfully.');
    }

    public function destroy(Coin $coin)
    {
        $coin->delete();
        return redirect()->route('coins.index')->with('success', 'Coin deleted successfully.');
    }
}
