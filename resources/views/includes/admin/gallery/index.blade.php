@extends('layouts.iframe')
@pushonce('iframe.style')
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/lightbox2/css/lightbox.min.css')}}">
    @vite(['resources/scss/admin/gallery/admin_gallery_index.scss'])
@endpushonce

@pushonce('iframe.script')
    <script src="{{ asset('AdminLTE/plugins/lightbox2/js/lightbox.min.js') }}"></script>
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
                                            <label for="service">Is Album for service:</label>
                                            <input type="checkbox" id="service" name="service" class="form-control"/>
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
                                    <a href="{{ route('albums.edit', $album->id) }}">
                                        @if($album->images->first())
                                            <img src="{{ asset($album->images->first()->file_url) ?? '' }}"
                                                 alt="{{ $album->title }}"
                                                 title="{{ $album->title }}" class="card-img-top">
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
                    @foreach($images as $image)
                        @can('superAdminImageAccess', $image)
                            <div class="col-sm-6 col-md-4 mb-3 image_from_all_heaps">
                                <div class="checkbox icheck-success"
                                     style="position: absolute; top: 5px; left: 18px;">
                                    <input type="checkbox" class="image-checkbox" data-image-id="{{ $image->id }}"
                                           id="imgSelector{{ $image->id }}" name="success{{ $image->id }}">
                                    <label for="imgSelector{{ $image->id }}"></label>
                                </div>
                                <a href="{{ asset($image->file_url) }}" data-lightbox="all-images"
                                   data-title="{{ $image->tilte }}">
                                    <img src="{{ asset($image->file_url) }}" class="fluid img-thumbnail"
                                         alt="{{ $image->alt_text }}"
                                         title="{{ $image->title }}">
                                </a>
                                <div class="btn-group image-controls">
                                    <button type="button" class="btn btn-sm btn-outline-warning p-0"
                                            data-toggle="dropdown"
                                            data-offset="-1, 0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right m-0 p-0 mt-2"
                                         style="min-width: auto; background-color: unset; border: unset; box-shadow: unset;">
                                        <a href="{{ route('images.edit', $image) }}"
                                           class="dropdown-item text-center m-0 p-0"
                                           style="background-color: unset; border: unset">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('images.destroy', $image) }}" method="POST"
                                              class="dropdown-item text-center m-0 p-0 mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" btn-delete text-center p-0">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
