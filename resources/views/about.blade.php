@extends('layouts.app')

@section('content')


@foreach($page->sections as $section)
    @if($section->components)
        @foreach($section->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @include('sectionComponents.frontend.'.$name)
        @endforeach
    @endif
@endforeach
@endsection
