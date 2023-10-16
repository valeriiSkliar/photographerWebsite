<h1>Component {{ $component->type }}</h1>
<p>Component belong to <b>{{ $component->section->name }}</b> section</p>

<p>Order: {{ $component->order }}</p>

<h2>Component Details</h2>
<ul>
    @foreach($component->details as $detail)
        <li><strong>{{ $detail->key }}</strong>: {{ $detail->value }}</li>
    @endforeach
</ul>
{{--{{ dd($component) }}--}}
<a href="{{ route('components.edit', $component) }}">Edit</a>
