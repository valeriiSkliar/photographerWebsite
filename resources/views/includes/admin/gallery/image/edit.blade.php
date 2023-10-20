@extends('layouts.iframe')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h3>Edit Image</h3>
                {{ $image }}
                <form action="{{ route('images.update', $image) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="file_url" class="form-label">File URL</label>
                        <input type="text" class="form-control" id="file_url" name="file_url" value="{{ $image->file_url }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="rank" class="form-label">Rank</label>
                        <input type="number" class="form-control" id="rank" name="rank" value="{{ $image->rank }}">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $image->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="alt_text" class="form-label">Alt Text</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text" value="{{ $image->alt_text }}">
                    </div>

                    <div class="mb-3">
                        <label for="metadata" class="form-label">Metadata</label>
                        <textarea class="form-control" id="metadata" name="metadata" rows="4">{{ $image->metadata }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ $image->status }}">
                    </div>

                    <div class="mb-3">
                        <label for="visibility" class="form-label">Visibility</label>
                        <input type="text" class="form-control" id="visibility" name="visibility" value="{{ $image->visibility }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('images.index') }}" class="btn btn-secondary">Back to Images</a>
                </form>
            </div>
        </div>
    </div>
@endsection
