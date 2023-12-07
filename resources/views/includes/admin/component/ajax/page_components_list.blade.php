
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
                </tr>
                </thead>
                <tbody id="component_list_table_body">
                @if($page->components)
                    @foreach($page->components as $index => $component)
                        <tr
                            class="componentRow border-0"
                            data-componentId="{{ $component->id }}"
                            data-component_name="{{ $component->name }}"
                        >
                            <td
                                class="border-0"
                            >
                                <i class="drag-handle fa-solid fa-arrows-up-down pr-3" style="color: #f7f7f7;"></i>
                                {{ substr($component->name, 0, 15) . '...' }}
                            </td>
                            <td class="border-0 d-flex justify-content-between"
                                id="connected-album-name-{{$component->album ? $component->album->id : ''}}">
                                {{ $component->album ? $component->album->title : ' - ' }}
                                <i class="px-3 fa-regular fa-pen-to-square" style="color: #f7f7f7;cursor: pointer"></i>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
