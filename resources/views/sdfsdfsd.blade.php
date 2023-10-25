@extends('layouts.app')

@section('content')
    <h1>{{ $page->name }}</h1>
    <meta name="description" content="{{ $page->metadata }}">
@endsection