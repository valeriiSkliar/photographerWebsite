@extends('layouts.iframe')

@section('admin.content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $page->name }} - Page Details</h1>
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Edit Page</a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-4">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID:</strong> {{ $page->id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $page->name }}</li>
                        <li class="list-group-item"><strong>Title:</strong> {{ $page->title }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                @if($page->meta_tags && count($page->meta_tags) > 0)
                    <h2>Meta tag list:</h2>
                    @foreach($page->meta_tags as $meta_tag)
                        {{ $meta_tag->type->type  }}: - {{ $meta_tag->value }} -- {{ $meta_tag->content }}
                        <br>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="col-md-6 text-left">
                    <!-- Add Component Button -->
                    <button
                        data-page="{{$page->id}}"
                        id="showAddComponentForm"
                        onclick="event.preventDefault()" class="btn btn-primary">Add Component</button>
                </div>
            </div>
            <div
                class="col-8"
                id="formContainer"></div>
            <div
                id="componentsListContainer"
                class="col-4">
                @include('includes.admin.component.ajax.page_components_list')
            </div>
        </div>
    </div>
    @vite('resources/js/show_page_view.js')
@endsection
