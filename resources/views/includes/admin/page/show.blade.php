@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h1>Page Details</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Edit Page</a>
            </div>
        </div>

        <div class="mt-4">
            <ul class="list-group">
                <li class="list-group-item"><strong>ID:</strong> {{ $page->id }}</li>
                <li class="list-group-item"><strong>Name:</strong> {{ $page->name }}</li>
                <li class="list-group-item"><strong>Slug:</strong> {{ $page->slug }}</li>
                <li class="list-group-item"><strong>Title:</strong> {{ $page->title }}</li>
                <li class="list-group-item"><strong>Meta Data:</strong> {{ $page->meta_data }}</li>
            </ul>
        </div>

        @if($page->sections && count($page->sections) > 0)
            <h2 class="mt-4">Sections</h2>
            <ul class="list-group">
                @foreach($page->sections as $section)
                    <li class="list-group-item">{{ $section->name }}</li>
                @endforeach
            </ul>
        @else
            <p class="mt-4">No sections associated with this page.</p>
        @endif
    </div>
@endsection
