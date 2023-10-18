@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold underline">
        if underline TailWind is work!
    </h1>
@php
//$sections = $page;
//$data = $components[1]->load('album');
//$album = $data[0]->album;
@endphp
    @foreach($page->sections as $section)
            {{ $section->name }}
            <br>
            @if($section->components)
                @foreach($section->components as $component)
                    <h1>{{ $component->name }}</h1>
                @endforeach
            @endif
    @endforeach
{{--    {{ debug($components) }}--}}
{{--    {{ dd($album->images) }}--}}
{{--    @foreach($index_page->sections as $section)--}}
{{--        @foreach($component->album->load('images')->images as $image)--}}
{{--            <img width="100" src="{{ asset($image->file_url) }}" alt="">--}}
{{--            {{ dd($component->album->load('images')->images) }}--}}
{{--        @endforeach--}}
{{--    @endforeach--}}
{{--    @if($album->images)--}}
{{--        <x-image-carousel :images="$album->images" />--}}
{{--    @endif--}}
@endsection

    {{--            @if (Route::has('login'))--}}
    {{--                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
    {{--                    @auth--}}
    {{--                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>--}}
    {{--                    @else--}}
    {{--                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>--}}

    {{--                        @if (Route::has('register'))--}}
    {{--                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
    {{--                        @endif--}}
    {{--                    @endauth--}}
    {{--                </div>--}}
    {{--            @endif--}}


