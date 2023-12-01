@extends('layouts.app')

@section('content')
    @include('layouts.componentsFromDb')
@endsection
@push('custom-script')
    @vite(['resources/js/front/portfolio_page.js'])
@endPush
