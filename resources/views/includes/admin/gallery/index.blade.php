@extends('layouts.iframe')
@pushonce('iframe.style')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/lightbox2/css/lightbox.min.css')}}">
    @vite(['resources/scss/admin/gallery/admin_gallery_index.scss'])
@endpushonce

@pushonce('iframe.script')
    <script src="{{ asset('AdminLTE/plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/lightbox2/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @vite(['resources/js/admin/gallery/admin_gallery_index.js'])
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
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <h1 class="my-4">Gallery</h1>
                    </div>
                    <div class="col-4">
                        <div class="my-4">
                            <a class="btn btn-success mb-4" id="createNewAlbum" href="javascript:void(0);">Create
                                New Album</a>
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
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="submit" class="btn btn-warning">Cansel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">

                        <form
                            style="max-height: 450px; overflow-y: auto"
                            enctype="multipart/form-data"
                            class="dropzone fileuploader"
                            id="zdrop">
                            @csrf
                            <div id="upload-label" class="dz-message">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span class="tittle note">Click the Button or Drop Files Here</span>
                            </div>
                        </form>

                        <div id="preview-template" style="display: none;">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image"><IMG data-dz-thumbnail=""></div>
                                <div class="dz-details">
                                    <div class="dz-size"><span data-dz-size=""></span></div>
                                    <div class="dz-filename"><span data-dz-name=""></span></div></div>
                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                            </div>
                        </div>
                    </div>


                </div>
                <h4 class="my-4">Albums</h4>
                <div class="row position-relative">
                    @foreach($albums as $album)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                @if($album->images->first())
                                    <img src="{{ asset($album->images->first()->file_url) ?? '' }}"
                                         alt="{{ $album->title }}" title="{{ $album->title }}"
                                         class="card-img-top">
                                @endif
                                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                    <a
                                        href="{{ route('albums.edit', $album) }}"
                                        class="btn btn-primary"
                                        {{--                                        //TODO add opasity for edit button :vs--}}
                                        {{--                                        style="--bs-text-opacity: .5;"--}}
                                    >
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row m-4">
                    <div class="col-3">
                        <h1 class="my-4">All Photos</h1>
                    </div>
                </div>

                <div class="d-flex align-items-center form-group actions mt-4" style="gap: 10px">
                    <button class="btn btn-danger" id="btnDeleteSelectedImages">Delete Selected</button>
                    <button class="btn btn-primary" id="btnAddToAlbum">Add to Album</button>

                    <select class="form-control col-2" id="albumSelect">
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
                        <div class="col-sm-6 col-md-4 mb-3 image_from_all_heaps">
                            <div class="checkbox icheck-success" style="position: absolute; top: 5px; left: 18px;">
                                <input type="checkbox" class="image-checkbox" data-image-id="{{ $image->id }}"
                                       id="imgSelector{{ $image->id }}" name="success{{ $image->id }}">
                                <label for="imgSelector{{ $image->id }}"></label>
                            </div>
                            <a href="{{ asset($image->file_url) }}" data-lightbox="all-images"
                               data-title="Best title ever">
                                <img src="{{ asset($image->file_url) }}" class="fluid img-thumbnail"
                                     alt="{{ $image->alt_text }}" title="{{ $image->title }}">
                            </a>
                            <!-- Controls -->
                            <div class="btn-group image-controls">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-warning p-0"
                                    data-toggle="dropdown"
                                    data-offset="-1, 0"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right m-0 p-0 mt-2"
                                     style="min-width: auto; background-color: unset; border: unset; box-shadow: unset;">
                                    <a
                                        href="{{ route('images.edit', $image) }}"
                                        class="dropdown-item text-center m-0 p-0"
                                        style="background-color: unset; border: unset"
                                    >
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
