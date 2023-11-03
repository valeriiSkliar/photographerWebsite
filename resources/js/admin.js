// import axios from "axios";
import './bootstrap.js'

let metaTagFormId = 0;
let fetchedData = null;
let metaValues = null;
const addNewRow = document.getElementById('addNewRow');
const typeSelect = document.getElementById('typeSelect');
const valueSelect = document.getElementById('valueSelect');
const metaTagFormTemplate = document.getElementById('metaTagFormTemplate');
const metaTagForm = document.getElementById('metaTagForm');
const add_meta_tegs_btn = document.getElementById('add_meta_tags_btn');

function renderMetaTagFormTemplate() {
    metaTagFormId += 1;
    const clone = document.importNode(metaTagFormTemplate.content, true);
    const typeSelect = clone.getElementById('typeSelect')
    const valueSelect = clone.getElementById('valueSelect')
    const content = clone.getElementById('content')
    typeSelect.name = `metaData[${metaTagFormId}][type_id]`
    valueSelect.name = `metaData[${metaTagFormId}][value]`
    content.name = `metaData[${metaTagFormId}][content]`
    typeSelect.addEventListener('change', typeSelectChangeDetectFunction)

    metaTagForm.appendChild(clone);
}

if (addNewRow){
    addNewRow.addEventListener('click', (e) => {
        e.preventDefault();
        renderMetaTagFormTemplate();
    })
}

function displayValueSelectOptions(selectElement, fetchedValues = []) {
    selectElement.innerHTML = '';
    const selectValue = new Option('Select value', '', false, false);
    selectElement.appendChild(selectValue);
    fetchedValues.forEach((item) => {
        const metaValue = new Option(item.name || item.property, item.name || item.property, false, false);
        // metaValue.dataset.id = item.id;
        selectElement.appendChild(metaValue);
    })
    selectElement.nextElementSibling.disabled = false;
}

async function typeSelectChangeDetectFunction({target}) {
    if (!fetchedData) {
        fetchedData = await loadMetaValueData();
    }
    const selectedOption = target.options[target.selectedIndex]
    displayValueSelectOptions(target.nextElementSibling, fetchedData[selectedOption.dataset.type]);
}

document.addEventListener('DOMContentLoaded', () => {
    if (typeSelect){
        typeSelect.addEventListener('change', typeSelectChangeDetectFunction);
    }
})

function loadMetaValueData() {
    return axios.get('/api/meta-tags')
        .then(({data}) => {
            return data;
        })
}

