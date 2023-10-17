<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::with('images')->get();
        $images = Image::all();

        return view('includes.admin.gallery.index', compact('albums', 'images'));
    }
}
