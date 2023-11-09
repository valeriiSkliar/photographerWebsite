<div class="px-4">
    <div class="row">
        <div class="col-md-6">
            <h4 class="mb-2">Edit Component</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <form
                style="width: fit-content;"
                method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <button
                    onclick="event.stopPropagation()"
                    type="submit" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                </button>
            </form>
        </div>
    </div>

    <form
        id="updateComponentForm"
        method="POST" action="{{ route('components.update', $component->id) }}">
        @csrf
        <input type="hidden" id="component_id" value="{{ $component->id }}">
        <input type="hidden" name="page_id" value="{{ $page->id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $component->name }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="my-1">Component Details</h5>
                    </div>
                    <div class="col-md-6">
                        <button
                            type="button"
                            class="btn btn-success btn-sm mb-3"
                            id="addComponentDetail"
                        >
                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        </button>
                    </div>
                </div>
                <div class="row"
                     id="component-details">
                    @if(isset($component->details))
                        @foreach($component->details as $detail)
                            <div class="form-row col-md-12"
                                 id="component-detail-{{$detail->id}}"
                            >
                                <div class="form-group col-md-3">
                                    <label for="details[{{ $detail->id }}][key]">Key:</label>
                                    <input type="text" class="form-control" id="details[{{ $detail->id }}][key]"
                                           name="details[{{ $detail->id }}][key]" value="{{ $detail->key }}"
                                           required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="details[{{ $detail->id }}][value]">Value:</label>
                                    <input type="text" class="form-control" id="details[{{ $detail->id }}][value]"
                                           name="details[{{ $detail->id }}][value]" value="{{ $detail->value }}"
                                           required>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="delete[{{ $detail->id }}]">Delete:</label>
                                    <button
                                        data-detail_id="{{ $detail->id }}"
                                        id="delete[{{ $detail->id }}]"
                                        onclick="event.preventDefault()"
                                        href="javascript:void(0);"
                                        class="btn btn-outline-danger w-100"
                                    >
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div
                        class="col-md-12"
                        id="albumsSelect"
                        style="display: {{ $component->album_id ? 'none' : ''}}"
                    >
                        @if(isset($albums))
                            <div class="pl-0 col-12 col-md-6 col-lg-3 form-group">
                                <label for="album_id">Existing Albums:</label>
                                <select class="form-control" id="album_id" name="album_id">
                                    <option value="">Select another album</option>
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <button
                            id="updateComponentButton"
                            type="submit" class="btn btn-success">Update
                        </button>
                        <button
                            id="canselAddComponentButton"
                            onclick="event.preventDefault()" class="btn btn-warning">
                            Cansel
                        </button>
                    </div>
                    <div class="col-9">
                        @if(isset($component->album))
                            <div class="row"
                                 id="connectedAlbumContainer">
                                <div class="py-2 col-6 d-flex flex-row">
                                    <h6 class="m-2">Album</h6>
                                    <button
                                        style="display: {{ $component->album ? 'flex' : 'none' }}"
                                        data-album_id="{{$component->album->id}}"
                                        id="disconnect_btn"
                                        onclick="event.preventDefault()"
                                        class="btn btn-outline-danger"
                                    >
                                        <i class="fa-solid fa-paperclip" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="imageContainer">
                                @foreach ($component->album->images as $image)
                                    <div class="col-2 mr-2 mb-2 image-tile"
                                         style="background-image: url('{{ asset($image->file_url) }}');">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
