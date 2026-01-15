<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shirt;
use App\Models\ShirtImage;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShirtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shirts = Shirt::with('team')->get();
        return view('admin.shirts.index', compact('shirts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('admin.shirts.create', compact('teams'));
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

        return redirect()->route('shirts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shirt $shirt)
    {
        $teams = Team::all();
        return view('admin.shirts.edit', compact('shirt', 'teams'));
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
