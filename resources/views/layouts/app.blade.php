<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="alternate" hreflang="en" href="{{config('app.url') . 'en'}}">
    <link rel="alternate" hreflang="de" href="{{config('app.url') . 'de'}}">
    <link rel="alternate" hreflang="x-default" href="{{config('app.url')}}">
    <meta name="available-lang" content="{{implode(",", config('app.available_locales'))}}">
    <meta name="robots" content="max-snippet:300, max-image-preview:large, max-video-preview:-1">
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
    @include('includes.page_meta_tags')
    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/allison-script" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&family=Lora&display=swap" rel="stylesheet">
{{--    @dd($contact)--}}
    <script type="application/ld+json">{"@context":"http://schema.org","@type":"Organization","brand":"{{ucfirst(config('app.name'))}}","logo":"{{asset('/logo/logo-yavorskaphotography.png')}}","name":"{{ucfirst(config('app.name'))}}","url":"{{config('app.url')}}","department":[{"@context":"http://schema.org","@type":"Organization","name":"{{ucfirst(config('app.name'))}}","image":"{{asset('/openGraff/banner-for-social-share.jpg')}}",@if(isset($contact->country) && isset($contact->city) && isset($contact->address)) "address":{"@type":"PostalAddress","addressCountry":"{{ $contact->country }}", "addressLocality":"{{ $contact->city }}","streetAddress": "{{ $contact->address }}"},"location":{"@type":"Place","geo":{"@type": "GeoCoordinates","latitude": "47.72802819483339","longitude": "12.877527818507355"}},@endif @if(isset($contact->email) || isset($contact->phone)) "email":"{{ $contact->email }}","telephone":"{{ $contact->phone }}"@endif}]}</script>
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('custom-style')
</head>
<body x-data="{ openMenu : false }">
<div id="app">
    @include('includes.header')
    <main>
        @yield('content')
    </main>
    @include('includes.footer')
</div>
@stack('custom-script')
</body>
</html>
