@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h1>Sections</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('sections.create') }}" class="btn btn-primary">Create New Section</a>
            </div>
        </div>

        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Page</th>
                    <th>Order</th>
                    <th>Components</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->name }}</td>
                        <td>{{ $section->page->name }}</td>
                        <td>{{ $section->order }}</td>
                        <td>{{ $section->components->count() }}</td>
                        <td>
                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('sections.show', $section->id) }}" class="btn btn-sm btn-info">View</a>
                            <form
                                action="{{ route('sections.destroy', $section->id) }}"
                                method="post"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this section?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
