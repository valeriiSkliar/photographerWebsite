@extends('layouts.iframe')
@section('admin.content')
<h1>Create Section</h1>
<form
    action="{{ route('sections.store') }}"
    method="post"
    enctype="multipart/form-data">
    @csrf
    <label>
        Name: <input type="text" name="name" required>
    </label>
    <br>
    <label>
        Page:
        <select name="page_id">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}">{{ $page->name }}</option>
            @endforeach
        </select>
    </label>
    <br>
    <label>
        Order: <input type="number" name="order" value="0">
    </label>
    <br>
    <hr>

    <h2>Section Content</h2>
    <br>
    <label>
        Font: <input type="text" name="font" required>
    </label>
    <br>
    <label>
        Font Color: <input type="color" name="font_color" required>
    </label>
    <br>
    <label>
        Background Color: <input type="color" name="background_color" required>
    </label>
    <br>
    <label>
        Background Image: <input type="file" name="background_image" accept="image/*">
    </label>
    <br>
    <label>
        Title: <input type="text" name="title" required>
    </label>
    <br>
    <label>
        Description: <textarea name="description" required></textarea>
    </label>
    <br>
    <label>
        Content Text: <textarea name="content_text"></textarea>
    </label>
    <br>

    <hr>
    <h2>Section Components</h2>

    <input type="submit" value="Create">
</form>
@endsection
