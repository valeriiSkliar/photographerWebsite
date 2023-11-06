<div class="px-4">
    <h3 class="mb-4">Edit Component</h3>

    <form
        id="updateComponentForm"
        method="POST" action="{{ route('components.update', $component->id) }}">
        @csrf
        <input type="hidden" name="page_id" value="{{ $page->id }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $component->name }}">
                </div>
            </div>
        </div>

        <h5 class="my-1">Component Details</h5>
        <div id="component-details row">
            @foreach($component->details as $detail)
                <div
                    class="col-8"
                    id="component-details-{{$detail->id}}">
                    <div class="form-row component-detail">
                        <div class="form-group col-md-5">
                            <label for="details[{{ $detail->id }}][key]">Key:</label>
                            <input type="text" class="form-control" id="details[{{ $detail->id }}][key]"
                                   name="details[{{ $detail->id }}][key]" value="{{ $detail->key }}" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="details[{{ $detail->id }}][value]">Value:</label>
                            <input type="text" class="form-control" id="details[{{ $detail->id }}][value]"
                                   name="details[{{ $detail->id }}][value]" value="{{ $detail->value }}" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button
                                onclick="event.preventDefault()"
                                href="javascript:void(0);"
                                class="btn btn-danger"
                            >x
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button
            type="button"
            class="btn btn-secondary mb-3"
            id="addComponentDetail"
        >Add Another Detail
        </button>
        @if(isset($component->album))
            <div id="connectedAlbumContainer"
                 class="row">
                <div class="col-4">
                    <h5 class="my-2">Connected Album</h5>
                </div>
                <div class="col-2">
                    <button
                        style="display: {{ $component->album ? 'block' : 'none' }}"
                        id="disconnect_btn"
                        onclick="event.preventDefault()"
                        class="btn btn-danger"
                    >
                        Disconnect album
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row" id="imageContainer">
                        @foreach ($component->album->images as $image)
                            <div class="col-1 mx-2">
                                <img style="max-width: 100px" class="img-fluid"
                                     src="{{ asset($image->file_url) }}"
                                     alt="{{ $image->alt_text }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div id="albumsSelect"
             style="display: {{ $component->album_id ? 'none' : ''}}"
            class="row">
            @if(isset($albums))
                <div class="col-6 form-group">
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
            <button
                id="updateComponentButton"
                type="submit" class="btn btn-primary">Update
            </button>
            <button
                id="canselAddComponentButton"
                onclick="event.preventDefault()" class="btn btn-primary">
                Cansel
            </button>
    </form>
</div>
<script>

    function deleteComponentDetail(id) {
        fetch(`/api/component-detail/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': `{{ csrf_token() }}`
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    const componentDetail = document.getElementById(`component-details-${id}`)
                    console.log('test')
                    componentDetail.remove();
                }
            });
    }
</script>
