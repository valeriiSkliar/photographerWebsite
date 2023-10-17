<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
<h1>Gallery</h1>

<form method="POST" action="{{ route('albums.store') }}">
    @csrf
    <br>
    <a href="javascript:void(0);" onclick="createNewAlbum()"><button>Create New Album:</button></a>

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


<h2>Albums</h2>
@foreach($albums as $album)
    <div class="album">
        <h3>{{ $album->title }}</h3>
        <p>{{ $album->sub_text }}</p>
        <p>{{ $album->description }}</p>

        <h4>Album pictures:</h4>
        <div class="album-images">
            @foreach($album->images as $image)
                <img src="{{ $image->file_url }}" style="max-width: 60px" alt="{{ $image->alt_text }}"
                     title="{{ $image->title }}">
            @endforeach
        </div>

        <a href="{{ route('albums.edit', $album) }}"><button>Edit album</button></a>
        {{-- Кнопки управления для альбома (редактировать, удалить и т.д.) --}}
    </div>
@endforeach

<h2>All photo</h2>
<div class="all-images">
    @foreach($images as $image)
        <img src="{{ $image->file_url }}" style="max-width: 60px" alt="{{ $image->alt_text }}"
             title="{{ $image->title }}">

        {{-- Кнопки управления для каждого изображения (редактировать, удалить и т.д.) --}}
    @endforeach
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
