@extends('layouts.iframe')
@section('admin.content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
<div class="container">
    <h1>Редактировать Альбом</h1>

    <form action="{{ route('albums.update', $album->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $album->title }}">
            {{-- Edit button for title --}}
        </div>

        <div class="form-group">
            <label for="sub_text">Subtext</label>
            <input type="text" class="form-control" id="sub_text" name="sub_text" value="{{ $album->sub_text }}">
            {{-- Edit button for sub_text --}}
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $album->description }}</textarea>
            {{-- Edit button for description --}}
        </div>
        <div class="form-group">
            {{--        <label>--}}
            {{--            Album Cover: <input type="file" name="new_album_cover" accept="image/*">--}}
            {{--        </label>--}}
        </div>


        <h2>Images in album:</h2>
        <div class="row">
            @foreach($album->images as $image)
                <div class="col-md-2 my-3" >
                    <div class="image-container">
                        <img
                            width="100px"
                            src="{{ asset($image->file_url) }}"
                            alt="{{ $image->alt_text }}"
                            title="{{ $image->title }}">

                        {{-- Edit & Delete buttons for each image --}}
                        {{--                <a href="{{ route('images.edit', $image->id) }}" class="btn btn-primary">Редактировать</a>--}}
                        {{--                <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="d-inline-block">--}}
                        {{--                    @csrf--}}
                        {{--                    @method('DELETE')--}}
                        {{--                    <button type="submit" class="btn btn-danger">Удалить</button>--}}
                        {{--                </form>--}}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Update the album --}}
        <button type="submit" class="btn btn-success">Обновить Альбом</button>
    </form>

    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить Альбом</button>
    </form>
</div>
@endsection
