@extends('layouts.app')

@section('content')

{{--@dd($page->components)--}}
@foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
{{--    @if($section->components)--}}
{{--        @foreach($section->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])--}}

                @include('sectionComponents.frontend.'.$name)
{{--        @endforeach--}}
{{--    @endif--}}

@endforeach
@endsection
