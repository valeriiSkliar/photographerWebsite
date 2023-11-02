    <div class="row mt-2">
        <h1 class="mb-4">Components</h1>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Connected album</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="component_list_table_body">
                @if($page->components)
                    @foreach($page->components as $component)
                        <tr
                            data-componentId="{{ $component->id }}"
                            class="componentRow"
                        >
{{--                            @dd($component->albums)--}}
                            <td>{{ $component->name }}</td>
                            <td>{{ $component->albums ? $component->album->title : ' - ' }}</td>
                            <td>
{{--                                <a href="{{ route('components.show', $component) }}" class="btn btn-info btn-sm">Show</a>--}}
{{--                                <a href="{{ route('components.edit', $component) }}" class="btn btn-warning btn-sm">Edit</a>--}}

                                <form method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

