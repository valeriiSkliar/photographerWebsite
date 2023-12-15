<?php

function debugVar ($data) {
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    $text = preg_replace('~[^-\w]+~', '', $text);

    $text = trim($text, '-');

    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function current_user(): ?\Illuminate\Contracts\Auth\Authenticatable
{
    return auth()->user();
}
function normalizePath($path): array|string
{
    return str_replace('\\', '/', $path);
}

function linkByLocale($slug=null) {
    $current_locale = app()->getLocale();
    if($current_locale !== config('app.defaultLocale')) {
        if(($slug)){
            return ($current_locale.'.page.'.$slug);
        } else {
            return ($current_locale.'.index.page');
        }
    } else {
        if(($slug)){
            return('.page.' . $slug);
        } else {
            return ('.index.page');
        }
    }
};
