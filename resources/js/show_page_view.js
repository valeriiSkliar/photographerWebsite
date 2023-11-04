import {
    loadAddComponentInterface,
    submitComponentForm,
    addDetailFields,
    clearFormContainer,
    initialListenersTbody,
    submitForm,
    addMetaTagRow,

} from './functions.js'
import Swal from "sweetalert2";
window.Swal = Swal;


document.addEventListener('DOMContentLoaded', () => {

    let updatedMarkup = null;

    $('#add-meta-tag').on('click', addMetaTagRow);

    const addComponent = document.getElementById('showAddComponentForm');

    $('#showMetaTagsForm').on('click', function () {
        Swal.fire({
            template: '#my-template',
            width: '90%',
            height: 'fit-content',
            didOpen: function(popup) {
                $('#meta-tags-add-property').off('click').on('click', addMetaTagRow);
                $('#meta-tags-add-name').off('click').on('click', addMetaTagRow);

                if (updatedMarkup) {
                    const metaTagsContainer = $(popup).find('#meta-tags-container');
                    $(metaTagsContainer).html(updatedMarkup);
                    // console.log($(popup).find('#meta-tags-add-property'))
                }
                // editMetaTagsForm(popup)
                // $('#add-meta-tag').off('click').on('click', addMetaTagRow);

            },
            willClose:function (popup) {
                $('#add-meta-tag').off('click')

            }
        }).then(result => {
            const popup = Swal.getPopup();
            const form = popup.querySelector('form');
            const serializedData = $(form).serialize();
            // console.log(serializedData)
            if (result.isConfirmed) {

                $.ajax({
                    url: '/api/meta-tags-group',
                    type: 'POST',
                    data: serializedData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        updatedMarkup = response.markup;
                        if (response.success) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                                width: 400,
                                height:200
                            });
                        }
                    },
                    error: function({responseJSON}) {
                        console.log(responseJSON)

                        if (responseJSON.error) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'error',
                                title: 'Error',
                                text: responseJSON.message,
                                showConfirmButton: false,
                                timer: 5000,
                                toast: true,
                                background: 'rgba(0,0,0,0)',
                                padding: '0.5rem',
                                width: 400,
                                height:200
                            });
                        }
                    }
                });
            }

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

