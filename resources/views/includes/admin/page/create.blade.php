includes.admin.page.index
@foreach($pages as $page)
    @if($page)
        <p>{{ $page->name }}</p>
    @endif
@endforeach
