@extends('sectioncomponent::layouts.master')

@section('content')
    <div class="container">
        <h2>Component Details</h2>
        <div class="mb-3">
            <strong>Type:</strong> {{ $component->type }}
        </div>

        <div class="mb-3">
            <strong>Name:</strong> {{ $component->name }}
        </div>

        <div class="mb-3">
            <strong>Data:</strong>
            <pre>{{ $component->data }}</pre>
        </div>

        <div class="mb-3">
            <strong>Section:</strong> {{ $component->section->name ?? 'N/A' }}
        </div>

        @if($component->componentData)
            {{ $component->componentData }}
        @endif


        <a href="{{ route('sections_component.edit', $component->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('sections_component.destroy', $component->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>



        <a href="{{ route('sections_component.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection

