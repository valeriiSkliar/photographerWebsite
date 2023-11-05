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
                            <div class="col-md-4 position-relative">
                                    <form
                                        class="btn-delete position-absolute"
                                        action="{{ route('admin.pages.destroy', $page->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <div class="card @if($key % 2 == 0) bg-dark @else bg-secondary @endif text-light" onclick="location.href='{{route('admin.pages.show', $page->id)}}';" style="cursor:pointer;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $page->name }}</h5>
                                            <p class="card-text"><strong>Slug:</strong> {{ $page->slug }}</p>
                                            <div class="mt-5">
                                                <a href="{{ route('admin.pages.edit', $page->id) }}"
                                                   class="btn btn-info mb-md-2 mb-lg-auto mr-1" role="button">Page <i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.pages.edit', $page->id) }}"
                                                   class="btn btn-warning mb-md-2 mb-lg-auto" role="button">MetaTags <i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
