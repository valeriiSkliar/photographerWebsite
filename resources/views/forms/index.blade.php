@extends('layouts.iframe')

@section('admin.content')

    <div class="container mt-5">
        <h2>Available Forms</h2>

        <a href="{{ route('forms.create') }}" class="btn btn-primary mb-3">Create New Form</a>

        @if ($forms->isEmpty())
            <div class="alert alert-info">
                No forms available. Create one now!
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Component</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->name }}</td>
                        <td
                        class="text-center"
                        >{{ $form->component_id ?? ' - ' }}</td> <!-- Assuming you might want to display the related component -->
                        <td>{{ $form->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('forms.show', $form->id) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('forms.destroy', $form->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this form?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>

@endsection
