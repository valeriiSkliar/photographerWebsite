<div>Second</div>

<div class="portfolio_albums_list">
    @foreach ($album->images as ['file_url'=>$url])
    <div class="portfolio_albums_title" style="background-image: url({{$url}})">
        <div class="album_cover_name">
            session
        </div>
    </div>
    @endforeach
</div>

{{-- @foreach ($details as ['value'=>$maker])
{{$maker}}
@endforeach  --}}
