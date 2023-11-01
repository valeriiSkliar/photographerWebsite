<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function createAlbum(Request $request)
    {
        $album = Album::create();

        return response()->json([
            'success' => true,
            'message' => 'Album created, add images',
            'album_id' => $album->id]);
    }

    public function uploadMethod(Request $request)
    {
        $albumImage = null;


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getFilename() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/' . $filename;
            $file->move(public_path('uploads'), $filename);
//            dd(1111);
            $image = Image::create(['file_url' => $filePath]);

            if ($request->album_id) {
                $albumImage = AlbumImage::create([
                    'album_id' => $request->album_id,
                    'image_id' => $image->id
                ]);
            }
            return response()->json(['success' => true, 'filename' => $filename]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
