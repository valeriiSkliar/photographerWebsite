
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
                            data-list_order="{{ $index }}"
                        >
                            <td>
                                <svg class="pr-2" xmlns="http://www.w3.org/2000/svg" fill="white" height="1em" viewBox="0 0 320 512">
                                   <path d="M182.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L128 109.3V402.7L86.6 361.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7V109.3l41.4 41.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-96-96z"/>
                                </svg>
                                {{ $component->name }}
                            </td>
                            <td>
                                {{ $component->album ? $component->album->title : ' - ' }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
