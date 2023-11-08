import {getCsrfToken} from "../js/helpers/getCsrfToken.js";
import Swal from "sweetalert2";

export let updatedMarkup = null;

export function deleteExistComponentDetail({target}) {
    const id = $(target.closest('button')).data('detail_id');
    console.log(id)
    $.ajax({
        url: `/api/component-detail/${id}`,
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': `${getCsrfToken()}`
        },
        success: function (response) {
            if (response.success) {

                const componentDetail = document.getElementById(`component-detail-${id}`)
                componentDetail.remove();
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: 'rgba(0,0,0,0.5)',
                    padding: '0.5rem',
                    width: 400,
                    height: 200
                })
            }
        },
        error: function (response) {
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Error',
                text: response.message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                background: 'rgba(0,0,0,0.5)',
                padding: '0.5rem',
                width: 400,
                height: 200
            })
        }
    })
}

export function showMetaTagSwalModal() {
    Swal.fire({
        showCloseButton: false,
        showCancelButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        focusConfirm: false,
        preConfirm: () => {
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
        didOpen: async function (popup) {
            Swal.showLoading();
            updatedMarkup = await getMetaListMarkUp($('#showMetaTagsForm').data('page'));
            const metaTagsContainer = $(popup).find('#meta-tags-container');
            const form = $(popup).find('form');
            $(metaTagsContainer).html(updatedMarkup.markup);
            metaTagsContainer.css('display', 'block');
            Swal.hideLoading();
            $('.add-meta-tags-row').off('click').on('click', addMetaTagRow)

            $(document).off('click').on('click', '.delete-meta-tag', function (event) {
                deleteMetaTag(event, function (htmlContent) {
                    if (htmlContent) {
                        updatedMarkup = htmlContent;
                        Swal.showValidationMessage('Meta teg delete successfully!');
                        setTimeout(() => {
                            Swal.resetValidationMessage();
                        }, 2000)
                    }
                });

            });
            $(form).off('change input').on('change input', ':input', function ({target}) {
                $(target).removeClass('is-invalid');
                $(target).addClass('is-valid');

                const validation = formValidation(form)
                if (validation) {
                    Swal.resetValidationMessage();
                }
            });
        },
        willClose: function (popup) {
            $('#add-meta-tag').off('click')
            const metaTagsContainer = $(popup).find('#meta-tags-container');
            afterModalCloseCheck(metaTagsContainer);

        }
    })
        .then(result => {
            const popup = Swal.getPopup();
            const form = popup.querySelector('form');

            const serializedData = $(form).serialize();
            if (!result.isConfirmed || result.isConfirmed) {
                const metaTagsContainer = $(popup).find('#meta-tags-container');
                updatedMarkup = metaTagsContainer.html();
            }
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/meta-tags-group',
                    type: 'POST',
                    data: serializedData,
                    headers: {
                        'X-CSRF-TOKEN': `${getCsrfToken()}`
                    },
                    success: function (response) {
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
                                height: 200
                            });
                        }
                        const metaTagsContainer = $('#meta-tags-container');
                        updatedMarkup = $(metaTagsContainer).html();
                    },
                    error: function ({responseJSON}) {
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
                                height: 200
                            });
                        }
                    }
                });
            }

        });
}

export function isFormValid(form) {
    let allFilled = true;
    $(form).find(':input').each(function () {
        if ($(this).val() === "" && $(this).attr('type') !== 'hidden') {
            allFilled = false;
            return false;
        }
    });
    return allFilled;
}

export function formValidation(form) {
    let isValid = true;

    $(form).find(':input').each(function () {
        if ((this.type === "text" || this.type === "textarea" || this.type === "password" || this.type === "email") && !this.value.trim()) {
            isValid = false;
            $(this).addClass('is-invalid');
        }

        if (this.tagName === "SELECT" && !this.value) {
            isValid = false;
            $(this).addClass('is-invalid');
        }
    });

    return isValid;
}

export function getMetaListMarkUp(page_id) {
    return $.ajax({
        url: '/api/get-meta-list-markup',
        type: 'POST',
        data: {page_id},
        success: function (response) {
            // console.log(response)
        },
        error: function (xhr, status, error) {
            console.log(error)
        }
    });
}

export function loadAddComponentInterface({target}) {
    $.ajax({
        url: `/get-component-form/${$(target).data('page')}`,
        type: 'GET',
        success: function (response) {
            $('#formContainer').html(response.markup);
        },
        error: function (response) {
            console.log(response)
        }
    });
}

export function clearFormContainer() {
    $('#addComponentForm').off('submit', submitForm);
    $('#formContainer').off('click').html('');
}

function fieldsCounter() {
    let detailCount = 0
    return () => {
        return detailCount += 1;
    }
}

const counter = fieldsCounter();

export function addDetailFields() {
    const container = document.getElementById('component-details');
    let detailIndex = container.children.length;
    const newDetail = replaceNameDataInNewDetailElement({
        newDetail: container.firstElementChild.cloneNode(true),
        detailIndex: detailIndex
    });

    addListenerToDetail({
        detailElement: newDetail,
        detailIndex: detailIndex
    });
    container.appendChild(newDetail);
    detailIndex++;
}

export function deleteComponentDetail(id) {
    const detailElement = document.getElementById('component-detail-' + id);
    if (detailElement) {
        detailElement.remove();
    }
}

export function submitComponentForm() {
    let formData = $('#addComponentForm').serialize();

    $.ajax({
        url: '/components',
        type: 'POST',
        data: formData,
        success: function (response) {
            $('#component_list_table_body').append(response.markup);
            clearFormContainer();
            addListenerToLastChildOfTbody()
            new Swal(response.message);
        },
        error: function (xhr, status, error) {
            console.error('An error occurred:', error);
            const errorMessage = xhr.status + ': ' + xhr.statusText;
            alert('Error - ' + errorMessage);
        }
    });
}

