<div class="col-3 mb-2">
    <label for="typeSelect-{{ count($page->meta_tags) }}">Meta type:</label>
    <select
        name="metaData[{{ count($page->meta_tags) }}][type_id]"
        id="typeSelect-{{ count($page->meta_tags) }}"
        class="typeSelect form-control">
        <option value="">Select type</option>
        @if($metaTagTypes)
            @foreach($metaTagTypes as $metaTagType)
                <option
                    data-type="{{ $metaTagType->type }}"
                    value="{{ $metaTagType->id }}">{{ $metaTagType->type }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-3 mb-2">
    <label for="valueSelect-{{ count($page->meta_tags) }}">
        Meta value:
    </label>
    <select
        name="metaData[{{ count($page->meta_tags) }}][value]"
        id="valueSelect-{{ count($page->meta_tags) }}"
        class="valueSelect form-control">
        <option value="">Select value</option>
    </select>
</div>
<div class="col-6 mb-2">
    <label for="content-{{ count($page->meta_tags) }}">Meta content:</label>
    <input
        disabled
        class="form-control"
        id="content-{{ count($page->meta_tags) }}"
        name="metaData[{{ count($page->meta_tags) }}][content]"
        placeholder="input content here!"
        type="text">
</div>

