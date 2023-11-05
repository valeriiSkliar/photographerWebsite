@extends('layouts.iframe')
@pushonce('iframe.style')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpushonce

@pushonce('iframe.script')
    @if(session('success_message'))
        <script>
            Swal.fire(sweetAlertConfigs.success("{{ session('success_message') }}"));
        </script>
    @endif
    @if(session('error_message'))
        <script>
            Swal.fire(sweetAlertConfigs.error("{{ session('error_message') }}"));
        </script>
    @endif
@endpushonce
@section('admin.content')
    <style>
        .meta-tags-container {
            margin: auto;
            width: 95%;
            padding: 10px;
        }
    </style>

    @include('includes.admin.component.ajax.metaTags.swal-template-meta-form')


    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $page->name }} - Page Details</h1>
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Edit Page</a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-4">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID:</strong> {{ $page->id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $page->name }}</li>
                        <li class="list-group-item"><strong>Title:</strong> {{ $page->title }}</li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 text-left">
                        <!-- Add Component Button -->
                        <button
                                data-page="{{$page->id}}"
                                id="showAddComponentForm"
                                onclick="event.preventDefault()" class="btn btn-primary"
                        >
                            Add Component
                        </button>
                    </div>
                    <div class="col-md-3 text-left">
                        <!-- Manage meta tags -->
                        <button
                                data-page="{{$page->id}}"
                                id="showMetaTagsForm"
                                onclick="event.preventDefault()" class="btn btn-primary"
                        >
                            Manage meta tags
                        </button>
                    </div>
                </div>

            </div>
            <div
                    class="col-8"
                    id="formContainer"></div>
            <div
                    id="componentsListContainer"
                    class="col-4">
                @include('includes.admin.component.ajax.page_components_list')
            </div>
        </div>
    </div>
    @push('iframe.script')
        @vite('resources/js/show_page_view.js')
    @endpush
@endsection
