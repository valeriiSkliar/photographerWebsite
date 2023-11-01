@extends('layouts.iframe')
@pushonce('iframe.style')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpushonce

@pushonce('iframe.script')
    @if(session('success_message'))
        <script>
            Swal.fire(sweetAlertConfigs.success("{{ session('success_message') }}"));
        </script>
    @endif
    @if(session('error_message'))
        <script>
            Swal.fire(sweetAlertConfigs.error("{{ session('error_message') }}"));
        </script>
    @endif
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpushonce
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
                            <a class="btn btn-success mb-4" href="javascript:void(0);" onclick="createNewAlbum()">Create
                                New Album</a>
                            <form method="POST" action="{{ route('albums.store') }}">
                                @csrf
                                <div id="newAlbumFields" style="display: none;" class="mb-4">
                                    {{--                                    <div id="my-dropzone" class="dropzone mb-4"></div>--}}
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
                                    <button type="submit" class="btn btn-warning">Cansel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-3">
                        <form
                            style="max-height: 450px; overflow-y: auto"
                            enctype="multipart/form-data"
                            class="dropzone"
                            id="my-dropzone">
                            @csrf
                        </form>
                    </div>
                </div>
                <h4 class="my-4">Albums</h4>
                <div class="row">
                    @foreach($albums as $album)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                @if($album->images->first())
                                    <img src="{{ asset($album->images->first()->file_url) ?? '' }}"
                                         alt="{{ $album->title }}" title="{{ $album->title }}"
                                         class="card-img-top">
                                @endif
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
                <div class="row m-4">
                    <div class="col-3">
                        <h1 class="my-4">All Photos</h1>
                    </div>
                </div>

                <div class="actions mt-4">
                    <button class="btn btn-danger" onclick="deleteSelectedImages()">Delete Selected</button>
                    <button class="btn btn-primary" onclick="addToAlbum()">Add to Album</button>
                    <select id="albumSelect">
                        <option value="">=== Select album ===</option>
                        {{--                            @dd($album)--}}
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="row px-3">

                    <div class="col-12 mb-2">
                        <input type="checkbox" id="selectAll" onchange="selectAllImages()"> <label for="selectAll">Select
                            All</label>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="row" id="images">
                            @foreach($images as $image)
                                <div class="col-md-2">
                                    <div class="card">
                                        <input type="checkbox" class="image-checkbox" data-image-id="{{ $image->id }}"
                                               style="position: absolute; top: 5px; left: 5px;">

                                        <img
                                            src="{{ asset($image->file_url) }}"
                                            alt="{{ $image->alt_text }}"
                                            title="{{ $image->title }}"
                                            class="card-img-top">
                                        <div tabindex="0" data-toggle="tooltip"
                                             title="Rank: {{ $image->rank }} | Alt: {{ $image->alt_text }} | Status: {{ $image->status }} | Visibility: {{ $image->visibility }}"
                                             data-placement="bottom"
                                             style="position: absolute; bottom: 5px; right: 5px;">
                                            <i class="fa fa-info-circle"></i>
                                        </div>

                                        <!-- Controls -->
                                        <div class="image-controls" style="position: absolute; top: 5px; right: 5px;">
                                            <a href="{{ route('images.edit', $image) }}"
                                               class="btn btn-sm btn-warning mr-1">Edit</a>
                                            <form action="{{ route('images.destroy', $image) }}" method="POST"
                                                  class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
    <script>


        function selectAllImages() {
            const allImages = document.querySelectorAll('.image-checkbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            allImages.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
        }

        function deleteSelectedImages() {
            const selectedImageCheckboxes = [...document.querySelectorAll('.image-checkbox:checked')];

            const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
            if (selectedImages.length) {
                fetch('/delete-selected-images', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({images: selectedImages})
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                            });

                            selectedImageCheckboxes.forEach(checkbox => {
                                const parentCard = checkbox.closest('.col-md-2');
                                if (parentCard) {
                                    parentCard.remove();
                                }
                            });
                        } else {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete selected images',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                            });
                        }
                    });
            }
        }

        function addToAlbum() {
            const albumSelect = document.getElementById('albumSelect');
            const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
            if (selectedImages.length) {
                fetch('/add-selected-images', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        images: selectedImages,
                        album_id: albumSelect.value
                    })
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                            });

                        } else {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete selected images',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                            });
                        }
                    })
            }
        }

        let albumId = null;

        function createNewAlbum() {
            [...document.querySelectorAll('.dz-preview')].forEach(item => item.remove())
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
                    console.log(data.album_id)
                    if (data.success && data.album_id) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'album_id';
                        hiddenInput.value = data.album_id;
                        albumId = data.album_id;

                        document.querySelector('form').appendChild(hiddenInput);

                        document.getElementById('newAlbumFields').style.display = 'block';
                    }
                    if (data.success) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            background: 'rgba(0,0,0,1)',
                            padding: '0.5rem',
                        });

                    } else {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Error',
                            text: data.message ?? 'Failed to create album',
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            background: 'rgba(0,0,0,1)',
                            padding: '0.5rem',
                        });
                    }
                });
        }

        Dropzone.autoDiscover = false;

        new Dropzone("#my-dropzone", {
            url: "/upload",
            maxFiles: 10,
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("album_id", albumId);
            },
            success: function (file, response) {
                if (response.success) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: 'rgba(0,0,0,1)',
                        padding: '0.5rem',
                    });
                } else if (response.error) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: 'rgba(0,0,0,1)',
                        padding: '0.5rem',
                    });
                }
                if (response.success && response.image) {
                    const albumBlock = document.getElementById('images');

                    const imageResponse = JSON.parse(response.image);

                    const newImageBlock = document.createElement('div');
                    newImageBlock.classList.add('col-lg-2', 'col-md-4', 'col-sm-6', 'mb-4');

                    const cardDiv = document.createElement('div');
                    cardDiv.classList.add('card');

                    const checkbox = document.createElement('input');
                    checkbox.type = "checkbox";
                    checkbox.classList.add('image-checkbox');
                    checkbox.dataset.imageId = imageResponse.id;
                    checkbox.style.position = "absolute";
                    checkbox.style.top = "5px";
                    checkbox.style.left = "5px";
                    cardDiv.appendChild(checkbox);

                    const imgTag = document.createElement('img');
                    imgTag.src = imageResponse.file_url;
                    imgTag.alt = imageResponse.alt_text;
                    imgTag.title = imageResponse.title;
                    imgTag.classList.add('card-img-top');
                    cardDiv.appendChild(imgTag);

                    const imageControlsDiv = document.createElement('div');
                    imageControlsDiv.classList.add('image-controls');
                    imageControlsDiv.style.position = "absolute";
                    imageControlsDiv.style.top = "5px";
                    imageControlsDiv.style.right = "5px";

                    const editBtn = document.createElement('a');
                    editBtn.href = `/admin/images/${imageResponse.id}/edit`;
                    editBtn.classList.add('btn', 'btn-sm', 'btn-warning', 'mr-1');
                    editBtn.textContent = 'Edit';
                    imageControlsDiv.appendChild(editBtn);

                    const deleteForm = document.createElement('form');
                    deleteForm.action = `/admin/images/${imageResponse.id}`;
                    deleteForm.method = "POST";
                    deleteForm.classList.add('d-inline-block');

                    const csrfInput = document.createElement('input');
                    csrfInput.type = "hidden";
                    csrfInput.name = "_token";
                    csrfInput.value = "{{ csrf_token() }}";
                    deleteForm.appendChild(csrfInput);

                    const deleteMethodInput = document.createElement('input');
                    deleteMethodInput.type = "hidden";
                    deleteMethodInput.name = "_method";
                    deleteMethodInput.value = "DELETE";
                    deleteForm.appendChild(deleteMethodInput);

                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = "submit";
                    deleteBtn.classList.add('btn', 'btn-sm', 'btn-danger');
                    deleteBtn.textContent = 'Delete';
                    deleteForm.appendChild(deleteBtn);

                    imageControlsDiv.appendChild(deleteForm);
                    cardDiv.appendChild(imageControlsDiv);

                    newImageBlock.appendChild(cardDiv);
                    albumBlock.appendChild(newImageBlock);
                }
            }

        });

    </script>
@endsection
