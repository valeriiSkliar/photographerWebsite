@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h3>Images</h3>
                <a href="{{ route('images.create') }}" class="btn btn-primary">Add New Image</a>
            </div>
        </div>

        <div class="row">
            @forelse($images as $image)
                <div class="col-md-3 mb-4 position-relative">
                    <img src="{{ $image->file_url }}" alt="{{ $image->alt_text }}" class="img-fluid">

                    <!-- Tooltip Information -->
                    <div tabindex="0" data-toggle="tooltip" title="Rank: {{ $image->rank }} | Alt: {{ $image->alt_text }} | Status: {{ $image->status }} | Visibility: {{ $image->visibility }}" data-placement="bottom" style="position: absolute; bottom: 5px; right: 5px;">
                        <i class="fa fa-info-circle"></i>
                    </div>

                    <!-- Controls -->
                    <div class="image-controls" style="position: absolute; top: 5px; right: 5px;">
                        <a href="{{ route('images.edit', $image) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                        <form action="{{ route('images.destroy', $image) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No images found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
