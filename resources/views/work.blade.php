@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="" />
@endsection
@section('content')
    <h1>Work</h1>
    @foreach($page->sections as $section)
        @if($section->sectionComponents)
            @foreach($section->sectionComponents as $sectionComponent)
                @include('sectionComponents.frontend.'.$sectionComponent->template_name)
            @endforeach
        @endif
    @endforeach
@endsection
