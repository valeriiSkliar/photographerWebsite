<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class SongsController extends Controller
{
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\SongForm', [
            'method' => 'POST',
            'url' => route('song.store')
        ]);

        return view('songs.create', compact('form'));
    }
}
