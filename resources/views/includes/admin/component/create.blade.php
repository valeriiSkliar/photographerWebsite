<h1>Add Component</h1>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>

<form method="POST" action="{{ route('components.store') }}">
    @csrf

    <label>Section:</label>
    <select type="text" name="section_id" required>
        @foreach($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>

    <label>Type:</label>
    <input type="text" name="type" required>

    <label>Name:</label>
    <input type="text" name="name">

    <h2>Component Details</h2>
    <div id="component-details">
        <div class="component-detail">
            <label>Key:</label>
            <input type="text" name="details[0][key]" required>

            <label>Value:</label>
            <input type="text" name="details[0][value]" required>
        </div>
        <!-- More ComponentDetail forms will be added here dynamically -->
    </div>
    <button type="button" id="addComponentDetail">Add Another Detail</button>
    @if(isset($album))
        <h2>Album</h2>
        <label>
            Existing Album:
            <select name="album_id">
                <option value="">Select Album</option>
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                @endforeach
            </select>
        </label>
        <br>
    @endif
    <br>
    <a href="javascript:void(0);" onclick="createNewAlbum()">Create New Album:</a>

    <div id="newAlbumFields" style="display: none;">
        <div id="my-dropzone" class="dropzone"></div>
        <br>
        <label>
            Album Title: <input type="text" name="title">
        </label>
        <br>
        <label>
            Album sub_text: <textarea name="sub_text"></textarea>
        </label>
        <br>
        <label>
            Album Description: <textarea name="description"></textarea>
        </label>
        <br>
{{--        <label>--}}
{{--            Album Cover: <input type="file" name="new_album_cover" accept="image/*">--}}
{{--        </label>--}}
    </div>

    <br>
    <button type="submit">Save</button>
</form>

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

                    // Show album creation fields
                    document.getElementById('newAlbumFields').style.display = 'block';
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

