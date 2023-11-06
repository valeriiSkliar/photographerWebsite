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


    <div class="container-fluid mt-4 position-relative">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 ml-auto ">
                <div class="row">
                    <div id="formContainer"
                         class="col-12">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-4 ml-auto position-relative mt-4 mt-md-4" >
                <div class="row px-3">
                    <div class="col-12 main-buttons">
                        <div class="row mb-3">
                            <div class="col-4 pr-1 pl-0">
                                <button
                                    data-page="{{$page->id}}"
                                    id="showAddComponentForm"
                                    onclick="event.preventDefault()"
                                    class="w-100 btn btn-primary text-nowrap"
                                >
                                    Add Component
                                </button>
                            </div>
                            <div class="col-4 pr-1">
                                <button
                                    data-page="{{$page->id}}"
                                    id="showMetaTagsForm"
                                    onclick="event.preventDefault()"
                                    class="w-100 btn btn-primary"
                                >
                                    Meta tags
                                </button>
                            </div>
                            <div
                                class="col-4 pr-0">
                                <a
                                    href="{{ route('admin.pages.edit', $page->id) }}"
                                    class="w-100 btn btn-warning"
                                >Edit Page
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 d-none d-lg-block alert alert-info alert-dismissible">
                        <h6>
                            <i class="icon fas fa-info"></i>
                            {{ $page->name }} - Page</h6>
                        <div class="mt-4">
                            <ul class="list-group">
                                {{--                            <li class="list-group-item"><strong>ID:</strong> {{ $page->id }}</li>--}}
                                <li class="list-group-item"><strong>Name:</strong> {{ $page->name }}</li>
                                <li class="list-group-item"><strong>Title:</strong> {{ $page->title }}</li>
                            </ul>
                        </div>
                    </div>
                    <div
                        id="componentsListContainer"
                        class="col-12 col-md-12 px-0">
                        @include('includes.admin.component.ajax.page_components_list')
                    </div>
                </div>
            </div>
        </div>

        <div class="row">


        </div>

    </div>
    </div>
    @push('iframe.script')
        @vite('resources/js/show_page_view.js')
    @endpush
@endsection
