@extends('layouts.iframe')

@section('admin.content')
    <div class="container mt-5">
        <h2>Create New Form</h2>

        <form action="{{ route('forms.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="formName">Form Name:</label>
                <input type="text" name="name" id="formName" class="form-control" required>
            </div>

            <hr>

            <h4>Form Fields:</h4>
            <div id="fieldsContainer">
                <!-- Dynamically added fields will appear here -->
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Add Field</button>

            <hr>

            <button type="submit" class="btn btn-primary">Save Form</button>
        </form>
    </div>

    <script>
        function addField() {
            const container = document.getElementById('fieldsContainer');
            console.dir(container)
            const fieldDiv = document.createElement('div');
            fieldDiv.className = 'mb-3';

            const labelInput = document.createElement('input');
            labelInput.setAttribute('type', 'text');
            labelInput.setAttribute('name', `fields[${container.children.length}][label]`);
            labelInput.className = 'form-control mb-2';
            labelInput.placeholder = 'Field Label';

            const nameInput = document.createElement('input');
            nameInput.setAttribute('type', 'text');
            nameInput.setAttribute('name', `fields[${container.children.length}][name]`);
            nameInput.className = 'form-control mb-2';
            nameInput.placeholder = 'Field Name';

            const typeSelect = document.createElement('select');
            typeSelect.setAttribute('name', `fields[${container.children.length}][type]`);
            typeSelect.className = 'form-control mb-2';
            ['text', 'number', 'date', 'submit'].forEach(type => {
                const option = document.createElement('option');
                option.value = type;
                option.textContent = type.charAt(0).toUpperCase() + type.slice(1);
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

        // Add the first field on page load
        window.onload = function() {
            addField();
        }
    </script>
@endsection
