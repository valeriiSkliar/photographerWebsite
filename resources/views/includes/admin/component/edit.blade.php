<h1>Edit Component</h1>
@php
    $start_coun_details = $component->details->last()->id ?? 1;
@endphp
<form method="POST" action="{{ route('components.update', $component->id) }}">
    @csrf
    @method('PATCH')
    <label>Section:</label>
    <select type="text" name="section_id" required>
        @foreach($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>

    <label>Type:</label>
    <input
        value="{{ $component->type }}"
        type="text"
        name="type" required>

    {{--    <label>Name:</label>--}}
    {{--    <input type="text" name="name" required>--}}

    <h2>Component Details</h2>
    <div id="component-details">
        @foreach($component->details as $detail)
        <div class="component-detail">
                <label>Key:</label>
                <input
                    type="text"
                    name="details[{{ $detail->id }}][key]"
                    value="{{ $detail->key }}"
                    required>
                <label>Value:</label>
                <input
                    type="text"
                    name="details[{{ $detail->id }}][value]"
                    value="{{ $detail->value }}"
                    required>

        </div>
        @endforeach
    </div>
    <button type="button" id="addComponentDetail">Add Another Detail</button>

    <button type="submit">Save</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const componentDetailsContainer = document.getElementById('component-details');
        const addComponentDetailButton = document.getElementById('addComponentDetail');

        let detailCount = {{ $start_coun_details == 1 ? $start_coun_details : $start_coun_details + 1 }};

        addComponentDetailButton.addEventListener('click', function() {
            const newDetailDiv = document.createElement('div');
            newDetailDiv.className = 'component-detail';

            const keyLabel = document.createElement('label');
            keyLabel.textContent = 'Key:';
            const keyInput = document.createElement('input');
            keyInput.type = 'text';
            keyInput.name = `details[${detailCount}][key]`;
            keyInput.required = true;

            const valueLabel = document.createElement('label');
            valueLabel.textContent = 'Value:';
            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.name = `details[${detailCount}][value]`;
            valueInput.required = true;

            newDetailDiv.appendChild(keyLabel);
            newDetailDiv.appendChild(keyInput);
            newDetailDiv.appendChild(valueLabel);
            newDetailDiv.appendChild(valueInput);

            componentDetailsContainer.appendChild(newDetailDiv);

            detailCount++;
        });
    });
</script>

