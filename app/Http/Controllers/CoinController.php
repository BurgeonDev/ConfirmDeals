<?php


namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Setting;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $freeCoins = Setting::getValue('free_coins');
        $featuredAdRate = Setting::getValue('featured_ad_rate');
        $coins = Coin::all();
        return view('admin.coins.index', compact('coins', 'freeCoins', 'featuredAdRate'));
    }

    public function create()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
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
    // public function updateSettings(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'free_coins' => 'required|integer|min:0',
    //     ]);

    //     Setting::setValue('free_coins', $validatedData['free_coins']);

    //     return redirect()->back()->with('success', 'Free coins value updated successfully.');
    // }
    public function updateSettings(Request $request)
    {
        $validatedData = $request->validate([
            'free_coins' => 'required|integer|min:0',
            'featured_ad_rate' => 'required|integer|min:1', // Coins per day for featured ads
        ]);

        Setting::setValue('free_coins', $validatedData['free_coins']);
        Setting::setValue('featured_ad_rate', $validatedData['featured_ad_rate']);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
