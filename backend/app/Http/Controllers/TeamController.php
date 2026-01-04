<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('league')->get();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leagues = League::all();
        return view('teams.create', compact('leagues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^(?=.*\p{L})[\p{L}0-9\s]+$/u'],
            'league_id' => 'required|exists:leagues,id'
        ]);

        Team::create($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $leagues = League::all();
        return view('teams.edit', compact('team', 'leagues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => ['required', 'regex:/^(?=.*\p{L})[\p{L}0-9\s]+$/u'],
            'league_id' => 'required|exists:leagues,id'
        ]);

        $team->update($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index');
    }
}
