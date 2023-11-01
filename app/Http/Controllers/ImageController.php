<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('includes.admin.gallery.image.index', compact('images'));
    }

    public function create()
    {
        return view('includes.admin.gallery.image.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file_url' => 'required|string',
            'rank' => 'nullable|integer',
            'title' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'metadata' => 'nullable|string',
            'status' => 'nullable|string',
            'visibility' => 'nullable|string',
        ]);

        Image::create($data);

        return redirect()->route('images.index')->with('success', 'Image created successfully.');
    }

    public function show(Image $image)
    {
        return view('includes.admin.gallery.image.show', compact('image'));
    }

    /**
     * Show the form for editing the specified image.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Image $image)
    {
        return view('includes.admin.gallery.image.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $data = $request->validate([
            'file_url' => 'required|string',
            'rank' => 'nullable|integer',
            'title' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'metadata' => 'nullable|string',
            'status' => 'nullable|string',
            'visibility' => 'nullable|string',
        ]);

        $image->update($data);

        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(Image $image)
    {
//        dd($image);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
