<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('public/images');

        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $path,
        ]);
    }

    public function delete($filename)
    {
        $path = 'public/images/' . $filename;

        if (!Storage::exists($path)) {
            return response()->json([
                'message' => 'Image not found',
            ], 404);
        }

        Storage::delete($path);

        return response()->json([
            'message' => 'Image deleted successfully',
        ]);
    }
}
