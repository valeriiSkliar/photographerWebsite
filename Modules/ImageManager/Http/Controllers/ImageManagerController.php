<?php

namespace Modules\ImageManager\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Image;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as ImageIntervention;
use Mockery\Exception;
use function Laravel\Prompts\error;

class ImageManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $images = Image::all();
        $albums = Album::all();
        return view('imagemanager::index', compact(['images', 'albums']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('imagemanager::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getFilename() . '.webp';
                $filePath = 'uploads/' . $filename;

                $image = ImageIntervention::make($file)
                    ->encode('webp', 75);
                $image->save(public_path($filePath));

                $imageModel = Image::create(['file_url' => $filePath]);
//                Session::flash('success_message', 'Image successfully uploaded');

                if ($request->album_id) {
//                    dd($request->album_id);
                    AlbumImage::create([
                        'album_id' => $request->album_id,
                        'image_id' => $imageModel->id
                    ]);
                    DB::commit();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Image successfully uploaded',
                    'filename' => $filename]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No file uploaded',
            ], 400);
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('imagemanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('imagemanager::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($imageId)
    {
        try {
            $image = Image::find($imageId);
            $fileFullPath = public_path($image->file_url);

            if (file_exists($fileFullPath)) {
                File::delete($fileFullPath);
            }
            Session::flash('success_message', 'Image successfully deleted');

            $image->delete();

        } catch (Exception $e) {
            Session::flash('error_message', 'Error during image deleting. Errot message ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function createAlbum(Request $request)
    {
        DB::beginTransaction();
        $album = Album::create();

        return response()->json([
            'success' => true,
            'message' => 'Album created, add images',
            'album_id' => $album->id]);
    }
    public function saveAlbum(Album $album, Request $request)
    {
//        dd($request);
        $request->except(['_token', '_method']);
        $data = $request->all();
        $album = Album::find($data);

        return response()->json([
            'success' => true,
            'message' => 'Album created, add images',
            'album_id' => $album->id]);
    }
}
