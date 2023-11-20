@extends('layouts.iframe')
@pushonce('iframe.style')
    @vite([
    'resources/scss/admin/gallery/switcher.scss',
    'resources/scss/admin/gallery/dragAndDrop.scss',
    ])
@endpushonce
@pushonce('iframe.script')
    @vite([
        'resources/js/admin/gallery/admin_gallery_edit_album.js',
        'resources/js/admin/gallery/dragAndDrop.js'
        ])
@endpushonce
@section('admin.content')
    <div class="container-fluid">
        <div id="contextMenu" class="dropdown-menu">
            <a class="dropdown-item" href="#" id="deleteFromAlbum">Delete from album</a>
        </div>
        <div class="row p-2">
            <div class="col-12">
                <div class="row">
                    <h1 class="col-md-4">Edit
                        <i class="fa-solid fa-arrow-right fa-2xs" style="color: #ffffff;"></i>                        {{ $album->title }}</h1>
                    <input id="albumId" type="hidden" value="{{ $album->id }}">
                    @can('superAdminAccess', auth()->user())
                        <form
                            action="{{ route('albums.destroy', $album->id) }}"
                            method="POST"
                            class="col-md-8 d-flex justify-content-end">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-danger">
                                <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                            </button>
                        </form>
                    @endcan
                </div>
                <div class="row">
                    <div class="col-4">
                        <form action="{{ route('albums.update', $album->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   value="{{ $album->title }}">
                                            {{-- Edit button for title --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 justify-content-end form-group">
                                    <label for="sub_text">Subtext</label>
                                    <input type="text" class="form-control" id="sub_text" name="sub_text"
                                           value="{{ $album->sub_text }}">
                                    {{-- Edit button for sub_text --}}
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description"
                                                      name="description">{{ $album->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="col-3 d-flex align-items-center">
                                            <button type="submit" class="btn btn-success px-4">
                                                <i class="fa-solid fa-floppy-disk" style="color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        @can('superAdminAccess', auth()->user())
                                            <div class="form-group align-items-center">
{{--                                                <label for="service" class="mr-3">service Album?</label>--}}
                                                <div class="button b2 switcherYesOrNot">
                                                    <input type="checkbox"
                                                           @if($album->service)
                                                               {{'checked'}}
                                                           @endif
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
                                    </div>
                                </div>
                            </div>
                            {{-- Update the album --}}
                        </form>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6">
                                <h5>Images in album:</h5>
                            </div>
                        </div>
                        <div class="row albumImageCards bg-gradient-white" id="sortable">
                            @foreach($album->images as $image)
                                <div class="col-md-4 my-3 selectable-item"
                                     data-image_id="{{$image->id}}"
                                     style="min-width: 8rem;">
                                    <div class="image-container ">
                                        <a href="{{ asset($image->file_url) }}"
                                           data-lightbox="album images"
                                           data-title="{{ $image->tilte }}"
                                           class="wrapper-for-lazy-image">
                                            <div class="aspect-ratio-16-9 rounded"></div>
                                            <img src="{{ asset($image->file_url) }}"
                                                 class=" img-thumbnail lazy-image-thumbnail"
                                                 alt="{{ $image->alt_text }}"
                                                 title="{{ $image->title }}"
                                                 loading="lazy"
                                            >
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-12">
                        <h5 class="my-1">All Photos</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center form-group actions mt-4" style="gap: 10px">
                    <button class="btn btn-primary" id="btnAddToAlbum" data-album-id="{{$album->id}}">Add to this
                        album
                    </button>
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
