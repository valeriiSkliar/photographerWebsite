    <div class="row">
        <form
                id="addComponentForm"
            class="col-4 mx-3"
            method="POST" action="{{ route('components.store') }}">
            @csrf

            <input type="hidden" name="page_id" value="{{ $page->id }}">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <h5 class="my-4">Component Details</h5>

            <div id="component-details">
                <div class="form-row component-detail">
                    <div class="form-group col-md-6">
                        <label for="details[0][key]">Key:</label>
                        <input type="text" class="form-control" id="details[0][key]" name="details[0][key]" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="details[0][value]">Value:</label>
                        <input type="text" class="form-control" id="details[0][value]" name="details[0][value]" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="addComponentDetail">Add Another Detail</button>


            @if(isset($albums))
                <div class="form-group">
                    <label for="album_id">Connect Album:</label>
                    <select class="form-control" id="album_id" name="album_id">
                        <option value="">Select Album</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
            <button
                id="canselAddComponentButton"
                onclick="event.preventDefault()" class="btn btn-primary">
                Cansel
            </button>
        </form>
    </div>
