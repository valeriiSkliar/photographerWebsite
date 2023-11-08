
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title text-center m-auto">Components</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Album</th>
{{--                    <th>Actions</th>--}}
                </tr>
                </thead>
                <tbody id="component_list_table_body">
                @if($page->components)
                    @foreach($page->components as $index => $component)
                        <tr
                            class="componentRow"
                            data-componentId="{{ $component->id }}">
                            <td>{{ $component->name }}</td>
                            <td>{{ $component->album ? $component->album->title : ' - ' }}</td>
{{--                            <td>--}}
{{--                                <form method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <input type="hidden" name="page_id" value="{{ $page->id }}">--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
