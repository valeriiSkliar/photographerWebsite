@extends('layouts.iframe')

@section('admin.content')

    <div class="container mt-5">
        <h1>Component {{ $component->type }}</h1>
        <p>Component belongs to <span class="font-weight-bold">{{ $component->section->name }}</span> section</p>

        <p class="mt-3">Order: <span class="font-weight-bold">{{ $component->order }}</span></p>

        <h2 class="mt-4">Component Details</h2>
        <ul class="list-group mt-3">
            @foreach($component->details as $detail)
                <li class="list-group-item"><strong class="mr-3">{{ $detail->key }} :</strong> {{ $detail->value }}</li>
            @endforeach
        </ul>

        @if($component->album)
            <div class="mt-4">
                @foreach($component->album->images as $image)
                    <img src="{{ asset($image->file_url) }}" alt="" class="img-thumbnail" style="max-width: 100px">
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('components.edit', $component) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

@endsection
