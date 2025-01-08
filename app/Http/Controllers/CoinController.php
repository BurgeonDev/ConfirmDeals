<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }

        $coins = Coin::all();
        $coin = $coins->first();
        $freeCoins = $coin ? $coin->free_coins : 0;
        $featuredAdRate = $coin ? $coin->featured_ad_rate : 0;

        return view('admin.coins.index', compact('coins', 'freeCoins', 'featuredAdRate'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.coins.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'price_in_pkr' => 'required|numeric|min:0',
            'equivalence' => 'required|integer|min:1',
            'free_coins' => 'required|integer|min:0',
            'featured_ad_rate' => 'required|integer|min:1',
        ]);

        Coin::create([
            'price_in_pkr' => $validated['price_in_pkr'],
            'equivalence' => $validated['equivalence'],
            'free_coins' => $validated['free_coins'],
            'featured_ad_rate' => $validated['featured_ad_rate'],

        ]);

        return redirect()->route('coins.index')->with('success', 'Coin added successfully.');
    }

    public function show(Coin $coin)
    {
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.coins.show', compact('coin'));
    }

    public function edit(Coin $coin)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.coins.edit', compact('coin'));
    }

    public function update(Request $request, Coin $coin)
    {
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'price_in_pkr' => 'required|numeric|min:0',
            'equivalence' => 'required|integer|min:1',
            'free_coins' => 'required|integer|min:0',
            'featured_ad_rate' => 'required|integer|min:1',
        ]);

        $coin->update([
            'price_in_pkr' => $validated['price_in_pkr'],
            'equivalence' => $validated['equivalence'],
            'free_coins' => $validated['free_coins'],
            'featured_ad_rate' => $validated['featured_ad_rate'],

        ]);

        return redirect()->route('coins.index')->with('success', 'Coin updated successfully.');
    }

    public function destroy(Coin $coin)
    {
        if (!auth()->user()->can('Edit Coins Setting')) {
            abort(403, 'Unauthorized action.');
        }
        $coin->delete();
        return redirect()->route('coins.index')->with('success', 'Coin deleted successfully.');
    }
}
