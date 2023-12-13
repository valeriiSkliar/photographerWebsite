@if($component)
    <tr
        title="Component: {{ $component->component_title }} Album: {{ $component->album ? $component->album->title : ' - '  }}"
        class="componentRow border-0"
        data-componentId="{{ $component->id }}"
        data-component_name="{{ $component->name }}"
    >
        <td
            class="border-0"
        >
            <i class="drag-handle fa-solid fa-arrows-up-down pr-3" style="color: #f7f7f7;"></i>
            {{ substr($component->component_title, 0, 15) }}
        </td>
        <td class="border-0 d-flex justify-content-between"
            id="connected-album-name-{{$component->album ? $component->album->id : ''}}">
            {{ $component->album ? $component->album->title : ' - ' }}
            <i class="px-3 fa-regular fa-pen-to-square" style="color: #f7f7f7;cursor: pointer"></i>
        </td>
    </tr>
@endif


