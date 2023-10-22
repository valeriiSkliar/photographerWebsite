import axios from "axios";
const typeSelect = document.getElementById('typeSelect');

const add_meta_tegs_btn = document.getElementById('add_meta_tegs_btn');
const addNewRow = document.getElementById('addNewRow');
document.addEventListener('DOMContentLoaded', () => {
    addNewRow.addEventListener('click', addNewRowFunc)
})
let data = null;
async function addMetaTeg() {
    return axios.get('/api/meta-tags')
        .then(response => {
            return  response;
        })
}

add_meta_tegs_btn.addEventListener('click', () => {
    axios.post('/api/meta-tags').then(r => console.log(r))
})

document.addEventListener("DOMContentLoaded", async function() {
    const fetchData = await addMetaTeg();
    data = fetchData.data;
    data.types.forEach(({id, type}) => {
        typeSelect[id] = new Option(type, type, false, false);
    })
    // populateValues(this);
    const typeSelects = document.querySelectorAll('.typeSelect');
    typeSelects.forEach(select => {
        select.addEventListener('change', function() {
            populateValues(this);
        });
    });

    // populateValues(typeSelects[0]);
});

function populateValues(typeSelect) {
    const valueSelect = typeSelect.nextElementSibling;
    const selectedType = typeSelect.value;
    while (valueSelect.firstChild) {
        valueSelect.removeChild(valueSelect.firstChild);
    }

    data[selectedType].forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.name || item.property;
        valueSelect.appendChild(option);
    });
}

function addNewRowFunc() {
    const newRow = document.createElement('div');
    newRow.className = "row";

    const typeSelect = document.createElement('select');
    typeSelect.className = "typeSelect";
    data.types.forEach(type => {
        const option = document.createElement('option');
        option.value = type.type;
        option.textContent = type.type.charAt(0).toUpperCase() + type.type.slice(1);
        typeSelect.appendChild(option);
    });

    const valueSelect = document.createElement('select');
    valueSelect.className = "valueSelect";

    const inputFild = document.createElement('input');
    inputFild.type = "text";

    newRow.appendChild(typeSelect);
    newRow.appendChild(valueSelect);
    newRow.appendChild(inputFild);

    document.getElementById('metaTagForm').appendChild(newRow);

    typeSelect.addEventListener('change', function() {
        populateValues(this);
    });

    populateValues(typeSelect);
}
