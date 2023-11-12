<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlbumsController extends Controller
{

    public function unPinImage(Request $request)
    {
        $albumId = $request['album_id'];
        $imageId = $request['image_id'];
        $album = Album::findOrFail($albumId);

        if ($album->images()->find($imageId)) {
            $album->images()->detach($imageId);

            return response()->json([
                'success' => true,
                'message' => 'Image successfully removed from the album.'
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Image not found in the specified album.'
            ], 404);
        }
    }

    public function index()
    {
        $albums = Album::all();
        $images = Image::all();

        return view('includes.admin.gallery.index', compact('albums', 'images'));
    }

    public function create()
    {
        return view('includes.admin.gallery.album.create');
    }

    public function store(Request $request)
    {
        $pendingAlbumId = session('pending_album_id', null);

        if(!$pendingAlbumId) {
            return response()->json(['error' => 'No pending album found'], 400);
        }
        $album = Album::find($pendingAlbumId);
        if (!$album->images->count()) {
            Session::flash('error_message','Album creating canceled!.');
            $album->forceDelete();

            return redirect()->route('gallery.index');
        } else {
            $request->session()->forget('pending_album_id');
            $album->update($request->only(['title', 'sub_text', 'description']));
            Session::flash('success_message','Album creating complete successfully!.');
        }
//        $album = null;
//        dd($request->album_id);
//        if (!$request->album_id) {
//            $album = Album::create();
//            return response(['success' => true, 'album_id' => $album->id]);
//        }
//        $album = Album::find($request->album_id);
//        $album->update($request->only(['title', 'sub_text', 'description']));

        return redirect()->route('gallery.index')->with('success', 'Album created successfully.');
    }

    public function edit(Album $album)
    {
        return view('includes.admin.gallery.album.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $album->update($request->only(['title', 'sub_text', 'description']));


        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        try {
            $album->forceDelete();
            Session::flash('success_message','Album successfully delete!.');

        }catch (\Exception $e) {
            Session::flash('error_message','Error during delete' . $e->getMessage());

        }
        return redirect()->route('albums.index');
    }

    public function __invoke(Request $request)
    {
        $albums = Album::all();
        return view('pages.all_albums', compact('albums'));
    }
    public function show_album(Request $request)
    {
        $images = Image::where('album_id', '=', $request->id)->get();
        return view('pages.show_album', compact('images'));
    }
}
