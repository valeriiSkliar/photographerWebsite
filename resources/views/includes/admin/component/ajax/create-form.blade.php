    <div class="row">
        <form
                id="addComponentForm"
            class="px-3 col-md-12"
            method="POST" action="{{ route('components.store') }}">
            @csrf

            <input type="hidden" name="page_id" value="{{ $page->id }}">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-2">Create Component</h4>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="component_title">Component Title:</label>
                            <input type="text" class="form-control" id="component_title" name="component_title">
                        </div>
                        <div class="form-group col-6">
                            <label for="name">Template name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <h5 class="my-1">Details</h5>
                </div>
                <div class="form-group col-md-6">
                    <button
                        type="button"
                        class="btn btn-success btn-sm mb-3"
                        id="addComponentDetail"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>
                    </button>
                </div>
                <div class="form-group col-md-12"
                     id="component-details">
                        <div class="form-row col-md-12 component-detail">
                            <div class="form-group col-md-3">
                                <label for="details[0][key]">Key:</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="details[0][key]"
                                    name="details[0][key]"
                                    required
                                >
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="value_en" class="col-sm-2 col-form-label">Value (English)</label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="value_en"
                                                name="details[0][value]"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="value_de" class="col-sm-2 col-form-label">Value (German)</label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="value_de"
                                                name="translations[0][de]"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class= "form-group col-md-1">
                                <label for="delete[0]" >Delete:</label>
                                <button
                                    id="delete[0]"
                                    onclick="event.preventDefault()"
                                    href="javascript:void(0);"
{{--                                    class="btn btn-danger w-100"--}}
                                    class="btn btn-outline-danger w-100"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         height="0.8em"
                                         viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                </div>
                @if(isset($albums))
                    <div class="col-12 col-md-6 col-lg-3 form-group">
                        <label for="album_id">Connect Album:</label>
                        <select class="form-control" id="album_id" name="album_id">
                            <option value="">Select Album</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->title }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button
                        id="canselAddComponentButton"
                        onclick="event.preventDefault()" class="btn btn-warning">
                        Cansel
                    </button>
                </div>
            </div>
        </form>
    </div>
