@extends('layouts.iframe')

@section('admin.content')
<div class="container">
    <h3>{{ $form->name }}</h3>
    {!! form($formTemplate) !!}
</div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            [...document.querySelectorAll('button[type="submit"]')].forEach(item => {
                item.disabled = true;
            })
        })
    </script>
@endsection
