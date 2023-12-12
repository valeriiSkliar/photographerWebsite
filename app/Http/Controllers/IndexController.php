<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Component\Component;
use App\Models\MetaData\MetaTags;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pageSlug = $this->getPageSlug($request);
        $page = $this->getPageData($pageSlug);

        return view($pageSlug, [
            'page' => $page,
            'meta_tags' => $this->getMetaTags($page),
        ]);
    }

    private function getPageSlug(Request $request): string {
        $uri = $request->route()->uri;
        return $this->getSlugFromUri($uri);
    }
    private function getSlugFromUri(string $uri): string {
        $pageSlug = '/';
        if(Str::startsWith($uri, 'de')) {
            App::setLocale('de');
            $pageSlug = Str::replaceFirst('de/', '', $uri);
            if (!$pageSlug) {
                $pageSlug = '/';
            }
        }
        else {
            App::setLocale('en');
        }

        return ($pageSlug === '/' || $pageSlug === 'de') ? 'main' : $pageSlug;
    }

    private function getPageData(string $pageSlug): Page {
        $page = Page::with([
            'components' => function ($query) {
                $query->orderBy('order');
            },
            'components.album.images',
            'components.details.translations',
        ])
            ->where('slug', $pageSlug)
            ->first();

        if (!$page) {
            abort(404);
        }

        return $page;
    }

    private function getMetaTags(Page $page) {
        return MetaTags::where('page_id', '=', $page->id)->get();
    }
}
