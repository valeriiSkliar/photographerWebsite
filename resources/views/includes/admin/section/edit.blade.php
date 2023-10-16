<h1>Edit Section</h1>
<form action="{{ route('sections.update', $section->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>
        Name: <input type="text" name="name" value="{{ $section->name }}" required>
    </label>
    <br>
    <label>
        Page:
        <select name="page_id">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}" @if($section->page_id == $page->id) selected @endif>{{ $page->name }}</option>
            @endforeach
        </select>
    </label>
    <br>
    <label>
        Order: <input type="number" name="order" value="{{ $section->order }}">
    </label>
    <br>

    <!-- Adding fields for section_content -->
    <label>
        Font: <input type="text" name="font" value="{{ $section->sectionContent->font }}" required>
    </label>
    <br>
    <label>
        Font Color: <input type="color" name="font_color" value="{{ $section->sectionContent->font_color }}" required>
    </label>
    <br>
    <label>
        Background Color: <input type="color" name="background_color" value="{{ $section->sectionContent->background_color }}" required>
    </label>
    <br>
    <label>
        Background Image: <input type="file" name="background_image" value="{{ $section->sectionContent->background_image }}">
    </label>
    <br>
    <label>
        Title: <input type="text" name="title" value="{{ $section->sectionContent->title }}" required>
    </label>
    <br>
    <label>
        Description: <textarea name="description" required>{{ $section->sectionContent->description }}</textarea>
    </label>
    <br>
    <label>
        Content Text: <textarea name="content_text">{{ $section->sectionContent->content_text }}</textarea>
    </label>
    <br>
    <input type="submit" value="Update">
</form>
