
<div class="ml-3 row">
    <h5>Add section</h5>
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="form-group col-12">
                    <label for="name">Name:</label>
                    <input type="text" name="sectionData[0][name]" id="name" class="form-control" required>
                </div>
                {{--            <div class="form-group col-2">--}}
                {{--                <label for="page_id">Page:</label>--}}
                {{--                <select name="sectionData[0][page_id]" id="page_id" class="form-control">--}}
                {{--                    @foreach ($pages as $page)--}}
                {{--                        <option value="{{ $page->id }}">{{ $page->name }}</option>--}}
                {{--                    @endforeach--}}
                {{--                </select>--}}
                {{--            </div>--}}

                <div class="form-group col-12">
                    <label for="order">Order:</label>
                    <input type="number" name="sectionData[0][order]" id="order" class="form-control" value="0">
                </div>
                <div class="form-group col-12">
                    <label for="background_color">Background Color:</label>
                    <input type="color" name="sectionData[0][background_color]" id="background_color" class="form-control" required>
                </div>
                <div class="form-group col-12">
                    <label for="title">Title:</label>
                    <input type="text" name="sectionData[0][title]" id="title" class="form-control" required>
                </div>
            </div>

            <div class="col-3">
                <div class="row">
                    {{--                    <div class="form-group col-3">--}}
                    {{--                        <label for="font">Font:</label>--}}
                    {{--                        <input type="text" name="font" id="font" class="form-control" required>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="form-group col-3">--}}
                    {{--                        <label for="font_color">Font Color:</label>--}}
                    {{--                        <input type="color" name="font_color" id="font_color" class="form-control" required>--}}
                    {{--                    </div>--}}

                    <div class="form-group col-12">
                        <label for="description">Description:</label>
                        <textarea
                            style="min-height: 150px; height: fit-content"
                            name="sectionData[0][description]"
                            id="description"
                            class="form-control"
                            required></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="content_text">Content Text:</label>
                        <textarea name="sectionData[0][content_text]" id="content_text" class="form-control"></textarea>
                    </div>
                    {{--                    <div class="form-group col-12">--}}
                    {{--                        <label for="background_image">Background Image:</label>--}}
                    {{--                        <input type="file" name="sectionData[0][background_image]" id="background_image" class="form-control-file" accept="image/*">--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>

    </div>

</div>




