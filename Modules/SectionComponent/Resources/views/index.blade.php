@extends('sectioncomponent::layouts.master')
INDEX
@yield('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('sectioncomponent.name') !!}
    </p>
