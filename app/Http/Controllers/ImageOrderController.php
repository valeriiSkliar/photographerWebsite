<?php

namespace App\Http\Controllers;

use App\Models\AlbumImage;
use Illuminate\Http\Request;

class ImageOrderController extends Controller
{

    public function update(Request $request)
    {
        $imageOrder = $request->input('imageOrder', []);
        $album_id = $request->input('album_id');

//        dd($album_id);
        foreach ($imageOrder as $index => $imageId) {
            AlbumImage::where('image_id', $imageId)
                ->where('album_id', $album_id)
                ->update(['image_index' => $index]);
        }

        return response()->json(['success' => 'Image order updated successfully']);
    }
}
