<h1>Create Section</h1>
<form action="{{ route('sections.store') }}" method="post">
    @csrf
    <label>
        Name: <input type="text" name="name" required>
    </label>
    <label>
        Page:
        <select name="page_id">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}">{{ $page->name }}</option>
            @endforeach
        </select>
    </label>
    <label>
        Order: <input type="number" name="order" value="0">
    </label>
    <input type="submit" value="Create">
</form>
