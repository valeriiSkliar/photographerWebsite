@extends('layouts.app')
@section('content')
    @section('metaData')
        <x-meta-data page_id="1"/>
    @endsection

    @php
        $sections = $index_page->sections;
        $component = $sections[0]->components[1]->load('album');
    @endphp
    {{--    {{ debug($index_page) }}--}}
    {{--    {{ debug($index_page->sections) }}--}}
    @foreach($index_page->sections as $section)
        @foreach($component->album->load('images')->images as $image)
            <img width="100" src="{{ asset($image->file_url) }}" alt="">
            {{--            {{ dd($component->album->load('images')->images) }}--}}
        @endforeach
    @endforeach
    {{--    <x-image-carousel :images="$images" />--}}
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


