@extends('layouts.app')

@section('content')
    @foreach($page->sections as $section)
        @if($section->sectionComponents)
            @foreach($section->sectionComponents as $component)
                @include('sectionComponents.frontend.' . $component->template_name)
                @if($component->album)
                @endif
            @endforeach
        @endif
    @endforeach
@endsection
