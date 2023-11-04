@php
$meta_tags = isset($page) ? $page->meta_tags : $updatedMetaTags;
@endphp

    @if($meta_tags && count($meta_tags) > 0)
        @foreach($meta_tags as $meta_tag)
            <input value="{{ $meta_tag->id }}"
                   name="metaData[{{$loop->index}}][teg_id]"
                   type="hidden">
            <div class="col-2 mb-2">
                <label
                    for="typeSelect-{{ $loop->index }}"
                    class="form-label"> Meta type:</label>
                <select
                    disabled
                    name="metaData[{{ $loop->index }}][type_id]"
                    id="typeSelect-{{ $loop->index }}"
                    class="typeSelect form-control">
                    <option value="">Select type</option>
                    @if(isset($metaTagTypes))
                        @foreach($metaTagTypes as $metaTagType)
                            <option
                                data-type="{{ $metaTagType->type }}"
                                {{ $meta_tag->type->type ==  $metaTagType->type ? 'selected' : ''}}
                                value="{{ $metaTagType->id }}">{{ $metaTagType->type }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-3 mb-2">
                <label

                    class="form-label"
                    for="valueSelect-{{ $loop->index }}">
                    Meta value:
                </label>

                @php
                $selectOptions = $meta_tag->type->type == 'name' ? $meta_tags_names : $meta_tags_properties;
                @endphp
                <select
                    disabled

                    name="metaData[{{$loop->index}}][value]"
                    id="valueSelect-{{ $loop->index }}"
                    class="valueSelect form-control">
                    <option value="">Select value</option>
                    @foreach($selectOptions as $selectOption)
                        <option
{{--                            data-type="{{ $selectOption[$meta_tag->type->type] }}"--}}
                            {{ $selectOption[$meta_tag->type->type] == $meta_tag->value ? 'selected' : ''}}
                            value="{{ $selectOption[$meta_tag->type->type] }}">{{ $selectOption[$meta_tag->type->type] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 mb-2">
                <label
                    class="form-label"
                    for="content-{{ $loop->index }}">
                    Meta content:
                </label>
                <input value="{{ $meta_tag->content }}"
                       class="form-control"
                       id="content-{{ $loop->index }}"
                       name="metaData[{{$loop->index}}][content]"
                       placeholder="Input content here!"
                       type="text">
            </div>
            <!-- Delete button for the row -->
            <div class="col-1 mb-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger delete-meta-tag" data-meta-tag-id="{{ $meta_tag->id }}">
                    x
                </button>
            </div>
        @endforeach
    @endif
        <!-- Button to add new row -->
        <div class="col-12 mt-3">
            <button
                type="button"
                class="btn btn-primary"
                id="add-meta-tag">
                Add New Row
            </button>
        </div>


