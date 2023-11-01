@extends('imagemanager::layouts.master')
    @pushonce('iframe.style')
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    @endpushonce

    @pushonce('iframe.script')
        <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @endpushonce

@pushonce('iframe.script')
    @if(session('success_message'))
        <script>
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Success',
                text: '{{ session('success_message') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                background: 'rgba(0,0,0,0)',
                padding: '0.5rem',
            });
        </script>
    @endif

    @if(session('error_message'))
        <script>
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Error',
                text: '{{ session('error_message') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                background: '#dc3545',
                padding: '0.5rem',
            });
        </script>
    @endif
@endpushonce
@section('content')
    <div class="col-6">
        <div class="my-4">
            <a class="btn btn-success mb-4" href="javascript:void(0);" onclick="createNewAlbum()">Create New Album</a>
            <form method="POST">
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
                    <button onclick="saveNewAlbum();" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($albums as $album)
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="card">
{{--                    <img src="{{ asset($album->images->first()->file_url) ?? '' }}" alt="{{ $album->title }}" title="{{ $album->title }}"--}}
                         class="card-img-top">
                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                        <a
                            href="{{ route('albums.edit', $album) }}"
                            class="btn btn-primary"
                        >
                            Edit
                        </a>
                        {{-- Other album controls like delete, etc. --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('imagemanager.create') }}">Upload images</a>
    <h4 class="my-4">All Images</h4>
    <div class="row px-3">
        @foreach($images as $image)
            <div class="col-lg-2 col-md-3 col-sm-4 mb-4">
                <div class="card">
                    <img
                        src="{{ asset($image->file_url) }}"
                        alt="{{ $image->alt_text }}"
                        title="{{ $image->title }}"
                        class="card-img-top">
                    <div tabindex="0" data-toggle="tooltip" title="Rank: {{ $image->rank }} | Alt: {{ $image->alt_text }} | Status: {{ $image->status }} | Visibility: {{ $image->visibility }}" data-placement="bottom" style="position: absolute; bottom: 5px; right: 5px;">
                        <i class="fa fa-info-circle"></i>
                    </div>

                    <!-- Controls -->
                    <div class="image-controls" style="position: absolute; top: 5px; right: 5px;">
                        <a href="{{ route('images.edit', $image->id) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                        <form action="{{ route('imagemanager.destroy', $image) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>

        function saveNewAlbum() {
            fetch('{{ route('save_album', $album) }}', {
            // fetch('imagemanager/save-album', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(data => console.log(data))
        }
        let albumId = null;

        function createNewAlbum() {
            const newAlbumFields = document.getElementById('newAlbumFields');
            newAlbumFields.style.display = 'block';
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
                        successAlert(data.message);
                    }
                });
        }

        function successAlert(message) {
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                background: 'rgba(0,0,0,0)',
                padding: '0.5rem',
            });
        }

        Dropzone.autoDiscover = false;

        new Dropzone("#my-dropzone", {
            url: "/admin/imagemanager",
            maxFiles: 10,
            maxFilesize: 2, // MB
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                console.log(albumId);
                formData.append("album_id", albumId);
            }
        });

    </script>

@endsection
