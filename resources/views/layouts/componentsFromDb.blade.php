
@foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details, 'isVisible'=>$visible])
        @if ($visible === 'on')
             @include('sectionComponents.frontend.'.$name)
        @endif
@endforeach
