
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
                            id="sortable"
                            class="componentRow"
                            data-componentId="{{ $component->id }}"
                        >
                            <td>
                                <i class="fa-solid fa-arrows-up-down-left-right" style="color: #f7f7f7;"></i>
                                {{ $component->name }}
                            </td>
                            <td id="connected-album-name-{{$component->album ? $component->album->id : ''}}">
                                {{ $component->album ? $component->album->title : ' - ' }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
