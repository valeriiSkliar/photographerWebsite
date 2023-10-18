@extends('layouts.iframe')
@section('admin.content')
<h1>Sections</h1>
<a href="{{ route('sections.create') }}"><button>Create New Section</button></a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Page</th>
        <th>Order</th>
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
            <td>
                <a href="{{ route('sections.edit', $section->id) }}"><button>Edit</button></a> |
                <a href="{{ route('sections.show', $section->id) }}"><button>View</button></a>
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
@endsection
