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
                <label for="details[0][value]" class="col-sm-2 col-form-label">Value
                    (English)</label>
                <div class="col-sm-10">
                    <input
                        value=""
                        type="text"
                        class="form-control"
                        id="details[0][value]"
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
{{--    <div class="form-group col-md-8">--}}
{{--        <label for="details[0][value]">Value:</label>--}}
{{--        <input type="text" class="form-control" id="details[0][value]" name="details[0][value]" required>--}}
{{--    </div>--}}
    <div class= "form-group col-md-1">
        <label for="delete[0]" >Delete:</label>
        <button
                id="delete[0]"
                onclick="event.preventDefault()"
                href="javascript:void(0);"
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
