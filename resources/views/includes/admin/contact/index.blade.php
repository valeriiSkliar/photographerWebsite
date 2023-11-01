@extends('layouts.iframe')
@pushonce('iframe.script')
    @if(session('success_message'))
        <script>
            Swal.fire(sweetAlertConfigs.success("{{ session('success_message') }}"));
        </script>
    @endif

    @if(session('error_message'))
        <script>
            Swal.fire(sweetAlertConfigs.error("{{ session('error_message') }}"));
        </script>
    @endif
@endpushonce

@section('admin.content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Contact</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contacts.update', $contact) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                @foreach($contact_keys as $value)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $value }}">{{ ucfirst($value) }}</label>
                                            <input
                                                type="{{ $value === 'email' ? $value : 'text' }}"
                                                name="{{ $value }}"
                                                id="{{ $value }}"
                                                class="form-control"
                                                value="{{ $contact[$value] ?? '' }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
