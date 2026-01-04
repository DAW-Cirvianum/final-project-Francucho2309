<?php

namespace App\Http\Controllers;

use App\Models\ShirtImage;
use Illuminate\Support\Facades\Storage;

class ShirtImageController extends Controller
{
    public function destroy(ShirtImage $image) {
        Storage::disk('public')->delete($image->url_image);
        $image->delete();

        return back();
    }
}
