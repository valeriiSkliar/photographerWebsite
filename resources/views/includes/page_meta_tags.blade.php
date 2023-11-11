@isset($meta_tags)
    @foreach($meta_tags as ['type_id'=>$type, 'value'=>$value, 'content'=>$content])
        @if($type === 1)
            <meta name="{{ $value }}" content="{{ $content }}">
        @elseif($type === 2)
            <meta property="{{ $value }}" content="{{ $content }}">
        @endif
    @endforeach
@endisset
