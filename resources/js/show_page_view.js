import {
    loadAddComponentInterface,
    submitComponentForm,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody,
    submitForm,
    addMetaTagRow,
    deleteMetaTag,
    afterModalCloseCheck,
    getMetaListMarkUp,
    formValidation,
    isFormValid,
    updatedMarkup,
    showMetaTagSwalModal

} from './functions.js'



document.addEventListener('DOMContentLoaded', () => {
const formContainer = $('#formContainer');
    const addComponent = document.getElementById('showAddComponentForm');

    $('#showMetaTagsForm').on('click', showMetaTagSwalModal)

    $('#showAddComponentForm').on('click', function (event) {
        loadAddComponentInterface(event);
        formContainer.off('submit', '#addComponentForm').on('submit', '#addComponentForm', submitForm);
        formContainer.off('click', '#addComponentDetail').on('click', '#addComponentDetail', addDetailFields);
        formContainer.off('click', '#canselAddComponentButton').on('click', '#canselAddComponentButton', clearFormContainer);
    });

    initialListenersTbody();
});

