import {
    loadAddComponentInterface,
    submitComponentForm,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody

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
        $('#formContainer').on('submit', '#addComponentForm', function (e) {
            e.preventDefault();
            submitComponentForm();
        });
        $('#formContainer').on('click', '#addComponentDetail', function () {
            addDetailFields();
        });
        $('#formContainer').on('click', '#canselAddComponentButton', function () {
            clearFormContainer();
        });

    });

    initialListenersTbody();
    // addComponent.addEventListener('click' , loadAddComponentInterface)
});
