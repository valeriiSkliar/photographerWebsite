@isset($meta_tags)
    @if($page->slug === 'main')
        <link rel="canonical" href="{{route(linkByLocale())}}" />
    @else
        <link rel="canonical" href="{{route(linkByLocale($page->slug))}}" />
    @endif
    @foreach($meta_tags as ['type_id'=>$type, 'value'=>$value, 'content'=>$content])
        @if($type === 1)
            <meta name="{{ $value }}" content="{{ $content }}">
        @elseif($type === 2)
            <meta property="{{ $value }}" content="{{ $content }}">
        @endif
    @endforeach
@endisset
