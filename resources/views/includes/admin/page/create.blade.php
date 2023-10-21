@extends('layouts.iframe')
@section('admin.content')
<div class="container-fluid">
    <div class=" ml-2 mt-2 row">
        <div class="col-md-3">
            <h5>Create New Page</h5>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.page.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}">
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="meta_data">Meta Data:</label>
                    <input type="text" id="meta_data" name="meta_data" class="form-control" value="{{ old('meta_data') }}">
                </div>

                <button type="submit" class="btn btn-primary">Create Page</button>
            </form>

        </div>
    </div>
    <div class=" ml-2 mt-2 row">
        <div class="col-md-3"></div>
        <a
            id="add_meta_tegs_btn"
            href="javascript:void(0);" class="btn-success btn d-block my-3">Add meta teg:</a>
    </div>

</div>
    <script>


    </script>
@endsection
{{--@include('/includes/admin/section/index')--}}
