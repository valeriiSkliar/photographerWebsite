@extends('layouts.iframe')
@pushonce('iframe.style')
    @vite(['resources/scss/admin/gallery/admin_gallery_index.scss'])
    @vite('resources/scss/admin/gallery/switcher.scss')
@endpushonce

@pushonce('iframe.script')
    @vite(['resources/js/admin/gallery/admin_gallery_index.js'])
@endpushonce
@section('admin.content')
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <h1 class="my-4">Gallery</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="my-4">
                            <a class="btn btn-success mb-4" id="createNewAlbum" href="javascript:void(0);">Create New
                                Album</a>
                            <form method="POST" action="{{ route('albums.store') }}">
                                @csrf
                                <div id="newAlbumFields" style="display: none;" class="mb-4">
                                    <div class="form-group">
                                        <label>Album Title:</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Album sub_text:</label>
                                        <textarea name="sub_text" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Album Description:</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    @can('superAdminAccess', auth()->user())
                                        <div class="form-group">
                                            <label for="service" class="mr-3">Is Album for service:</label>
                                            <div class="button b2 switcherYesOrNot">
                                                <input type="checkbox"
                                                       id="service"
                                                       name="service"
                                                       class="checkbox-switcher"
                                                />
                                                <div class="knobs">
                                                    <span></span>
                                                </div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    @endcan
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="submit" class="btn btn-warning">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        @include('includes.admin.dropzone.dropzoneTemplate')
                    </div>
                </div>
                <h4 class="my-4">Albums</h4>
                <div class="row position-relative">
                    @foreach($albums as $album)
                        @can('superAdminAlbumAccess', $album)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card album-card @if($album->service) border border-danger @endif">
                                    <a href="{{ route('albums.edit', $album->id) }}" class="wrapper-for-lazy-image">
                                        @if($album->images->first())
                                            <div class="aspect-ratio-16-9"></div>
                                            <img src="{{ asset($album->images->first()->file_url) ?? '' }}"
                                                 alt="{{ $album->title }}"
                                                 title="{{ $album->title }}"
                                                 class="card-img-top lazy-image-thumbnail"
                                                 loading="lazy"
                                            >
                                        @endif
                                        <div class="album-title d-flex justify-content-center align-items-center">
                                            <h3 class="text-center">{{ $album->title }}</h3>
                                        </div>
                                    </a>
                                    <div class="btn-group album-controls">
                                        <form action="{{ route('albums.destroy', $album->id) }}" method="POST"
                                              class="text-center m-0 p-0 mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class=" album-delete btn btn-sm btn-danger text-center">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endforeach
                </div>
                <div class="row m-4">
                    <div class="col-12">
                        <h1 class="my-4">All Photos</h1>
                    </div>
                </div>
                <div class="d-flex align-items-center form-group actions mt-4" style="gap: 10px">
                    <button class="btn btn-danger" id="btnDeleteSelectedImages">Delete Selected</button>
                    <button class="btn btn-primary" id="btnAddToAlbum">Add to Album</button>
                    <select class="form-control col-md-2 col-sm-6" id="albumSelect">
                        <option selected value="">Choose album</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row" id="images">
                    <div class="checkbox icheck-success col-12 mb-2">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll" class="user-select-none">Select All</label>
                    </div>
                    @include('includes.admin.gallery.layouts.all_images')
                </div>
            </div>
        </div>
    </div>
@endsection
