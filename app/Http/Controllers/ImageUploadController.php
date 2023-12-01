<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as ImageIntervention;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function addSelectedImagesToAlbum(Request $request)
    {
        $imageIds = $request->input('images');

        if (!$imageIds || !is_array($imageIds)) {
            return response()->json(['error' => 'No images provided'], 400);
        }

        $albumId = $request->input('album_id');
        $album = Album::find($albumId);

        if (!$album) {
            return response()->json(['error' => 'Album not found'], 404);
        }

        $uniqueImageIds = AlbumImage::where('album_id', $albumId)
            ->whereIn('image_id', $imageIds)
            ->pluck('image_id')
            ->toArray();

        $newImageIds = array_diff($imageIds, $uniqueImageIds);
        $images = [];

        try {
            foreach ($newImageIds as $imageId) {
                $albumImage = AlbumImage::create([
                    'album_id' => $albumId,
                    'image_id' => $imageId
                ]);

                if ($albumImage) {
                    $images[] = Image::find($imageId);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while adding images'], 500);
        }

        if (count($images) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Images no allow to add to this album',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Images added to album ' . $album->title,
            'images' => $images,
        ]);
    }

    public function deleteSelectedImages(Request $request)
    {
        $imageIds = $request->input('images');

        if (!$imageIds || !is_array($imageIds)) {
            return response()->json(['error' => 'No images provided'], 400);
        }

        $filePaths = Image::whereIn('id', $imageIds)->pluck('file_url')->toArray();

        // Delete images from the database.
        $deleted = Image::destroy($imageIds);

        if ($deleted) {
            foreach ($filePaths as $path) {
                if (file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }

            AlbumImage::whereIn('image_id', $imageIds)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Images deleted successfully'
            ]);
        } else {
            return response()->json(['error' => 'Failed to delete images'], 500);
        }
    }

    public function createAlbum(Request $request)
    {
        $album = Album::create();

        session(['pending_album_id' => $album->id]);

        return response()->json([
            'success' => true,
            'message' => 'Add images',
            'album_id' => $album->id]);
    }

    public function uploadMethod(Request $request)
    {
        $albumId = $request->album_id == 'null' ? '1' : $request->album_id;

        try {

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file->getPathname());

                if (!in_array($fileType, ['image/jpeg','image/jpg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'])) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Unsupported image type.',
                    ], 400);
                }

            }
            if (!$request->hasFile('file')) {
                return response()->json([
                    'requestHasFile' => $request->hasFile('file'),
                    'error' => true,
                    'message' => 'No file uploaded!',
                ], 400);
            }

            $file = $request->file('file');
            $filenameWithoutExt = time();
            $extension = '.webp';

            DB::beginTransaction();

            $originalFilePath = $this->saveImage($file, 'origin', $filenameWithoutExt, $extension);

            $mediumFilePath = $this->saveImage($file, 'medium', $filenameWithoutExt, $extension, 800);

            $smallFilePath = $this->saveImage($file, 'small', $filenameWithoutExt, $extension, 400);

            $albumId = $request->album_id == 'null' ? '1' : $request->album_id;
            $imageModel = Image::create([
                'file_url' => asset($originalFilePath),
                'file_url_medium' => asset($mediumFilePath),
                'file_url_small' => asset($smallFilePath),
            ]);

            $albumExists = Album::find($albumId) !== null;
            if ($albumExists) {
                $pendingAlbumId = session('pending_album_id', null) ?: $albumId;
                AlbumImage::create([
                    'album_id' => $pendingAlbumId,
                    'image_id' => $imageModel->id
                ]);
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded',
                'image' => json_encode($imageModel)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => 'Error uploading file: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function saveImage($file, $folder, $filenameWithoutExt, $extension, $resizeWidth = null)
    {
        $filePath = "uploads/$folder/" . $filenameWithoutExt . $extension;
        Log::info('before ImageIntervention');
        $image = ImageIntervention::make($file)->encode('webp', 75);
        Log::info('after ImageIntervention');

        if ($resizeWidth) {
            $image->resize($resizeWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $image->save(public_path($filePath));
        return $filePath;
    }
}
