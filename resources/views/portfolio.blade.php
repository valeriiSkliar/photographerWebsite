@extends('layouts.app')

@pushonce('custom-style')
    @vite(['resources/scss/portfolio_styles.scss'])
@endpushonce

@section('content')
    @include('layouts.componentsFromDb')
@endsection

@push('custom-script')
    @vite(['resources/js/front/portfolio_page.js'])
@endPush
