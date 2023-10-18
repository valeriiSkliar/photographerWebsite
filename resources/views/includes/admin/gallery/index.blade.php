@extends('layouts.iframe')
@section('admin.content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css"/>
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <h1 class="my-4">Gallery</h1>
                    </div>
                    <div class="col-6">
                        <div class="my-4">
                            <a class="btn btn-success mb-4" href="javascript:void(0);" onclick="createNewAlbum()">Create New Album</a>
                            <form method="POST" action="{{ route('albums.store') }}">
                                @csrf
                                <div id="newAlbumFields" style="display: none;" class="mb-4">
                                    <div id="my-dropzone" class="dropzone mb-4"></div>
                                    <div class="form-group">
                                        <label>Album Title:</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Album sub_text:</label>
                                        <textarea name="sub_text" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Album Description:</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <h2 class="my-4">Albums</h2>
                <div class="row">
                    @foreach($albums as $album)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="{{ $album->images->first()->file_url ?? '' }}" alt="{{ $album->title }}" title="{{ $album->title }}"
                                     class="card-img-top">
                                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                    <a
                                        href="{{ route('albums.edit', $album) }}"
                                        class="btn btn-primary"
{{--                                        //TODO add opasity for edit button :vs--}}
{{--                                        style="--bs-text-opacity: .5;"--}}
                                    >
                                        Edit
                                    </a>
                                    {{-- Other album controls like delete, etc. --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h2 class="my-4">All Photos</h2>
                <div class="row px-3">
                    @foreach($images as $image)
                        <div class="col-lg-1 col-md-3 col-sm-4 mb-4">
                            <div class="card">
                                <img
                                    src="{{ $image->file_url }}"
                                    alt="{{ $image->alt_text }}"
                                    title="{{ $image->title }}"
                                    class="card-img-top">
                                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                    {{-- Image controls like edit, delete, etc. --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
    <script>

        let albumId = null;

        function createNewAlbum() {
            const newAlbumFields = document.getElementById('newAlbumFields');
            newAlbumFields.style.display = 'block';
            // Send AJAX request to create new album (assuming route is /create-album)
            fetch('/create-album', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.album_id) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'album_id';
                        hiddenInput.value = data.album_id;
                        albumId = data.album_id;

                        document.querySelector('form').appendChild(hiddenInput);

                        document.getElementById('newAlbumFields').style.display = 'block';
                    }
                });
        }

        Dropzone.autoDiscover = false;

        new Dropzone("#my-dropzone", {
            url: "/upload",
            maxFiles: 10,
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                console.log(albumId);
                formData.append("album_id", albumId);
            }
        });

    </script>
@endsection
