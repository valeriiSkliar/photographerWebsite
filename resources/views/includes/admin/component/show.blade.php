@extends('layouts.iframe')
@section('admin.content')
<h1>Component {{ $component->type }}</h1>
<p>Component belong to <b>{{ $component->section->name }}</b> section</p>

<p>Order: {{ $component->order }}</p>

<h2>Component Details</h2>
<ul>
    @foreach($component->details as $detail)
        <li><strong>{{ $detail->key }}</strong>: {{ $detail->value }}</li>
    @endforeach
</ul>
@if($component->album)
{{--    {{dd($component->album->images)}}--}}
    @foreach($component->album->images as $image)
        <img src="{{ asset($image->file_url) }}" alt="" style="max-width: 100px">
    @endforeach
@endif
<br>
<a href="{{ route('components.edit', $component) }}">
    <button>Edit</button>
</a>
@endsection
