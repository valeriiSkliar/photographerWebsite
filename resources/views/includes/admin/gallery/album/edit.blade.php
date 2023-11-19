@extends('layouts.iframe')
@pushonce('iframe.style')
    @vite('resources/scss/admin/gallery/switcher.scss')
@endpushonce
@pushonce('iframe.script')

@endpushonce
@section('admin.content')
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12">
                <div class="container col-12">
                    <h1>Edit -> {{ $album->title }}</h1>

                    <form action="{{ route('albums.update', $album->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $album->title }}">
                                {{-- Edit button for title --}}
                            </div>

                            <div class="form-group">
                                <label for="sub_text">Subtext</label>
                                <input type="text" class="form-control" id="sub_text" name="sub_text"
                                       value="{{ $album->sub_text }}">
                                {{-- Edit button for sub_text --}}
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description"
                                          name="description">{{ $album->description }}</textarea>
                                {{-- Edit button for description --}}
                            </div>
                            @can('superAdminAccess', auth()->user())
                                <div class="form-group align-items-center">
                                    <label for="service" class="mr-3">Is Album for service:</label>
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

                            <h2>Images in album:</h2>
                            <div class="row">
                                @foreach($album->images as $image)
                                    <div class="col-md-2 my-3">
                                        <div class="image-container">
                                            <a href="{{ asset($image->file_url) }}" data-lightbox="{{ $album->title . ' images' }}"
                                               data-title="{{ $image->tilte }}">
                                                <img src="{{ asset($image->file_url) }}" class="fluid img-thumbnail"
                                                     alt="{{ $image->alt_text }}"
                                                     title="{{ $image->title }}">
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        {{-- Update the album --}}
                        <button type="submit" class="btn btn-success">Обновить Альбом</button>
                    </form>

                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить Альбом</button>
                    </form>
                </div>
                <div class="row m-4">
                    <div class="col-12">
                        <h1 class="my-4">All Photos</h1>
                    </div>
                </div>
                <div class="d-flex align-items-center form-group actions mt-4" style="gap: 10px">
                    <button class="btn btn-primary" id="btnAddToAlbum">Add to this album</button>
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
