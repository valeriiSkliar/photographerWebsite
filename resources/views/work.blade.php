@extends('layouts.app')
@section('content')
    @include('layouts.componentsFromDb')
@endsection

@push('custom-script')
    @vite(['resources/js/front/work_page123.js'])
@endPush
