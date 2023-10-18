@extends('layouts.iframe')
@section('admin.content')
<div class="container">
    <div class="row">
{{--        {{ dd($page) }}--}}
        <div class="col-md-8 offset-md-2">
            <h2>Edit Page</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.pages.update', $page) }}"
                method="POST"
            >
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $page->name) }}">
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}">
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $page->title) }}">
                </div>

                <div class="form-group">
                    <label for="meta_data">Meta Data:</label>
                    <input type="text" id="meta_data" name="meta_data" class="form-control" value="{{ old('meta_data', $page->meta_data) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Page</button>
            </form>

        </div>
    </div>
</div>
@endsection
