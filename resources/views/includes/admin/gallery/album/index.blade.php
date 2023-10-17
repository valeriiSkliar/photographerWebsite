<h2>Albums</h2>
@foreach($albums as $album)
    <div class="album">
        <h3>{{ $album->title }}</h3>
        <p>{{ $album->sub_text }}</p>
        <p>{{ $album->description }}</p>

        <h4>Albums:</h4>
        <div class="album-images">
            @foreach($album->images as $image)
                <img
                    src="{{ asset($image->file_url) }}"
                    style="max-width: 60px"
                    alt="{{ $image->alt_text }}"
                     title="{{ $image->title }}">
            @endforeach
        </div>

        <a href="{{ route('albums.edit', $album) }}">Edit album</a>
    </div>
@endforeach
