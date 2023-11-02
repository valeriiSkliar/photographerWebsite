@extends('layouts.iframe')

@section('admin.content')

    <div class="container mt-5">
        <h4>Component {{ $component->type }}</h4>
{{--        <p><span class="font-weight-bold">{{ $component->section->name }}</span> section</p>--}}
        <p class="mt-3">Order: <span class="font-weight-bold">{{ $component->order }}</span></p>

        <div class="accordion" id="componentDetailsAccordion">
            <div class="card">
                <div class="card-header" id="componentDetailsHeading">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#componentDetails" aria-expanded="true" aria-controls="componentDetails">
                            Show Component  Details
                        </button>
                    </h5>
                </div>

                <div id="componentDetails" class="collapse" aria-labelledby="componentDetailsHeading" data-parent="#componentDetailsAccordion">
                    <div class="card-body">
                        <ul class="list-group mt-3">
                            @foreach($component->details as $detail)
                                <li class="list-group-item"><strong class="mr-3">{{ $detail->key }} :</strong> {{ $detail->value }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($component->album)
            <div class="mt-4 d-flex flex-wrap">
                @foreach($component->album->images as $image)
                    <div class="col-md-3 mb-4 position-relative">
                        <img src="{{ asset($image->file_url) }}" alt="" class="img-fluid" style="max-width: 150px"> <!-- Increase the size of the image -->
                        <div class="mt-2">
                            <a href="{{ route('images.edit', $image) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                            <form action="{{ route('images.destroy', $image) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('components.edit', $component) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

@endsection
