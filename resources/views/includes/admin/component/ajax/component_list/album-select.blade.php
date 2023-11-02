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

