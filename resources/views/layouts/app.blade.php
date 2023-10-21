<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

{{--    <link rel="canonical" href="{{config('app.url')}}">--}}
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('/favicons/favicon-194x194.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/favicons/android-chrome-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('/favicons/android-chrome-512x512.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content="OlenaYavorska">
    <meta name="application-name" content="OlenaYavorska">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&family=Lora&display=swap" rel="stylesheet">
    @yield('metaData')
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('custom-style')
</head>
<body>
<div id="app">
    <x-nav-bar/>
    <main class="py-4">
        @yield('content')
    </main>
    <x-footer />
</div>
@stack('custom-script')
</body>
</html>
