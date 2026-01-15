<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shirt;
use Illuminate\Http\Request;

class ShirtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Shirt::with('images', 'team.league');

        if ($request->team_id) {
            $query->where('team_id', $request->team_id);
        }
        
        if ($request->league_id) {
            $query->whereHas('team', function ($q) use ($request) {
                $q->where('league_id', $request->league_id);
            });
        }

        return response()->json([
            'data' => $query->get()
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
            'season' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/'
            ],
            'price' => 'required|numeric|min:0',
            'team_id' => 'required|exists:teams,id'
        ]);

        $shirt = Shirt::create($request->only('name', 'season', 'price', 'team_id'));

        return response()->json([
            'data' => $shirt
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shirt $shirt)
    {
        $shirt->load('images', 'team.league');

        return response()->json([
            'data' => $shirt
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shirt $shirt)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^(?=.*[A-Za-z])[A-Za-z0-9\s]+$/'
            ],
            'season' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/'
            ],
            'price' => 'required|numeric|min:0',
            'team_id' => 'required|exists:teams,id'
        ]);

        $shirt->update($request->only('name', 'season', 'price', 'team_id'));

        return response()->json([
            'data' => $shirt
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shirt $shirt)
    {
        $shirt->delete();

        return response()->json([
            'message' => 'T-shirt removed'
        ], 204);
    }
}
