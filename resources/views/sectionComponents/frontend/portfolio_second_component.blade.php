<div class="portfolio_albums_list">
    @foreach ($album->images as ['file_url'=>$url, 'title'=>$title_cover])
    <div class="portfolio_albums_title" style="background-image: url({{$url}})">
        <div class="album_cover_name">
            {{$title_cover}}
        </div>
    </div>
    @endforeach
</div>

