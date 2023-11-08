<template
        style="min-width: 1200px"
        id="my-template">
    <swal-title>
        Edit / Delete / Add meta tags!
    </swal-title>
    <swal-html>
        <form
            style="min-height: 8rem"
            method="POST">
            <input
                    id="currentPageId"
                    type="hidden" name="page_id" value="{{ $page->id }}">
            @csrf
            <div
                    id="meta-tags-container"
                    style="display: none"
                    class="meta-tags-container row">
                @include('includes.admin.component.ajax.metaTags.edit-meta-form')
            </div>
        </form>
        <!-- Button to add new row -->
        <div
                role="group"
                aria-label="Button group"
                class="btn-group">
            <button
                    aria-expanded="false"
                    data-bs-toggle="dropdown"
                    onclick="event.preventDefault()"
                    type="button"
                    class="btn btn-warning dropdown-toggle"
            >
                Add new meta tag.
            </button>
            <ul class="dropdown-menu">
                @if(isset($metaTagTypes))
                    @foreach($metaTagTypes as $metaTagType)
                        <li>
                            <button
                                    data-action="{{$metaTagType->type}}"
                                    data-type_id="{{$metaTagType->id}}"
                                    type="button"
                                    class="add-meta-tags-row dropdown-item btn btn-primary"
                                    id="meta-tags-add-{{$metaTagType->type}}">
                                Add {{$metaTagType->type}}
                            </button>
                        </li>
                    @endforeach
                @endif
{{--                <li>--}}
{{--                    <button--}}
{{--                            data-action="name"--}}
{{--                            data-type_id="2"--}}
{{--                            type="button"--}}
{{--                            class="dropdown-item btn btn-primary"--}}
{{--                            id="meta-tags-add-name">--}}
{{--                        Add Name--}}
{{--                    </button>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <button--}}
{{--                            data-action="property"--}}
{{--                            data-type_id="1"--}}
{{--                            type="button"--}}
{{--                            class="dropdown-item btn btn-primary"--}}
{{--                            id="meta-tags-add-property">--}}
{{--                        Add Property--}}
{{--                    </button>--}}
{{--                </li>--}}
            </ul>
        </div>
    </swal-html>
    <swal-button
            type="confirm">
        Confirm
    </swal-button>

    <swal-button type="cancel">
        Cancel
    </swal-button>
    <swal-param name="allowEscapeKey" value="false"/>
    <swal-param
            name="customClass"
            value='{ "popup": "my-popup" }'/>
    <swal-function-param
            name="willClose"
            value="popup => popup"/>
    <swal-function-param
            name="didOpen"
            value="popup => popup"/>
</template>
