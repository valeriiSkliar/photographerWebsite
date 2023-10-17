<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
<div class="container">
    <h1>Редактировать Альбом</h1>

    <form action="{{ route('albums.update', $album->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $album->title }}">
            {{-- Edit button for title --}}
        </div>

        <div class="form-group">
            <label for="sub_text">Подтекст</label>
            <input type="text" class="form-control" id="sub_text" name="sub_text" value="{{ $album->sub_text }}">
            {{-- Edit button for sub_text --}}
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ $album->description }}</textarea>
            {{-- Edit button for description --}}
        </div>
        <div class="form-group">
            {{--        <label>--}}
            {{--            Album Cover: <input type="file" name="new_album_cover" accept="image/*">--}}
            {{--        </label>--}}
        </div>


        <h2>Фотографии в альбоме:</h2>
        @foreach($album->images as $image)
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
        @endforeach

        {{-- Update the album --}}
        <button type="submit" class="btn btn-success">Обновить Альбом</button>
    </form>

        <br>
        <a href="javascript:void(0);" onclick="updateAlbumPhoto()">
            <button>Add photo to Album:</button>
        </a>

        <div id="newAlbumFields" style="display: none;">
            <div id="my-dropzone-album-update" class="dropzone"></div>
        </div>



    <script>

        let albumId = {{ $album->id }};


        function updateAlbumPhoto() {
            const newAlbumFields = document.getElementById('newAlbumFields');
            newAlbumFields.style.display = 'block';
{{--// Send AJAX request to create new album (assuming route is /create-album)--}}
{{--            fetch('/create-album', {--}}
{{--                method: 'POST',--}}
{{--                headers: {--}}
{{--                    'Content-Type': 'application/json',--}}
{{--                    'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
{{--                },--}}
{{--            })--}}
{{--                .then(response => response.json())--}}
{{--                .then(data => {--}}
                    if (albumId) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'album_id';
                        hiddenInput.value = albumId;

                        document.querySelector('form').appendChild(hiddenInput);

                        document.getElementById('newAlbumFields').style.display = 'block';
                    }
                // });
        }

        Dropzone.autoDiscover = false;

        new Dropzone("#my-dropzone-album-update", {
            url: "/upload",
            maxFiles: 10,
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("album_id", albumId);
            }
        });

    </script>

    {{-- Delete the album --}}
    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить Альбом</button>
    </form>
</div>
