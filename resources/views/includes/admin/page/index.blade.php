@extends('layouts.iframe')

@push('iframe.script')
    @vite(['resources/js/admin/page/admin_page_index.js'])
@endpush

@push('iframe.style')
    @vite(['resources/scss/admin/page/admin_page_index.scss'])
@endpush

@section('admin.content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pages</h2>

                <div class="container mt-5">
                    <div class="row">

                        @foreach($pages as $key => $page)
                            <div class="col-md-4 mb-4 position-relative">
                                {{--                            <a href="{{ route('admin.pages.show', $page->id) }}" class="text-decoration-none text-white">--}}
                                <div class="card @if($key % 2 == 0) bg-dark @else bg-secondary @endif text-light">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $page->name }}</h5>
                                        <p class="card-text"><strong>Slug:</strong> {{ $page->slug }}</p>
                                        <div class="btn-group mt-5" role="group">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                               class="btn btn-primary">Edit</a>
                                            <form
                                                class="btn-delete"
                                                action="{{ route('admin.pages.destroy', $page->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--                            </a>--}}
                            </div>
                        @endforeach


                        <!-- Repeat the above card structure for other pages (Page 2 to Page 5) -->

                    </div>
                </div>

                {{--                <div class="container mt-5">--}}
                {{--                    <div class="row">--}}

                {{--                        @foreach($pages as $key => $page)--}}
                {{--                            <div class="col-md-4 mb-4 position-relative">--}}
                {{--                                <a href="{{ route('admin.pages.show', $page->id) }}"--}}
                {{--                                   class="text-decoration-none text-white">--}}
                {{--                                    <div class="card @if($key % 2 == 0) bg-dark @else bg-secondary @endif text-light">--}}
                {{--                                        <div class="card-body">--}}
                {{--                                            <h5 class="card-title">{{ $page->name }}</h5>--}}
                {{--                                            <p class="card-text"><strong>Slug:</strong> {{ $page->slug }}</p>--}}
                {{--                                            <p class="card-text"><strong>Meta Data:</strong> {{ $page->meta }}</p>--}}
                {{--                                            <div class="text-end">--}}
                {{--                                                <a href="{{ route('admin.pages.edit', $page->id) }}"--}}
                {{--                                                   class="btn btn-outline-light me-2"><i class="fas fa-edit"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                            <form--}}
                {{--                                                action="{{ route('admin.pages.destroy', $page->id) }}"--}}
                {{--                                                method="post"--}}
                {{--                                                class="position-absolute top-0 end-0 p-2"--}}
                {{--                                                onclick="return confirm('Are you sure you want to delete this page?')">--}}
                {{--                                                @csrf--}}
                {{--                                                @method('DELETE')--}}
                {{--                                                <button type="submit" class="btn btn-sm btn-danger">--}}
                {{--                                                    <i class="fas fa-trash-alt"></i>--}}
                {{--                                                </button>--}}
                {{--                                            </form>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </a>--}}
                {{--                            </div>--}}
                {{--                        @endforeach--}}

                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
