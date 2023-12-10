<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Component\Component;
use App\Models\MetaData\MetaTags;
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

        $page = Page::with(['components' => function ($query) {
            $query->orderBy('order');
        }, 'components.album.images','components.details.translations',])
            ->where('slug', $pageSlug)
            ->first();
        if (!$page) {
            abort(404);
        }
        $meta_tags = MetaTags::where('page_id', '=', $page->id)->get();

        return view($pageSlug, compact('page', 'meta_tags'));
    }
}
