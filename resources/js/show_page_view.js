import {
    loadAddComponentInterface,
    submitComponentForm,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody,
    submitForm,
    editMetaTagsForm

} from './functions.js'
import Swal from "sweetalert2";

window.Swal = Swal;


document.addEventListener('DOMContentLoaded', () => {

    const addComponent = document.getElementById('showAddComponentForm');

    $('#showMetaTagsForm').on('click', function () {
        let test = Swal.fire({
            template: '#my-template',
            imageWidth: 1800,
            imageHeight: 600,
            didOpen: function(popup) {
                // editMetaTagsForm(popup)
            },
            willClose:function (popup) {
                // console.log(popup)
                const form = popup.querySelector('form');
                const serializedData = $(form).serialize();
                $.ajax({
                    url: '/api/meta-tags-group',
                    type: 'POST',
                    data: serializedData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                    },
                    error: function(error) {
                        // Handle error
                    }
                });
            }
        }).then(data => {
            console.log(data)

        })

    })


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

