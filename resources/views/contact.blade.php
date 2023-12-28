@extends('layouts.app')

@pushonce('custom-style')
    @vite(['resources/scss/contacts_styles.scss'])
@endpushonce

@section('content')
    @include('layouts.componentsFromDb')
@endsection


