import {
    loadAddComponentInterface,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody,
    submitForm,
    showMetaTagSwalModal,
    addToCurrentPage,
    removeFromCurrentPage

} from './functions.js'

import './admin/page/components_sortable_list.js'


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

    $('.removeComponentAction').on('click', removeFromCurrentPage )
    $('.addComponentAction').on('click', addToCurrentPage )

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});

