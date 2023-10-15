<h1>Edit Section</h1>
<form action="{{ route('sections.update', $section->id) }}" method="post">
    @csrf
    @method('PUT')
    <label>
        Name: <input type="text" name="name" value="{{ $section->name }}" required>
    </label>
    <label>
        Page:
        <select name="page_id">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}" @if($section->page_id == $page->id) selected @endif>{{ $page->name }}</option>
            @endforeach
        </select>
    </label>
    <label>
        Order: <input type="number" name="order" value="{{ $section->order }}">
    </label>
    <input type="submit" value="Update">
</form>
