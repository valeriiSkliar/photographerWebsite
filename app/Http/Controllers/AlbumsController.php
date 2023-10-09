<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
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
