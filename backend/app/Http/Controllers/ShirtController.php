<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use App\Models\Team;
use Illuminate\Http\Request;

class ShirtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shirts = Shirt::with('team')->get();
        return view('shirts.index', compact('shirts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('shirts.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'season' => 'required'
        ]);

        Shirt::create($request->only('team_id', 'season'));

        return redirect()->route('shirts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shirt $shirt)
    {
        $teams = Team::all();
        return view('shirts.edit', compact('shirt', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shirt $shirt)
    {
        $request->validate([
            'team_id' => 'required',
            'season' => 'required'
        ]);

        $shirt->update($request->only('team_id', 'season'));
        
        return redirect()->route('shirts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shirt $shirt)
    {
        $shirt->delete();
        return redirect()->route('shirts.index');
    }
}
