<style>
    .albums-container {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .album {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
        transition: transform 0.3s;
    }

    .album:hover {
        transform: scale(1.05);
    }

    .album img {
        max-width: 200px;
        height: auto;
        display: block;
        margin: 0 auto;
    }
</style>
<div class="albums-container">
    @foreach($albums as $album)
        <a href="{{ route('show_album', ['id' => $album->id]) }}" class="album">
            <img src="{{  $album->coverImage->file_url }}" alt="Album 1 Title">
            <div>{{ $album->title }}</div>
        </a>
    @endforeach
</div>
