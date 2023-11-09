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
                    <svg xmlns="http://www.w3.org/2000/svg"
                         height="0.8em"
                         viewBox="0 0 448 512">
                        <path
                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                            </svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path
                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
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
                            <div class="pl-0 col-3 form-group">
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
                                        id="disconnect_btn"
                                        onclick="event.preventDefault()"
                                        class="btn btn-outline-danger"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                            <path
                                                d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="imageContainer">
                                @foreach ($component->album->images as $image)
                                    <div class="col-2 mx-2 image-tile"
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
