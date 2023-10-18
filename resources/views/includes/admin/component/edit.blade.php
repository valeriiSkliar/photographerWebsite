@extends('layouts.iframe')
@section('admin.content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@php
        $start_coun_details = $component->details->last()->id ?? 1;
@endphp
<div class="container mt-5">
    <h1 class="mb-4">Edit Component</h1>

    <form method="POST" action="{{ route('components.update', $component->id) }}">
        @csrf

        <div class="form-group">
            <label for="section_id">Section:</label>
            <select class="form-control" id="section_id" name="section_id" required>
                @foreach($sections as $section)
                    <option
                        {{ $component->section_id == $section->id ? 'selected'  : ''}}
                        value="{{ $section->id }}">{{ $section->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <input
                type="text"
                class="form-control"
                id="type"
                name="type"
                value="{{ $component->type }}"
                required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ $component->name }}"
            >
        </div>

        <h2 class="my-4">Component Details</h2>
        @foreach($component->details as $detail)
            <div id="component-details">
                <div class="form-row component-detail">
                    <div class="form-group col-md-6">
                        <label
                            for="details[{{ $detail->id }}][key]"
                        >Key:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="details[{{ $detail->id }}][key]"
                            name="details[{{ $detail->id }}][key]"
                            value="{{ $detail->key }}"
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label
                            for="details[{{ $detail->id }}][value]"
                        >
                            Value:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="details[{{ $detail->id }}][value]"
                            name="details[{{ $detail->id }}][value]"
                            value="{{ $detail->value }}"
                            required
                        >
                    </div>
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-secondary mb-3" id="addComponentDetail">Add Another Detail</button>

        @if(isset($component->album))
            <h2 class="my-4">Connected Album</h2>
            <div class="row">
                @foreach ($component->album->images as $image)
                    <div class="col-1 mx-2">
                        <img
                            style="max-width: 100px"
                            class="img-fluid"
                            src="{{ $image->file_url }}" alt="{{ $image->alt_text }}">
                    </div>
                @endforeach
            </div>
        @endif

        @if(isset($albums))
            <div class="mt-4 form-group">
                <label for="album_id">Existing Albums:</label>
                <select class="form-control" id="album_id" name="album_id">
                    <option value="">Select another album</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <a href="javascript:void(0);" class="btn btn-secondary d-block my-3" onclick="createNewAlbum()">Create New Album:</a>

        <div id="newAlbumFields" style="display: none;">
            <div id="my-dropzone" class="dropzone mb-3"></div>

            <div class="form-group">
                <label for="title">Album Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="sub_text">Album sub_text:</label>
                <textarea class="form-control" id="sub_text" name="sub_text"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Album Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const componentDetailsContainer = document.getElementById('component-details');
        const addComponentDetailButton = document.getElementById('addComponentDetail');

        let detailCount = {{ $start_coun_details == 1 ? $start_coun_details : $start_coun_details + 1 }};

        addComponentDetailButton.addEventListener('click', function() {
            const newDetailDiv = document.createElement('div');
            newDetailDiv.className = 'component-detail';

            const keyLabel = document.createElement('label');
            keyLabel.textContent = 'Key:';
            const keyInput = document.createElement('input');
            keyInput.type = 'text';
            keyInput.name = `details[${detailCount}][key]`;
            keyInput.required = true;

            const valueLabel = document.createElement('label');
            valueLabel.textContent = 'Value:';
            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.name = `details[${detailCount}][value]`;
            valueInput.required = true;

            newDetailDiv.appendChild(keyLabel);
            newDetailDiv.appendChild(keyInput);
            newDetailDiv.appendChild(valueLabel);
            newDetailDiv.appendChild(valueInput);

            componentDetailsContainer.appendChild(newDetailDiv);

            detailCount++;
        });
    });
</script>
@endsection