export function initialListenersTbody() {
    $('#component_list_table_body').off('click').on('click', '.componentRow', getEditComponentForm);
}

export function addListenerToLastChildOfTbody() {
    $('#component_list_table_body tr:last-child').on('click', getEditComponentForm);
}

export function getEditComponentForm({target}) {
    const id = $(target.closest('tr')).data('componentid')
    const formContainer = $('#formContainer');

    if (id) {
        $.ajax({
            url: `/components/${id}/edit`,
            type: 'GET',
            success: function (response) {
                $(formContainer).html(response.markup);

                $(formContainer).off('click', '#canselAddComponentButton').on('click', '#canselAddComponentButton', clearFormContainer);
                const componentDetails = $(formContainer).find('#component-details');
                const deleteButtons = $(componentDetails).find('button')
                $(deleteButtons).off('click').on('click', deleteExistComponentDetail)
                $(formContainer).off('click', '#addComponentDetail').on('click', '#addComponentDetail', addDetailFields);

                $(formContainer).off('submit', '#updateComponentForm').on('submit', '#updateComponentForm', function (e) {
                    e.preventDefault();
                    submitUpdateComponentForm(id);
                });


                $('#disconnect_btn').off('click').on('click', function () {
                    disconnectAlbum(id);
                });
            },
        });
    }

}

export function disconnectAlbum(component_id) {
    $.ajax({
        url: `/api/component-album-disconnect/${component_id}`,
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': `${getCsrfToken()}`,
        },
        success: function (response) {
            new Swal(response.message);
            $('#imageContainer').html('')
            $('#connectedAlbumContainer').remove();
            $('#albumsSelect').css('display', 'block');
        },
    })
}

export function submitUpdateComponentForm(id) {
    let formData = $('#updateComponentForm').serialize();

    $.ajax({
        url: `/components/${id}/update`,
        type: 'POST',
        data: formData,
        success: function (response) {
            $(`[data-componentid="${response.component.id}"`).replaceWith(response.markup)
            clearFormContainer();
            new Swal(response.message);
        },
        error: function (xhr, status, error) {
            const errorMessage = xhr.status + ': ' + xhr.statusText;
            new Swal('Error - ' + errorMessage);
        }
    });
}

export function addListenerToDetail({detailElement, detailIndex}) {
    detailElement.querySelector('button').addEventListener('click', function () {
        deleteComponentDetail(detailIndex);
    });
}

export function replaceNameDataInNewDetailElement({newDetail, detailIndex}) {
    newDetail.id = 'component-detail-' + detailIndex;
    newDetail.querySelectorAll('label, input').forEach(function (el) {
        if (el.tagName === 'INPUT') {
            el.value = '';
            el.id = el.id.replace(/\[\d+\]/, '[' + detailIndex + ']');
            el.name = el.name.replace(/\[\d+\]/, '[' + detailIndex + ']');
        } else if (el.tagName === 'LABEL') {
            el.setAttribute('for', el.getAttribute('for').replace(/\[\d+\]/, '[' + detailIndex + ']'));
        }
    });
    return newDetail;
}


export function submitForm(e) {
    e.preventDefault();
    submitComponentForm();
}

export function deleteMetaTag({target}, callback) {
    const metaTagId = $(target).data('meta_tag_id');
    return $.ajax({
        url: `/api/meta-tags/${metaTagId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': `${getCsrfToken()}`,
        },
        success: function (response) {
            target.closest('.meta-tag-item').remove();
            const metaTagsContainer = $('#meta-tags-container');
            if (response.success) {

            }
            if (typeof callback === 'function') {
                callback(metaTagsContainer.html());
            }
        },
        error: function (xhr, status, error) {
            if (error) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error',
                    text: error,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true,
                    background: 'rgba(0,0,0,0)',
                    padding: '0.5rem',
                    width: 400,
                    height: 200
                });
            }
            if (typeof callback === 'function') {
                callback(null);
            }
        }
    });
}

export function addMetaTagRow({target}) {
    $.ajax({
        url: `/api/meta-tags-add-${target.dataset.action}`,
        type: 'POST',
        data: {
            type_id: target.dataset.type_id,
            type: target.dataset.action,
            page_id: $('#currentPageId')[0].value
        },
        success: function (response) {
            $('#meta-tags-container').append(response.markup);

        },
        error: function (xhr, status, error) {
            console.error('An error occurred:', error);

        }
    });

}

export function afterModalCloseCheck(form) {
    // console.log(form)
}

{
    // <div class="form-group col-md-3">
    //     <label for="details[${detailIndex}][key]">Key:</label>
    //     <input
    //         class="form-control"
    //         type="text"
    //         id="details[${detailIndex}][key]"
    //         name="details[${detailIndex}][key]"
    //         required
    //     >
    // </div>
    // <div class="form-group col-md-8">
    //     <label for="details[${detailIndex}][value]">Value:</label>
    //     <input
    //         type="text"
    //         class="form-control"
    //         id="details[${detailIndex}][value]"
    //         name="details[${detailIndex}][value]"
    //         required>
    // </div>
    // <div class= "form-group col-md-1">
    //     <label for="delete[${detailIndex}]" >Delete:</label>
    //     <button
    //         id="delete[${detailIndex}]"
    //         onclick="event.preventDefault()"
    //         href="javascript:void(0);"
    //         class="btn btn-outline-danger w-100"
    //     >
    //         <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
    //             <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
    //         </svg>
    //     </button>
    // </div>
}
