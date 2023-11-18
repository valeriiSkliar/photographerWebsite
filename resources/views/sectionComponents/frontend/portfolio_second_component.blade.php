<div>Second</div>

<div class="portfolio_albums_list">
    @foreach ($album->images as ['file_url'=>$url])
    <div class="portfolio_albums_title" style="background-image: url({{$url}})">
        
    </div>
    @endforeach
</div>

{{-- @foreach ($album->images as ['file_url'=>$url])
<img class="w-full h-full object-cover" src="{{ asset($url) }}" alt="Photo">
@endforeach

@foreach ($details as ['value'=>$maker])
{{$maker}}
@endforeach --}}
