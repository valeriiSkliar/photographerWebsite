@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="{{$page->id}}" />
@endsection
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
{{--@section('content')--}}
{{--    @include('pages.includes.first_section_about')--}}
{{--@endsection--}}
