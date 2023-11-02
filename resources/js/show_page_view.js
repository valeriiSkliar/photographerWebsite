import {
    loadAddComponentInterface,
    submitComponentForm,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody,
    submitForm

} from './functions.js'
import Swal from "sweetalert2";

window.Swal = Swal;



document.addEventListener('DOMContentLoaded', () => {
    const addComponent = document.getElementById('showAddComponentForm');

    $('#showAddComponentForm').on('click', function () {
        $.ajax({
            url: `/get-component-form/${$(this).data('page')}`,
            type: 'GET',
            success: function (response) {
                $('#formContainer').html(response.markup);
            },
        });
        $('#formContainer').off('submit', '#addComponentForm').on('submit', '#addComponentForm', submitForm);
        $('#formContainer').off('click', '#addComponentDetail').on('click', '#addComponentDetail', addDetailFields);
        $('#formContainer').off('click', '#canselAddComponentButton').on('click', '#canselAddComponentButton', clearFormContainer);

    });

    initialListenersTbody();
    // addComponent.addEventListener('click' , loadAddComponentInterface)
});
