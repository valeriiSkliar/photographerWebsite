<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Component\Component;
use App\Models\Page;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pageSlug = $request->route()->uri;

        if ($pageSlug == '/') {
            $pageSlug = 'main';

        }

        $page = Page::with('components.album.images')
            ->where('slug', $pageSlug)
            ->first();

//        dd($page);
        if (!$page) {
            abort(404, 'Page not found');
        }

        return view($pageSlug, compact('page'));
    }
}
