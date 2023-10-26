@extends('sectioncomponent::layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Component</h2>
        <form action="{{ route('sections_component.update', $component->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" id="type" disabled>
                    <option value="standard" {{ $component->type == 'standard' ? 'selected' : '' }}>Standard</option>
                    <option value="custom" {{ $component->type == 'custom' ? 'selected' : '' }}>Custom</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $component->name }}" required>
            </div>

            <div class="form-group">
                <label for="data">Data:</label>
                <textarea class="form-control" name="data" id="data" rows="4">{{ $component->data }}</textarea>
            </div>
            <div class="form-group">
                <label for="section_id">Section:</label>
                <select class="form-control" name="section_id" id="section_id">
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ $component->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Update Component</button>
        </form>
        d
        @if($component->componentData)
        @foreach($component->componentData as $data)
            <div class="row">
                <div class="col-3">
                    <span class="text-white">{{ $data->field_name }}</span>
                </div>
                <div class="col-6">
                    @if($ableData)
                        @foreach($ableData->images as $image)
                            <img src="{{ $image->file_url }}" width="50" alt="">
                        @endforeach
                    @endif
                </div>
                <div class="col-3">
                    <button
                        id="{{$data->id}}"
                        onclick="event.preventDefault();"
                        class="btn-danger btn deleteComponentData"
                    >delete</button>
                </div>
            </div>
        @endforeach
        @endif
        {!! form($form) !!}
{{--        <a href="{{ route('pars.frontend.template', $component->id) }}" class="btn btn-danger">Pars frontend template</a>--}}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',() => {
            document.querySelectorAll('.deleteComponentData').forEach(item => {
                item.addEventListener('click', deleteData);
            })
            async function deleteData({target}) {
                console.log(target)
            }
        })

    </script>
@endsection
