@if($component)
    <tr
    data-componentId="{{ $component->id }}"
    class="componentRow"
    >
        <td>{{ $component->name }}</td>
        <td>{{ $component->album ? $component->album->title : ' - ' }}</td>
{{--        <td>--}}
{{--            <form method="POST" action="{{ route('components.destroy', $component) }}" class="d-inline">--}}
{{--                @csrf--}}
{{--                @method('DELETE')--}}
{{--                <input type="hidden" name="page_id" value="{{ $page->id }}">--}}
{{--                <button--}}
{{--                    onclick="event.stopPropagation()"--}}
{{--                    type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
{{--            </form>--}}
{{--        </td>--}}
    </tr>
@endif


