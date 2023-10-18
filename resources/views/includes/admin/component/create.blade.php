@extends('layouts.iframe')
@section('admin.content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="container mt-5">
        <h1 class="mb-4">Add Component</h1>

        <form method="POST" action="{{ route('components.store') }}">
            @csrf

            <div class="form-group">
                <label for="section_id">Section:</label>
                <select class="form-control" id="section_id" name="section_id" required>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <h2 class="my-4">Component Details</h2>

            <div id="component-details">
                <div class="form-row component-detail">
                    <div class="form-group col-md-6">
                        <label for="details[0][key]">Key:</label>
                        <input type="text" class="form-control" id="details[0][key]" name="details[0][key]" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="details[0][value]">Value:</label>
                        <input type="text" class="form-control" id="details[0][value]" name="details[0][value]" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="addComponentDetail">Add Another Detail</button>


            @if(isset($albums))
                <h2 class="my-4">Album</h2>
                <div class="form-group">
                    <label for="album_id">Existing Albums:</label>
                    <select class="form-control" id="album_id" name="album_id">
                        <option value="">Select Album</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <a href="javascript:void(0);" class="btn-success btn d-block my-3" onclick="createNewAlbum()">Create New Album:</a>

            <div id="newAlbumFields" style="display: none;">
                <div id="my-dropzone" class="dropzone mb-3"></div>

                <div class="form-group">
                    <label for="title">Album Title:</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>

                <div class="form-group">
                    <label for="sub_text">Album sub_text:</label>
                    <textarea class="form-control" id="sub_text" name="sub_text"></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Album Description:</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

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
                if(data.success && data.album_id) {
                    // Store the new album ID in a hidden input field
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'album_id';
                    hiddenInput.value = data.album_id;
                    albumId = data.album_id;

                    document.querySelector('form').appendChild(hiddenInput);

                }
            });
    }

    Dropzone.autoDiscover = false;

    new Dropzone("#my-dropzone", {
        url: "/upload",
        maxFiles: 10,
        sending: function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
            console.log(albumId);
            formData.append("album_id", albumId);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const componentDetailsContainer = document.getElementById('component-details');
        const addComponentDetailButton = document.getElementById('addComponentDetail');

        let detailCount = 1; // start from the second set, since one set already exists in the DOM

        addComponentDetailButton.addEventListener('click', function() {
            const newDetailDiv = document.createElement('div');
            newDetailDiv.className = 'component-detail';

            const keyLabel = document.createElement('label');
            keyLabel.textContent = 'Key:';
            const keyInput = document.createElement('input');
            keyInput.type = 'text';
            keyInput.name = `details[${detailCount}][key]`;
            keyInput.required = true;

            const valueLabel = document.createElement('label');
            valueLabel.textContent = 'Value:';
            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.name = `details[${detailCount}][value]`;
            valueInput.required = true;

            newDetailDiv.appendChild(keyLabel);
            newDetailDiv.appendChild(keyInput);
            newDetailDiv.appendChild(valueLabel);
            newDetailDiv.appendChild(valueInput);

            componentDetailsContainer.appendChild(newDetailDiv);

            detailCount++;
        });
    });
</script>
@endsection
