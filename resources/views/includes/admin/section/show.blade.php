<h1>Section Details</h1>
<p>ID: {{ $section->id }}</p>
<p>Name: {{ $section->name }}</p>
<p>Page: {{ $section->page->name }}</p>
<p>Order: {{ $section->order }}</p>
{{--{{ dd($section->sectionContent) }}--}}
<!-- Displaying details for section_content -->
@if($section->sectionContent)

    <h2>Content Details</h2>
    <p>Font: {{ $section->sectionContent->font }}</p>
    <p>Font Color: {{ $section->sectionContent->font_color }}</p>
    <p>Background Color: {{ $section->sectionContent->background_color }}</p>
    <p>Background Image:
        <img
            src="{{ asset('/storage/backgrounds' . $section->sectionContent->background_image) }}"
            alt="Background Image"
            width="100"
        >
    </p>
    <p>Title: {{ $section->sectionContent->title }}</p>
    <p>Description: {{ $section->sectionContent->description }}</p>
    <p>Content Text: {{ $section->sectionContent->content_text }}</p>
@endif
@if($section->components)
    components
    <br>
    @foreach($section->components as $component)
        {{ $component->type }}
        {{ $component->details[0]['value'] }}
    @endforeach
@endif
<br>
<a href="{{ route('sections.edit', $section->id) }}"><button>Edit Section</button></a>
