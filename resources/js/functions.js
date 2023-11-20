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

export function showMetaTagSwalModal({target}) {
    const page_id = $(target).data('page');
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
        template: `#modal-template-${page_id}`,
        width: '90%',
        didOpen: async function (popup) {
            Swal.showLoading();
            updatedMarkup = await getMetaListMarkUp(page_id);
            const metaTagsContainer = $(popup).find('#meta-tags-container');
            const form = $(popup).find('form');
            $(metaTagsContainer).html(updatedMarkup.markup);
            metaTagsContainer.css('display', 'block');
            Swal.hideLoading();
            $('.add-meta-tags-row').off('click').on('click', function (event) {
                addMetaTagRow({event, page_id});
            });

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
    clearFormContainer()
    $('#spinner').show();
    $.ajax({
        url: `/get-component-form/${$(target).data('page')}`,
        type: 'GET',
        success: function (response) {
            $('#spinner').hide();
            $('#formContainer').html(response.markup);
        },
        error: function (response) {
            $('#spinner').hide();
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

async function getDetailRowTemplate() {
    const result = document.createElement('div');
    await $.ajax({
        url: `/api/get-detail-row-template`,
        type: 'GET',
        success: function (response) {
            if (response.success) {
                return $(result).html(response.markup);
            }
        },
        error: function (response) {
            if (response.error) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
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
    return result.firstElementChild;
}

export async function addDetailFields() {
    const container = document.getElementById('component-details');
    let detailIndex = container.children.length;
    const template = container.firstElementChild?.cloneNode(true)
    const newDetail = await replaceNameDataInNewDetailElement({
        newDetail: template || await getDetailRowTemplate(),
        detailIndex: detailIndex
    });
    addListenerToDetail({
        detailElement: newDetail,
        detailIndex: detailIndex
    });

    // newDetail.classList.add('col-md-12');
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
        url: '/admin/components',
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
    clearFormContainer();
    const component_id = $(target.closest('tr')).data('componentid')
    const formContainer = $('#formContainer');

    if (component_id) {
        $('#spinner').show();
        $.ajax({
            url: `/admin/components/${component_id}/edit`,
            type: 'GET',
            success: function (response) {
                $('#spinner').hide();
                $(formContainer).html(response.markup);

                const disconnect_btn = $('#disconnect_btn');
                const albumId = $(disconnect_btn).data('album_id');

                $(formContainer).off('click', '#canselAddComponentButton').on('click', '#canselAddComponentButton', clearFormContainer);

                const componentDetails = $(formContainer).find('#component-details');

                const deleteButtons = $(componentDetails).find('button')

                $(deleteButtons).off('click').on('click', deleteExistComponentDetail)

                $(formContainer).off('click', '#addComponentDetail').on('click', '#addComponentDetail', addDetailFields);

                $(formContainer).off('submit', '#updateComponentForm').on('submit', '#updateComponentForm', function (e) {
                    e.preventDefault();
                    submitUpdateComponentForm(component_id);
                });

                $(disconnect_btn).off('click').on('click', function () {
                    disconnectAlbum({component_id, albumId});

                });
                // add listeners to each image
                $('.unpin-btn').off('click').on('click', async function ({target}) {

                    await unpinImageFromAlbum({target, albumId});
                });

            },
            error: function () {
                $('#spinner').hide();
            }
        });
    }


}

export async function unpinImageFromAlbum({target, albumId}) {
    const image = target.closest('button').offsetParent;
    const image_id = $(target.closest('button')).data('image_id');
    await sendUnpinRequest({
        imageId: image_id,
        albumId:albumId,
        target:image
    })
}

export async function sendUnpinRequest({albumId, imageId, target}) {
    $.ajax({
        url: `/api/un-pin/`,
        type: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': `${getCsrfToken()}`,
        },
        data: {
            album_id: albumId,
            image_id: imageId,
        },
        success: function (response) {
            target.remove()
            if (response.success) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true,
                    background: 'rgba(0,0,0,.8)',
                    padding: '0.5rem',
                    width: 400,
                })
            }
        },
        error: function (response) {
            console.log(response)
        }
    });
}

export function disconnectAlbum({component_id, albumId}) {
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
            // console.log($(`#connected-album-name-${albumId}`))
            $(`#connected-album-name-${albumId}`)[0].textContent = ' - ';
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

export function addMetaTagRow({event: {target}, page_id}) {
    $.ajax({
        url: `/api/meta-tags-add-${target.dataset.action}`,
        type: 'POST',
        data: {
            type_id: target.dataset.type_id,
            type: target.dataset.action,
            page_id: page_id
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

