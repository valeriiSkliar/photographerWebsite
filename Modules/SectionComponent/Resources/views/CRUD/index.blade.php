@extends('sectioncomponent::layouts.master')

@section('content')
    <div class="container">
        <h2>Sections Components</h2>
        <a href="{{ route('sections_component.create') }}" class="btn btn-primary mb-3">Add New Component</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Name</th>
                <th>Template Name</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($components as $component)
                <tr>
                    <td><a href="{{ route('sections_component.show', $component->id) }}">{{ $component->id }}</a></td>
                    <td>{{ $component->type }}</td>
                    <td>{{ $component->name }}</td>
                    <td>{{ $component->template_name }}</td>
                    <td>{{ $component->section->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('sections_component.edit', $component->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sections_component.destroy', $component->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
