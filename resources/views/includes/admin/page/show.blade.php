@extends('layouts.iframe')

@section('admin.content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $page->name }} - Page Details</h1>
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Edit Page</a>
            </div>
            <div class="col-md-6 text-right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-4">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID:</strong> {{ $page->id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $page->name }}</li>
                        {{--                        <li class="list-group-item"><strong>Slug:</strong> {{ $page->slug }}</li>--}}
                        <li class="list-group-item"><strong>Title:</strong> {{ $page->title }}</li>
                        {{--                        <li class="list-group-item"><strong>Meta Data:</strong> {{ $page->meta_data }}</li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-8">
                @if($page->meta_tags && count($page->meta_tags) > 0)
                    <h2>Meta teg list:</h2>
                    @foreach($page->meta_tags as $meta_tag)
                        {{ $meta_tag->type->type  }}: - {{ $meta_tag->value }} -- {{ $meta_tag->content }}
                        <br>
                    @endforeach
                @endif
            </div>
        </div>
        <hr>
        <div class="row">

            @if($page->sections && count($page->sections) > 0)
                @foreach($page->sections as $section)
                    <div class="col-md-6">
                        @include('includes.admin.section.show')
                    </div>
                    {{--                    <li class="list-group-item">{{ $section->name }}</li>--}}
                @endforeach
            @else
                <p class="mt-4">No sections associated with this page.</p>
            @endif
        </div>

    </div>
@endsection
