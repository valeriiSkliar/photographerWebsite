<h1>Page Details</h1>
<p>ID: {{ $page->id }}</p>
<p>Name: {{ $page->name }}</p>
<p>Slug: {{ $page->slug }}</p>
<p>Title: {{ $page->title }}</p>
<p>Meta Data: {{ $page->meta_data }}</p>
<a href="{{ route('admin.pages.edit', $page->id) }}">Edit Page</a>

@foreach($page->sections as $section)
    {{ $section->name }}
@endforeach

@yield('page_section')
