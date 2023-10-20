@extends('layouts.iframe')

@section('admin.content')

    <div class="container mt-5">
        <h1 class="mb-4">Components</h1>

        <div class="mb-3">
            <a href="{{ route('components.create') }}" class="btn btn-primary">Add New Component</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Name</th>
                <th>Section name</th>
                <th>Connected album</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($components as $component)
                <tr>
                    <td>{{ $component->id }}</td>
                    <td>{{ $component->type }}</td>
                    <td>{{ $component->name }}</td>
                    <td>{{ $component->section->name }}</td>
                    <td>{{ $component->album->title }}</td>
                    <td>
                        <a href="{{ route('components.show', $component) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('components.edit', $component) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
