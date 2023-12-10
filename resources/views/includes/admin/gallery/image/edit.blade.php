@extends('layouts.iframe')
@section('admin.content')
    @pushonce('iframe.style')
        <style>
            .copy-success {
                animation: copySuccess 0.5s ease-in-out forwards;
                transform-origin: center;
                transform: rotate(360deg);
            }

            .pe-none {
                pointer-events: none;
            }

            @keyframes copySuccess {
                0% {
                    color: #28a745;
                    transform: rotate(0deg);
                }

                100% {
                    color: #28a745;
                    transform: rotate(360deg);
                }
            }
        </style>
    @endpushonce
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-10 p-4 p-md-0 m-auto">
                <h3>Edit Image</h3>
                <form action="{{ route('images.update', $image) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{  Form::hidden('url',URL::previous())  }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="file_url" class="col-form-label">File URL</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="file_url"
                                    name="file_url"
                                    style="font-size: 12px"
                                    value="{{ $image->file_url }}"
                                >
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                            onclick="copyToClipboard(event)">
                                        <i class="fas fa-copy pe-none"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $image->name }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $image->title }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="rank" class="col-form-label">Rank</label>
                            <input type="number" class="form-control" id="rank" name="rank" value="{{ $image->rank }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="alt_text" class="col-form-label">Alt Text</label>
                            <input type="text" class="form-control" id="alt_text" name="alt_text"
                                   value="{{ $image->alt_text }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="col-form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status"
                                   value="{{ $image->status }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            Back to Previous Page
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @pushonce('iframe.script')
        <script>
            function copyToClipboard(event) {
                event.target.disabled = true;
                /* Get the text field */
                const copyText = document.getElementById('file_url').value;
                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText);

                event.target.classList.add('copy-success');
                event.target.classList.add('btn-outline-success');

                setTimeout(() => {
                    event.target.classList.remove('copy-success');
                    event.target.disabled = false;
                }, 1000);
            }
        </script>
    @endpushonce
@endsection
