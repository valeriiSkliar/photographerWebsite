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
