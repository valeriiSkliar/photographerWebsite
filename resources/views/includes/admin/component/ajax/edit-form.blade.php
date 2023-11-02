<div class="container mt-5">
    <h3 class="mb-4">Edit Component</h3>

    <form
        id="updateComponentForm"
        method="POST" action="{{ route('components.update', $component->id) }}">
        @csrf
{{--        @method('PATCH')--}}
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
        <div id="component-details">
            @foreach($component->details as $detail)
                <div id="component-details-{{$detail->id}}">
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
                            <button href="javascript:void(0);" class="btn btn-danger"
                                    onclick="deleteComponentDetail({{ $detail->id }})">x
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="addComponentDetail">Add Another Detail</button>
        @if(isset($component->album))
            <div
                id="connectedAlbumContainer"
                class="row">
                <div class="col-4">
                    <h5 class="my-2">Connected Album</h5>
                </div>
                <div class="col-2">
                    <button
                        style="display: {{ $component->album ? 'block' : 'none' }}"
                        id="disconnect_btn"
                        onclick="event.preventDefault()"
{{--                        href="javascript:void(0);" --}}
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
                @endif

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
                type="submit" class="btn btn-primary">Update</button>
            <button
                id="canselAddComponentButton"
                onclick="event.preventDefault()" class="btn btn-primary">
                Cansel
            </button>
    </form>
</div>
<script>
    // let imageContainer = null;
    // let disconnect_btn = null;
    // imageContainer = document.getElementById('imageContainer');
    // disconnect_btn = document.getElementById('disconnect_btn');
    {{--function disconnectAlbum(component_id) {--}}
    {{--    fetch(`/api/component-album-disconnect/${component_id}`, {--}}
    {{--        method: 'POST',--}}
    {{--        headers: {--}}
    {{--            'X-Requested-With': 'XMLHttpRequest',--}}
    {{--            'X-CSRF-TOKEN': `{{ csrf_token() }}`--}}
    {{--        },--}}
    {{--    })--}}
    {{--        .then(response => response.json())--}}
    {{--        .then(data => {--}}
    {{--            if (data.message) {--}}
    {{--                alert(data.message);--}}
    {{--                imageContainer.innerHTML = '';--}}
    {{--                disconnect_btn.disabled = true;--}}
    {{--                // const componentDetail = document.getElementById(`component-details-${id}`)--}}
    {{--                // console.log('test')--}}
    {{--                // componentDetail.remove();--}}
    {{--            }--}}
    {{--        });--}}
    {{--}--}}

    // document.addEventListener('DOMContentLoaded', function () {
    //     const componentDetailsContainer = document.getElementById('component-details');
    //     const addComponentDetailButton = document.getElementById('addComponentDetail');
    //
    //     let detailCount = 1;
    //
    //     addComponentDetailButton.addEventListener('click', function () {
    //         const newDetailDiv = document.createElement('div');
    //         newDetailDiv.className = 'component-detail';
    //
    //         const keyLabel = document.createElement('label');
    //         keyLabel.textContent = 'Key:';
    //         const keyInput = document.createElement('input');
    //         keyInput.type = 'text';
    //         keyInput.name = `details[${detailCount}][key]`;
    //         keyInput.required = true;
    //
    //         const valueLabel = document.createElement('label');
    //         valueLabel.textContent = 'Value:';
    //         const valueInput = document.createElement('input');
    //         valueInput.type = 'text';
    //         valueInput.name = `details[${detailCount}][value]`;
    //         valueInput.required = true;
    //
    //         newDetailDiv.appendChild(keyLabel);
    //         newDetailDiv.appendChild(keyInput);
    //         newDetailDiv.appendChild(valueLabel);
    //         newDetailDiv.appendChild(valueInput);
    //
    //         componentDetailsContainer.appendChild(newDetailDiv);
    //
    //         detailCount++;
    //     });
    // });


    {{--if(document.getElementById('album_id')){--}}
    {{--    document.getElementById('album_id').addEventListener('change', function () {--}}
    {{--        const selectedAlbumId = this.value;--}}

    {{--        const additionalData = {--}}
    {{--            component_id: '{{ $component->id }}',--}}
    {{--            album_id: selectedAlbumId,--}}
    {{--        };--}}

    {{--        if (selectedAlbumId) {--}}
    {{--            fetch(`/api/component-album/${selectedAlbumId}`, {--}}
    {{--                method: 'POST',--}}
    {{--                headers: {--}}
    {{--                    'X-Requested-With': 'XMLHttpRequest',--}}
    {{--                    'X-CSRF-TOKEN': `{{ csrf_token() }}`,--}}
    {{--                    'Content-Type': 'application/json'--}}
    {{--                },--}}
    {{--                body: JSON.stringify(additionalData)--}}
    {{--            })--}}
    {{--                .then(response => response.json())--}}
    {{--                .then(data => {--}}
    {{--                    if (data.images) {--}}
    {{--                        updateAlbumImages(data.images);--}}
    {{--                    }--}}
    {{--                })--}}
    {{--                .catch(error => {--}}
    {{--                    console.error('Error fetching album images:', error);--}}
    {{--                });--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

    {{--function deleteComponentDetail(id) {--}}
    {{--    fetch(`/api/component-detail/${id}`, {--}}
    {{--        method: 'DELETE',--}}
    {{--        headers: {--}}
    {{--            'X-Requested-With': 'XMLHttpRequest',--}}
    {{--            'X-CSRF-TOKEN': `{{ csrf_token() }}`--}}
    {{--        },--}}
    {{--    })--}}
    {{--        .then(response => response.json())--}}
    {{--        .then(data => {--}}
    {{--            if (data.message) {--}}
    {{--                alert(data.message);--}}
    {{--                const componentDetail = document.getElementById(`component-details-${id}`)--}}
    {{--                console.log('test')--}}
    {{--                componentDetail.remove();--}}
    {{--            }--}}
    {{--        });--}}
    {{--}--}}

    {{--function updateAlbumImages(images) {--}}
    {{--    disconnect_btn.style.display = 'block';--}}

    {{--    disconnect_btn.disabled = false;--}}

    {{--    imageContainer.innerHTML = '';--}}

    {{--    images.forEach(image => {--}}
    {{--        const imageDiv = document.createElement('div');--}}
    {{--        imageDiv.className = 'col-1 mx-2';--}}

    {{--        const imgElement = document.createElement('img');--}}
    {{--        imgElement.style.maxWidth = '100px';--}}
    {{--        imgElement.classList.add('img-fluid');--}}
    {{--        imgElement.src = `{{ asset('${image.file_url}') }}`;--}}
    {{--        imgElement.alt = image.alt_text;--}}

    {{--        imageDiv.appendChild(imgElement);--}}
    {{--        imageContainer.appendChild(imageDiv);--}}
    {{--    });--}}
    {{--}--}}
</script>
