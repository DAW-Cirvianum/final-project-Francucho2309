<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shirt;
use App\Models\ShirtImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShirtImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Shirt $shirt)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('shirts', 'public');

            ShirtImage::create([
                'shirt_id' => $shirt->id,
                'image_path' => $path,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShirtImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back();
    }
}
