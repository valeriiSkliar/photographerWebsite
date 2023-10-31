@extends('layouts.iframe')

@section('admin.content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Contact</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('contacts.store') }}" method="POST">
                                @csrf
                                @foreach($contact_keys as $value)
                                    {{ $contact[$value] }}<br>
                                    <div class="form-group">
                                        <label for="{{ $value }}">{{ ucfirst($value) }}</label>
                                        <input
                                            type="{{ $value === 'email' ? $value : 'text' }}"
                                            name="{{ $value }}"
                                            id="{{ $value }}"
                                            class="form-control"
                                            value="{{ $contact[$value]??'' }}">
                                    </div>
                                @endforeach

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
