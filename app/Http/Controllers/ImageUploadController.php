<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as ImageIntervention;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function deleteSelectedImages(Request $request)
    {
        $imageIds = $request->input('images');

        if (!$imageIds || !is_array($imageIds)) {
            return response()->json(['error' => 'No images provided'], 400);
        }

        // Retrieve the image file paths before deleting the records from the database.
        $filePaths = Image::whereIn('id', $imageIds)->pluck('file_url')->toArray();

        // Delete images from the database.
        $deleted = Image::destroy($imageIds);

        if ($deleted) {
            // Remove the image files from storage.
            foreach ($filePaths as $path) {
                if (file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }

            // If there are relations with album_images, you may need to delete them too.
            AlbumImage::whereIn('image_id', $imageIds)->delete();

            return response()->json(['success' => true, 'message' => 'Images deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete images'], 500);
        }
    }
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
        $albumId = null;
        if ($request->album_id == 'null') {
            $albumId = '1';
        } else {
            $albumId = $request->album_id;
        }

//        dd($albumId);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getFilename() . '.webp';
            $filePath = 'uploads/' . $filename;

            $image = ImageIntervention::make($file)
                ->encode('webp', 75);
            $image->save(public_path($filePath));
            $imageModel  = Image::create(['file_url' => $filePath]);

                $albumImage = AlbumImage::create([
                    'album_id' => $albumId,
                    'image_id' => $imageModel->id
                ]);

            return response()->json(['success' => true, 'image' => json_encode($imageModel)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
