@extends('imagemanager::layouts.master')
    @pushonce('iframe.style')
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    @endpushonce

    @pushonce('iframe.script')
        <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @endpushonce


@section('admin.content')
    <div class="container">
        <h3 class="text-center">Upload Images</h3>

        <form action="{{ route('imagemanager.store') }}" enctype="multipart/form-data" class="dropzone" id="image-upload">
            @csrf
        </form>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            url: "/admin/imagemanager",
            maxFilesize: 2, // MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            success:function(file, response) {
                if (response.success) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: 'rgba(0,0,0,0)',
                        padding: '0.5rem',
                        border: 'none',
                    });
                }
            },
            error: function(file, response) {
                let errorMessage = "Bed format, only .jpeg,.jpg,.png,.gif";

                if (typeof response === 'object' && response.message) {
                    console.log(response.message)
                    errorMessage = response.message;
                }

                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: errorMessage,
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: '#dc3545',
                    padding: '0.5rem',
                    border: 'none',
                });
            }
        };
    </script>
@endsection
