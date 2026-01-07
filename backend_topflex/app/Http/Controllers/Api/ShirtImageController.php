<?php

namespace App\Http\Controllers\Api;

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
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('shirts', 'public');

        $image = ShirtImage::create([
            'shirt_id' => $shirt->id,
            'image_path' => $path
        ]);

        return response()->json([
            'data' => $image
        ], 201);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShirtImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return response()->json([
            'message' => 'Imágen eliminada.'
        ], 204);
    }
}
