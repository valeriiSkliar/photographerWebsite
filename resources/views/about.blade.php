@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="{{$page->id}}" />
@endsection
@section('content')

    @foreach($page->sections as $section)
        {{ $section->name }}
        <br>

    @endforeach
@endsection
