<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leagues = League::all();
        return view('admin.leagues.index', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name');

        $extraCountries = ['England', 'Scotland', 'Wales', 'Northern Ireland'];
        $countries = collect($response->json())->filter(fn ($country) => isset($country['name']['common']))->map(fn ($c) => $c['name']['common'])->merge($extraCountries)->sort()->unique()->values();

        return view('admin.leagues.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^(?=.*[A-Za-z])[A-Za-z0-9\s]+$/'
            ],
            'country' => 'required|string'
        ]);

        League::create($request->only('name', 'country'));

        return redirect()->route('leagues.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(League $league)
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name');

        $extraCountries = ['England', 'Scotland', 'Wales', 'Northern Ireland'];
        $countries = collect($response->json())->filter(fn ($country) => isset($country['name']['common']))->map(fn ($c) => $c['name']['common'])->merge($extraCountries)->sort()->unique()->values();
        
        return view('admin.leagues.edit', compact('league', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, League $league)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^(?=.*[A-Za-z])[A-Za-z0-9\s]+$/'
            ],
            'country' => 'required|string'
        ]);

        $league->update($request->only('name', 'country'));

        return redirect()->route('leagues.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(League $league)
    {
        $league->delete();
        return redirect()->route('leagues.index');
    }
}
