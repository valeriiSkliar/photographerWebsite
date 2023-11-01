@extends('layouts.iframe')

@section('admin.content')
    <div class="row px-4 justify-content-center">
        <h5 class="mt-4 display-4">Add section</h5>
        <div class="d-flex col-12 justify-content-center">
            <form action="{{ route('sections.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-auto">
                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="page_id">Page:</label>
                            <select name="page_id" id="page_id" class="form-control" required>
                                <option selected disabled value="">Select the page</option>
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->name }}</option>
                                @endforeach
                            </select>
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

                    <div class="col-auto">
                        <div class="row">

                            <div class="form-group col-12">
                                <label for="description">Description:</label>
                                <textarea
                                    style="min-width: 300px; min-height: 150px; height: fit-content"
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto mt-4">
                    <input type="submit" value="Add new section" class="btn btn-primary">
                </div>
            </form>
        </div>

    </div>
@endsection




