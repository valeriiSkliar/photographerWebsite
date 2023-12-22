<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pageSlug = $this->getPageSlug($request);
        $page = $this->getPageData($pageSlug);

        $selectedLocation = $request->input('selected_location');

        if (!$request->cookie('selected_location')) {
            Cookie::queue('selected_location', $selectedLocation, 60*24*365);
        }

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
        $appLocales = config('app.available_locales');
        $pageSlug = null;
        foreach ($appLocales as $lang => $locale) {
            if(Str::startsWith($uri, $locale)) {
                App::setLocale($locale);
                $pageSlug = Str::replaceFirst($locale . '/', '', $uri);
                break;
            } else {
                $pageSlug = $uri;
            }
        }


        if (!$pageSlug) {
            $pageSlug = '/';
        }
        return ($pageSlug === '/' || in_array($pageSlug, $appLocales) ) ? 'main' : $pageSlug;
    }

    private function getPageData(string $pageSlug): Page {
        $page = Page::with([
            'components' => function ($query) {
                $query->orderBy('order');
            },
            'components.album.images',
            'components.details.translations',
            'meta_tags'
        ])
            ->where('slug', $pageSlug)
            ->first();

        if (!$page) {
            abort(404);
        }

        return $page;
    }

    private function getMetaTags(Page $page) {
        return $page->meta_tags;
    }
}
