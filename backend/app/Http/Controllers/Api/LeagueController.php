<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => League::all()
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
            'country' => 'required|string'
        ]);

        $league = League::create($request->only('name', 'country'));

        return response()->json([
            'data' => $league
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(League $league)
    {
        return response()->json([
            'data' => $league
        ]);
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

        return response()->json([
            'data' => $league
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(League $league)
    {
        $league->delete();

        return response()->json([
            'message' => 'Liga eliminada'
        ], 204);
    }
}
