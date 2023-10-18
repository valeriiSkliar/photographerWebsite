@foreach($metaTags as ['type'=>$type, 'value'=>$value, 'content'=>$content])
    @if($type === 'name')
    <meta name="{{ $value }}" content="{{ $content }}">
    @elseif($type === 'property')
        <meta property="{{ $value }}" content="{{ $content }}">
    @endif
@endforeach
