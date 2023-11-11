@foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
    @include('sectionComponents.frontend.'.$name)
@endforeach
