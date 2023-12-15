<div id="all-components-list" class="col-md-10 d-flex flex-column">
    @if($components)
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Component Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($components as $index => $component)
                <tr class="componentRow"
                    data-componentId="{{ $component->id }}"
                    data-component_name="{{ $component->name }}"
                >
                    <td>{{ $component->component_title}}</td>
                    <td class="d-flex justify-content-between">
                        @if($component->pages->where('id', $page->id)->first()?->id === $page->id)
                            <button
                                data-action="{{$component->id}}"
                                class="removeComponentAction btn btn-danger btn-sm"
                            >Remove from current page
                            </button>
                        @else
                            <button
                                data-action="{{$component->id}}"
                                class="addComponentAction btn btn-success btn-sm"
                            >Add to current page
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
