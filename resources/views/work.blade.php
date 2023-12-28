@extends('layouts.app')
@pushonce('custom-style')
    @vite(['resources/scss/work_styles.scss'])
@endpushonce

@section('content')
    @include('layouts.componentsFromDb')
@endsection

@push('custom-script')
    @vite(['resources/js/front/work_page123.js'])
@endPush
