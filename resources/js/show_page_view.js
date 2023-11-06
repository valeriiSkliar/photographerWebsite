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

} from './functions.js'
import Swal from "sweetalert2";


let updatedMarkup = null;

document.addEventListener('DOMContentLoaded', () => {

    const addComponent = document.getElementById('showAddComponentForm');

    $('#showMetaTagsForm').on('click', function () {
        Swal.fire({
            showCloseButton: false,
            showCancelButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            focusConfirm: false,
            preConfirm:() => {
                const htmlContainer = Swal.getHtmlContainer();
                const form = $(htmlContainer).find('form');
                const validation = formValidation(form);
                if (!validation) {
                    Swal.showValidationMessage('All fields is required!');
                    return false;
                }
            },
            template: '#my-template',
            width: '90%',
            didOpen: async function(popup) {
                Swal.showLoading();
                updatedMarkup = await getMetaListMarkUp($('#showMetaTagsForm').data('page'));
                const metaTagsContainer = $(popup).find('#meta-tags-container');
                const form = $(popup).find('form');
                $(metaTagsContainer).html(updatedMarkup.markup);
                metaTagsContainer.css('display', 'block');
                Swal.hideLoading();
                $('.add-meta-tags-row').off('click').on('click', addMetaTagRow)

                $(document).off('click').on('click', '.delete-meta-tag', function (event){
                    deleteMetaTag( event, function (htmlContent) {
                        if (htmlContent) {
                            updatedMarkup = htmlContent;
                            Swal.showValidationMessage('Meta teg delete successfully!');
                            setTimeout(() => {
                                Swal.resetValidationMessage();
                            }, 2000)
                        }
                    });

                });
                $(form).off('change input').on('change input', ':input', function({target} ) {
                    console.log(target)
                    $(target).removeClass('is-invalid');
                    $(target).addClass('is-valid');

                    const validation = formValidation(form)
                    if (validation) {
                        Swal.resetValidationMessage();
                    }
                    // console.dir(form[0].elements)
                    // console.dir(form[0].form)
                    // if (isFormValid(form)) {
                    //     $('#submitBtn').prop('disabled', false);
                    // } else {
                    //     $('#submitBtn').prop('disabled', true);
                    // }
                });
            },
            willClose:function (popup) {
                $('#add-meta-tag').off('click')
                const metaTagsContainer = $(popup).find('#meta-tags-container');
                afterModalCloseCheck(metaTagsContainer);

            }
        }).then(result => {
            const popup = Swal.getPopup();
            const form = popup.querySelector('form');

            const serializedData = $(form).serialize();
            if (!result.isConfirmed || result.isConfirmed) {
                console.log('cansel')
                const metaTagsContainer = $(popup).find('#meta-tags-container');
                updatedMarkup = metaTagsContainer.html();
            }
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
                        const metaTagsContainer = $('#meta-tags-container');
                        updatedMarkup = $(metaTagsContainer).html();
                    },
                    error: function({responseJSON}) {
                        const metaTagsContainer = $(popup).find('#meta-tags-container');
                        updatedMarkup = metaTagsContainer.html();
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
});

