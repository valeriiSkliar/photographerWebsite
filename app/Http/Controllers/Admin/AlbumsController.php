<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlbumsController extends Controller
{
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
            $album->delete();

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

        // Handle any image updates, additions, or deletions here

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
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
