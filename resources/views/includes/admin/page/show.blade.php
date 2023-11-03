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
        .swal2-popup {
            min-width: 80%;
            min-height: 95%;
            padding: 2%;
        }
        .swal2-html-container {
            /*!*width: 90%;*!*/
            /*padding: 10px;*/
        }
        .meta-tags-container {
            margin: auto;
            width: 95%;
            padding: 10px;
        }
    </style>

    <template
        style="min-width: 1200px"
        id="my-template">
        <swal-title>
            Edit / Delete / Add meta tags!
        </swal-title>
        <swal-html>
            <form method="POST">
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                @csrf
                @include('includes.admin.component.ajax.metaTags.edit-meta-form')
            </form>
            {{--            @include('includes.admin.component.ajax.metaTags.create-meta-form')--}}
        </swal-html>
        {{--        <swal-icon type="warning" color="red"></swal-icon>--}}
        <swal-button
            id="test"
            type="confirm">
            Save
        </swal-button>

        <swal-button type="cancel">
            Cancel
        </swal-button>
        <swal-param name="allowEscapeKey" value="false"/>
        <swal-param
            name="customClass"
            value='{ "popup": "my-popup" }'/>
        <swal-function-param
            name="willClose"
            value="popup => popup"/>
        <swal-function-param
            name="didOpen"
            value="popup => popup"/>
    </template>

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
    @vite('resources/js/show_page_view.js')
@endsection
