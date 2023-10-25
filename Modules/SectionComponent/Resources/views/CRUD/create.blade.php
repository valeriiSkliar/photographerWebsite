@extends('sectioncomponent::layouts.master')
@section('content')
    <div class="container">
        <h2>Add New Component</h2>
        <form action="{{ route('sections_component.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" id="type">
                    <option value="standard">Standard</option>
                    <option value="custom">Custom</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="data">Data:</label>
                <textarea class="form-control" name="data" id="data" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="section_id">Section:</label>
                <select class="form-control" name="section_id" id="section_id">
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Component</button>
        </form>
    </div>
@endsection
