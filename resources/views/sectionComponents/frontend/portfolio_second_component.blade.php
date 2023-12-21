<div class="portfolio_albums_list">
    @foreach ($album->images as ['file_url'=>$url, 'title'=>$title_cover, 'alt_text'=>$title_cover_de])
        @if ($title_cover)
            <div class="portfolio_albums_title" style="background-image: url({{$url}})">
                @if (app()->getLocale() === 'en')
                    <div class="album_cover_name">
                        {{$title_cover}}
                    </div>
                @endif
                @if (app()->getLocale() === 'de')
                    <div class="album_cover_name opacity_color">
                            {{$title_cover}}
                    </div>
                    <div class="album_cover_name_de">
                        {{$title_cover_de}}
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</div>

