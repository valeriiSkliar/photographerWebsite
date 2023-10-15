<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Pages</h2>

{{--            <a href="{{ route('pages.create') }}" class="btn btn-primary mb-3">Add New Page</a>--}}

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Meta Data</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->name }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->meta_data }}</td>
{{--                        <td>--}}
{{--                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-warning">Edit</a>--}}
{{--                            <form action="{{ route('pages.destroy', $page->id) }}" method="post" style="display: inline-block;">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
