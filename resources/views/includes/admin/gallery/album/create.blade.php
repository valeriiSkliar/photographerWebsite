
<h1>Gallery</h1>

<form method="POST" action="{{ route('albums.store') }}">
    @csrf
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

        <br>
        <button type="submit">Save</button>
    </div>


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
