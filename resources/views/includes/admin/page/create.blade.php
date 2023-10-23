@extends('layouts.iframe')
@section('admin.content')

    @if($errors->any())
        {{ '$errors' }}
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

{{--    Page INFO & Meta tags --}}
    <div class="container-fluid">
        <form action="{{ route('admin.page.store') }}" method="POST">
            @csrf

        <div class=" ml-2 mt-2 row">
            <div class="col-md-3">
                <h5>Create New Page</h5>


                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta_data">Meta Data:</label>
                        <input type="text" id="meta_data" name="meta_data" class="form-control"
                               value="{{ old('meta_data') }}">
                    </div>


            </div>
            <div class="col-8">
                <h5>Add meta tags</h5>
                <div class=" row">
                    <div
                        id="metaTagFormContainer"
                        class="col-10">
                        <div id="metaTagForm">
                            <div class="row">
                                    <select
                                        name="metaData[0][type_id]"
                                        id="typeSelect"
                                        class="typeSelect col-3">
                                        <option value="">Select type</option>
                                        @if($metaTagTypes)
                                            @foreach($metaTagTypes as $metaTagType)
                                                <option
                                                    data-type="{{ $metaTagType->type }}"
                                                    value="{{ $metaTagType->id }}" >{{ $metaTagType->type }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <select
                                        name="metaData[0][value]"
                                        id="valueSelect"
                                        class="valueSelect col-4">
                                        <option value="">Select value</option>
                                    </select>
                                    <input
                                        disabled
                                        class="col-4"
                                        id="content"
                                        name="metaData[0][content]"
                                        placeholder="input content here!"
                                        type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button
                            id="addNewRow">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>                        </button>
                    </div>
                </div>
            </div>
            </div>

            {{--  Add Sections  --}}
            @include('includes.admin.section.create')
            {{--  END Add Sections  --}}
            <button type="submit" class="btn btn-primary">Create Page</button>
        </form>
    </div>
{{--   END Page INFO & Meta tags --}}


    <template
        id="metaTagFormTemplate"
    >
        <div class="row">
                    <select
                        name="metaData[0][type_id]"
                        id="typeSelect"
                        class="typeSelect col-4">
                        <option value="">Select type</option>
                        @if($metaTagTypes)
                            @foreach($metaTagTypes as $metaTagType)
                                <option
                                    data-type="{{ $metaTagType->type }}"
                                    value="{{ $metaTagType->id }}" >{{ $metaTagType->type }}</option>
                            @endforeach
                        @endif
                    </select>
                    <select
                        name="metaData[0][value]"
                        id="valueSelect"
                        class="valueSelect col-4">
                        <option value="">Select value</option>
                    </select>
                    <input
                        disabled
                        class="col-4"
                        id="content"
                        name="metaData[0][content]"
                        placeholder="input content here!"
                        type="text">
            </div>
    </template>
@endsection
{{--@include('/includes/admin/section/index')--}}
