@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h1>Create Section</h1>
            </div>
            <div class="col-6">
                <h1>Section Content</h1>

            </div>
        </div>
        <form
            action="{{ route('sections.store') }}"
            method="post"
            enctype="multipart/form-data"
            class="mt-4 row">
            @csrf

            <div class="form-group col-2">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group col-2">
                <label for="page_id">Page:</label>
                <select name="page_id" id="page_id" class="form-control">
                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}">{{ $page->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-1">
                <label for="order">Order:</label>
                <input type="number" name="order" id="order" class="form-control" value="0">
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="form-group col-3">
                        <label for="font">Font:</label>
                        <input type="text" name="font" id="font" class="form-control" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="font_color">Font Color:</label>
                        <input type="color" name="font_color" id="font_color" class="form-control" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="background_color">Background Color:</label>
                        <input type="color" name="background_color" id="background_color" class="form-control" required>
                    </div>
                    <div class="form-group col-3">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Description:</label>
                        <textarea
                            style="min-height: 150px; height: fit-content"
                            name="description"
                            id="description"
                            class="form-control"
                            required></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="content_text">Content Text:</label>
                        <textarea name="content_text" id="content_text" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="background_image">Background Image:</label>
                        <input type="file" name="background_image" id="background_image" class="form-control-file" accept="image/*">
                    </div>
                </div>
            </div>

            <h2 class="col-12 mt-4">Section Components</h2>

            <div class="col-4 mt-4">
                <input type="submit" value="Create" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
