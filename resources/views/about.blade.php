@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="{{$page->id}}" />
@endsection
@section('content')
    @include('pages.includes.first_section_about')
@endsection
