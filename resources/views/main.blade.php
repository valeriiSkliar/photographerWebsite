@extends('layouts.app')

@section('content')
    main
    @foreach($page->sections as $section)
        {{ $section->name }}
        <br>
        @if($section->components)
            @foreach($section->components as $component)
                <h1>{{ $component->name }}</h1>
                @if($component->album)
                    @include('pages.includes.swiper_slider')
                @endif
            @endforeach
        @endif
    @endforeach
@endsection
