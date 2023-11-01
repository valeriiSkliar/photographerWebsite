@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h3>Image Details</h3>

                <div class="mb-3">
                    <strong>ID:</strong> {{ $image->id }}
                </div>

                <div class="mb-3">
                    <strong>File URL:</strong> <a href="{{ $image->file_url }}" target="_blank">{{ $image->file_url }}</a>
                </div>

                <div class="mb-3">
                    <strong>Rank:</strong> {{ $image->rank }}
                </div>

                <div class="mb-3">
                    <strong>Title:</strong> {{ $image->title }}
                </div>

                <div class="mb-3">
                    <strong>Alt Text:</strong> {{ $image->alt_text }}
                </div>

                <div class="mb-3">
                    <strong>Metadata:</strong> <pre>{{ $image->metadata }}</pre>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong> {{ $image->status }}
                </div>

                <div class="mb-3">
                    <strong>Visibility:</strong> {{ $image->visibility }}
                </div>

                <a href="{{ route('images.edit', $image) }}" class="btn btn-warning">Edit Image</a>
                <a href="{{ route('images.index') }}" class="btn btn-secondary">Back to Images</a>
            </div>
        </div>
    </div>
@endsection

