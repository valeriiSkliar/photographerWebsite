@extends('layouts.iframe')

@section('admin.content')
    <div class="ml-3 row">
        <h5>Add section</h5>
        <div class="col-12">
            <form action="{{ route('sections.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="page_id">Page_id:</label>
                            <input type="text" name="page_id" id="page_id" class="form-control" value="{{ $page->id ?? 1}}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="order">Order:</label>
                            <input type="number" name="order" id="order" class="form-control" value="0">
                        </div>
                        <div class="form-group col-12">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row">

                            <div class="form-group col-12">
                                <label for="description">Description:</label>
                                <textarea
                                    style="min-height: 150px; height: fit-content"
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-4">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection




