<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pageSlug = $request->route()->uri;

        if ($pageSlug == '/') {
//            dd('test');
            $pageSlug = 'main';
//            $page = Page::find(1);
//            return view('index', compact('page'));
        }

        $page = Page::with('sections.components.album.images')
            ->where('slug', $pageSlug)
            ->first();

        $all_pages = Page::all();

        if (!$page) {
            abort(404, 'Page not found');
        }

        return view($pageSlug, compact('page', 'all_pages'));
    }
}
