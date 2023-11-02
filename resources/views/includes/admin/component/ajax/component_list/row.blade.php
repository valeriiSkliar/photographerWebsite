@if($component)
    <tr
    data-componentId="{{ $component->id }}"
    class="componentRow"
    >
        <td>{{ $component->name }}</td>
        <td>{{ $component->album ? $component->album->title : ' - ' }}</td>
        <td>
{{--            <a href="{{ route('components.show', $component) }}" class="btn btn-info btn-sm">Show</a>--}}
{{--            <a href="{{ route('components.edit', $component) }}" class="btn btn-warning btn-sm">Edit</a>--}}

            <form method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <button
                    onclick="event.stopPropagation()"
                    type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
@endif


