<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        return response()->json([
            'data' => $teams
        ]);
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
            'league_id' => 'required|exists:leagues,id'
        ]);

        $team = Team::create($request->only('name', 'league_id'));

        return response()->json([
            'data' => $team
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->load('league');

        return response()->json([
            'data' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => [
                'required', 
                'regex:/^(?=.*[A-Za-z])[A-Za-z0-9\s]+$/'
            ],
            'league_id' => 'required|exists:leagues,id'
        ]);

        $team->update($request->only('name', 'league_id'));

        return response()->json([
            'data' => $team
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json([
            'message' => 'Equipo eliminado'
        ], 204);
    }
}
