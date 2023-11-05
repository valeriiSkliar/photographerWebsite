{{--<template>--}}
<div class="col-12">
    <div class="meta-tag-item row">
        <input value="{{ $meta_tag->id }}"
               name="metaData[{{count($meta_tags) }}][teg_id]"
               type="hidden">
        <div class="col-2 mb-2">
            <label for=`typeSelect-{{ count($meta_tags) }}`>Meta type:</label>
            <select
                disabled
                name=`metaData[{{ count($meta_tags) }}][type_id]`
                id=`typeSelect-{{ count($meta_tags) }}`
                class="typeSelect form-control">
                <option>Select type</option>
                @if($metaTagTypes)
                    @foreach($metaTagTypes as $metaTagType)
                        <option
                            data-type="{{ $metaTagType->type }}"
                            @if($meta_tag->type)
                                {{ $meta_tag->type->type ==  $metaTagType->type ? 'selected' : ''}}
                            @endif
                            value="{{ $metaTagType->id }}">{{ $metaTagType->type }}</option>
                    @endforeach
                @endif
            </select>
            @if($meta_tag->type)
                <input type="hidden" name="metaData[{{count($meta_tags)}}][type_id]" value="{{ $meta_tag->type->id }}"/>
            @endif
        </div>

        <div class="col-3 mb-2">
            <label for="valueSelect-{{ count($meta_tags) }}">
                Meta value:
            </label>
            <select
                name="metaData[{{ count($meta_tags) }}][value]"
                id="valueSelect-{{ count($meta_tags) }}"
                class="valueSelect form-control">
                <option value="">Select value</option>
                @php
                    if ($meta_tag->type){$selectOptions = $meta_tag->type->type == 'name' ? $meta_tags_names : $meta_tags_properties;}
                @endphp
                @foreach($selectOptions as $selectOption)
                    <option
                        {{--                            data-type="{{ $selectOption[$meta_tag->type->type] }}"--}}
                        @if($meta_tag->type)
                            {{ $selectOption[$meta_tag->type->type] == $meta_tag->value ? 'selected' : ''}}
                        @endif
                        value="{{$meta_tag->type ? $selectOption[$meta_tag->type->type] : '' }}">{{ $meta_tag->type ? $selectOption[$meta_tag->type->type] : '' }}</option>
                @endforeach
            </select>
            @if($meta_tag->value)
                <input
                    type="hidden"
                    name="metaData[{{count($meta_tags)}}][value]"
                    value="{{ $meta_tag->value }}"
                />
            @endif
        </div>

        <div class="col-6 mb-2">
            <label for="content-{{ count($meta_tags) }}">Meta content:</label>
            <input
                class="form-control"
                id="content-{{ count($meta_tags) }}"
                name="metaData[{{ count($meta_tags) }}][content]"
                placeholder="input content here!"
                type="text">
        </div>
        <div class="col-1 mb-2 d-flex align-items-end justify-content-center">
            <button
                onclick="event.preventDefault()"
                id="deleteNewMetaRow"
                type="button"
                class="btn btn-warning delete-meta-tag"
                data-meta_tag_id="{{ $meta_tag->id }}">
                -
            </button>
        </div>
    </div>
</div>
{{--</template>--}}
