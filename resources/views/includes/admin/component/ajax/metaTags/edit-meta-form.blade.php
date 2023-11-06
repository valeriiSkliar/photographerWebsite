@php
    $meta_tags = isset($page) ? $page->meta_tags : $updatedMetaTags;
@endphp

@if($meta_tags && count($meta_tags) > 0)
    @foreach($meta_tags as $meta_tag)
        <div class="col-12">
            <div class="meta-tag-item row">
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
                        class="typeSelect form-control {{$meta_tag->type->type ? 'is-valid' : ''}}">
                        <option>Select type</option>
                        @if(isset($metaTagTypes))
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
                        <input type="hidden" name="metaData[{{$loop->index}}][type_id]" value="{{ $meta_tag->type->id }}"/>
                    @endif
                </div>

                <div class="col-3 mb-2">
                    <label

                        class="form-label"
                        for="valueSelect-{{ $loop->index }}">
                        Meta value:
                    </label>

                    @php
                        if ($meta_tag->type){$selectOptions = $meta_tag->type->type == 'name' ? $meta_tags_names : $meta_tags_properties;}
                    @endphp
                    <select
                        {{$meta_tag->value ? 'disabled' : ''}}
                        name="metaData[{{$loop->index}}][value]"
                        id="valueSelect-{{ $loop->index }}"
                        class="valueSelect form-control {{$meta_tag->value ? 'is-valid' : ''}}">
                        <option value="" >Select value</option>
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
                            name="metaData[{{$loop->index}}][value]"
                            value="{{ $meta_tag->value }}"
                        />
                    @endif
                </div>

                <div class="col-6 mb-2">
                    <label
                        class="form-label"
                        for="content-{{ $loop->index }}">
                        Meta content:
                    </label>
                    <input value="{{ $meta_tag->content }}"
                           class="form-control {{$meta_tag->content ? 'is-valid' : ''}}"
                           id="content-{{ $loop->index }}"
                           name="metaData[{{$loop->index}}][content]"
                           placeholder="Input content here!"
                           type="text">
                </div>
                <!-- Delete button for the row -->
                <div class="col-1 mb-2 d-flex align-items-end justify-content-center">
                    <p
                        onclick="event.preventDefault()"
                        type="button"
                        class="btn btn-danger delete-meta-tag"
                        data-meta_tag_id="{{ $meta_tag->id }}">
                        x
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@endif



