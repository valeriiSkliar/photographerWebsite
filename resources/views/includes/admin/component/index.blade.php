<h1>Components</h1>

<a href="{{ route('components.create') }}">Add New Component</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Order</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($components as $component)
        <tr>
            <td>{{ $component->id }}</td>
            <td>{{ $component->type }}</td>
            <td>{{ $component->order }}</td>
            <td>
                <a href="{{ route('components.show', $component) }}">Show</a>
                <a href="{{ route('components.edit', $component) }}">Edit</a>
                <form method="POST" action="{{ route('components.destroy', $component) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
