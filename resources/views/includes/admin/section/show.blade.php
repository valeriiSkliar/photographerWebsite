    <h1>Section Details</h1>
    <p>ID: {{ $section->id }}</p>
    <p>Name: {{ $section->name }}</p>
    <p>Page: {{ $section->page->name }}</p>
    <p>Order: {{ $section->order }}</p>
    <a href="{{ route('sections.edit', $section->id) }}">Edit Section</a>
