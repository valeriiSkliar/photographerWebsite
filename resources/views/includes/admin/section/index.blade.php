<h1>Sections</h1>
<a href="{{ route('sections.create') }}">Create New Section</a>
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
                <a href="{{ route('sections.edit', $section->id) }}">Edit</a> |
                <a href="{{ route('sections.show', $section->id) }}">View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
