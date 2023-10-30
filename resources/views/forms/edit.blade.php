@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-5">
        <h2>Edit Form: {{ $form->name }}</h2>

        <form action="{{ route('forms.update', $form->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="formName">Form Name:</label>
                <input type="text" name="name" id="formName" class="form-control" value="{{ $form->name }}" required>
            </div>

            <hr>

            <h4>Form Fields:</h4>
            <div id="fieldsContainer">
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Add Field</button>

            <hr>

            <button type="submit" class="btn btn-primary">Update Form</button>
        </form>
    </div>

    <script>
        function addField(label = '', name = '', type = 'text') {
            const container = document.getElementById('fieldsContainer');

            const fieldDiv = document.createElement('div');
            fieldDiv.className = 'mb-3';

            const labelInput = document.createElement('input');
            labelInput.setAttribute('type', 'text');
            labelInput.setAttribute('name', `fields[${container.children.length}][label]`);
            labelInput.className = 'form-control mb-2';
            labelInput.placeholder = 'Field Label';
            labelInput.value = label;

            const nameInput = document.createElement('input');
            nameInput.setAttribute('type', 'text');
            nameInput.setAttribute('name', `fields[${container.children.length}][name]`);
            nameInput.className = 'form-control mb-2';
            nameInput.placeholder = 'Field Name';
            nameInput.value = name;

            const typeSelect = document.createElement('select');
            typeSelect.setAttribute('name', `fields[${container.children.length}][type]`);
            typeSelect.className = 'form-control mb-2';
            ['text', 'number', 'date', 'submit'].forEach(t => {
                const option = document.createElement('option');
                option.value = t;
                option.textContent = t.charAt(0).toUpperCase() + t.slice(1);
                if (t === type) option.selected = true;
                typeSelect.appendChild(option);
            });

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.textContent = 'Remove';
            removeButton.onclick = function() {
                container.removeChild(fieldDiv);
            }

            fieldDiv.appendChild(labelInput);
            fieldDiv.appendChild(nameInput);
            fieldDiv.appendChild(typeSelect);
            fieldDiv.appendChild(removeButton);

            container.appendChild(fieldDiv);
        }

        window.onload = function() {
            @json($form->fields).forEach(field => {
                addField(field.label, field.name, field.type);
            });
        }
    </script>
@endsection
