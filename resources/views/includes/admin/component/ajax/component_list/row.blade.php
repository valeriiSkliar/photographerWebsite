@if($component)
    <tr
        id="sortable"
        data-componentId="{{ $component->id }}"
        class="componentRow"
    >
        <td>
            <i class="fa-solid fa-arrows-up-down-left-right" style="color: #f7f7f7;"></i>
            {{ $component->name }}
        </td>
        <td
            id="connected-album-name-{{$component->album ? $component->album->id : ''}}"
        >
            {{ $component->album ? $component->album->title : ' - ' }}
        </td>
    </tr>
@endif


