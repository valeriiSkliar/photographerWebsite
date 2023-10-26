@extends('layouts.app')

@section('content')
    @foreach($page->sections as $section)
        @if($section->components)
            @foreach($section->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @if($album)
                    @include('pages.includes.swiper_slider')
                @endif
                @if($name === 'Thoughts')
                    @include('Pages.includes.section_thoughts')
                @endif
            @endforeach
        @endif
    @endforeach
@endsection
