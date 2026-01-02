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
        Shirt::create($request->all());
        return redirect()->route('shirts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $shirt->update($request->all());
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
