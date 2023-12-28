@pushonce('iframe.style')
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/lightbox2/css/lightbox.min.css')}}">
    @vite('resources/scss/admin/gallery/layouts/all_images.scss')
@endpushonce

@pushonce('iframe.script')
    <script src="{{ asset('AdminLTE/plugins/lightbox2/js/lightbox.min.js') }}"></script>
@endpushonce
    @foreach($images as $image)
        @can('superAdminImageAccess', $image)
            <div class="col-sm-6 col-md-4 mb-3 image_from_all_heaps">
                <div class="checkbox icheck-success"
                     style="position: absolute; top: 5px; left: 18px; z-index: 1">
                    <input type="checkbox" class="image-checkbox" data-image-id="{{ $image->id }}"
                           id="imgSelector{{ $image->id }}" name="success{{ $image->id }}">
                    <label for="imgSelector{{ $image->id }}"></label>
                </div>
                <a href="{{ asset($image->file_url) }}" class="wrapper-for-lazy-image" data-lightbox="all-images"
                   data-title="{{ $image->tilte }}">
                    <div class="aspect-ratio-16-9 rounded"></div>
                    <img src="{{ asset($image->file_url_small) }}"
                         class="fluid img-thumbnail lazy-image-thumbnail"
                         alt="{{ $image->alt_text }}"
                         title="{{ $image->title }}"
                        loading="lazy"
                    >
                </a>
                <div class="btn-group image-controls">
                    <button type="button" class="btn btn-sm btn-outline-warning p-0"
                            data-toggle="dropdown"
                            data-offset="-1, 0" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right m-0 p-0 mt-2"
                         style="min-width: auto; background-color: unset; border: unset; box-shadow: unset;">
                        <a href="{{ route('images.edit', $image) }}"
                           class="dropdown-item text-center m-0 p-0"
                           style="background-color: unset; border: unset">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('images.destroy', $image) }}" method="POST"
                              class="dropdown-item text-center m-0 p-0 mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" btn-delete text-center p-0">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    @endforeach
</div>
