<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
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
            'name' => ['required', 'regex:/^(?=.*\p{L})[\p{L}0-9\s]+$/u'],
            'season' => 'required',
            'price' => 'required|numeric|min:0',
            'team_id' => 'required|exists:teams,id',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $shirt = Shirt::create($request->only([
            'name', 'season', 'price', 'team_id'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('shirts', 'public');
                
                $shirt->images()->create([
                    'url_image' => $path
                ]);
            }
        }

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
            'name' => ['required', 'regex:/^(?=.*\p{L})[\p{L}0-9\s]+$/u'],
            'season' => 'required',
            'price' => 'required|numeric|min:0',
            'team_id' => 'required|exists:teams,id',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $shirt->update($request->only([
            'name', 'season', 'price', 'team_id'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('shirts', 'public');

                $shirt->images()->create([
                    'url_image' => $path
                ]);
            }
        }

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
