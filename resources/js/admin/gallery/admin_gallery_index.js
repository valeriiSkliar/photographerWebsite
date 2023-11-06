import {getCsrfToken} from "../../helpers/getCsrfToken.js";

let albumId = null;
const upload_label = document.getElementById('upload-label');

document.getElementById('selectAll')
    .addEventListener('change', selectAllImages);
document.getElementById('btnDeleteSelectedImages')
    .addEventListener('click', deleteSelectedImages);
document.getElementById('btnAddToAlbum')
    .addEventListener('click', addToAlbum);
document.getElementById('createNewAlbum')
    .addEventListener('click', createNewAlbum);

document.getElementById('zdrop').addEventListener('dragenter', () => {
    upload_label.style.color = '#e7615c';
});
document.getElementById('zdrop').addEventListener('dragleave', () => {
    upload_label.style = null;
});
function selectAllImages() {
    const allImages = document.querySelectorAll('.image-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    allImages.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
}

function deleteSelectedImages() {
    const selectedImageCheckboxes = [...document.querySelectorAll('.image-checkbox:checked')];

    const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
    if (selectedImages.length) {
        fetch('/delete-selected-images', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({images: selectedImages})
        })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: '#151515',
                        padding: '0.5rem',
                    });

                    selectedImageCheckboxes.forEach(checkbox => {
                        const parentCard = checkbox.closest('.image_from_all_heaps');
                        if (parentCard) {
                            parentCard.remove();
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete selected images',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: '#151515',
                        padding: '0.5rem',
                    });
                }
            });
    }
}

function addToAlbum() {
    const albumSelect = document.getElementById('albumSelect');
    const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
    if (selectedImages.length) {
        fetch('/add-selected-images', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                images: selectedImages,
                album_id: albumSelect.value
            })
        })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: '#151515',
                        padding: '0.5rem',
                    });

                } else {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed add images to album',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        background: '#151515',
                        padding: '0.5rem',
                    });
                }
            })
    }
}

function createNewAlbum(e) {
    e.preventDefault();
    [...document.querySelectorAll('.dz-preview')].forEach(item => item.remove())
    const newAlbumFields = document.getElementById('newAlbumFields');
    newAlbumFields.style.display = 'block';
    // Send AJAX request to create new album (assuming route is /create-album)
    fetch('/create-album', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.album_id)
            if (data.success && data.album_id) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'album_id';
                hiddenInput.value = data.album_id;
                albumId = data.album_id;

                document.querySelector('form').appendChild(hiddenInput);

                document.getElementById('newAlbumFields').style.display = 'block';
            }
            if (data.success) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: 'rgba(0,0,0,1)',
                    padding: '0.5rem',
                });

            } else {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error',
                    text: data.message ?? 'Failed to create album',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    background: '#151515',
                    padding: '0.5rem',
                });
            }
        });
}

Dropzone.autoDiscover = false;

new Dropzone("#zdrop", {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    url: "/upload",
    maxFiles: 10,
    sending: function (file, xhr, formData) {
        formData.append("_token", getCsrfToken());
        formData.append("album_id", albumId);
    },
    success: function (file, response) {
            Swal.fire(sweetAlertConfigs.success(response.message));

        if (response.image) {
            const albumBlock = document.getElementById('images');

            const imageResponse = JSON.parse(response.image);
            const containerDiv = document.createElement('div');
            containerDiv.classList.add('col-sm-6', 'col-md-4', 'mb-3', 'image_from_all_heaps');

            const checkboxDiv = document.createElement('div');
            checkboxDiv.classList.add('checkbox', 'icheck-success');
            checkboxDiv.style.position = 'absolute';
            checkboxDiv.style.top = '5px';
            checkboxDiv.style.left = '18px';

            const checkboxInput = document.createElement('input');
            checkboxInput.type = 'checkbox';
            checkboxInput.classList.add('image-checkbox');
            checkboxInput.dataset.imageId = imageResponse.id;
            checkboxInput.id = `imgSelector${imageResponse.id}`;
            checkboxInput.name = `success${imageResponse.id}`;

            const checkboxLabel = document.createElement('label');
            checkboxLabel.htmlFor = `imgSelector${imageResponse.id}`;

            checkboxDiv.appendChild(checkboxInput);
            checkboxDiv.appendChild(checkboxLabel);

            const anchorElement = document.createElement('a');
            anchorElement.href = imageResponse.file_url;
            anchorElement.setAttribute('data-lightbox', 'all-images');
            anchorElement.setAttribute('data-title', 'Best title ever');

            const imgElement = document.createElement('img');
            imgElement.src = imageResponse.file_url;
            imgElement.classList.add('fluid', 'img-thumbnail');
            imgElement.alt = imageResponse.alt_text;
            imgElement.title = imageResponse.title;

            anchorElement.appendChild(imgElement);

            const controlsDiv = document.createElement('div');
            controlsDiv.classList.add('btn-group', 'image-controls');

            const controlsButton = document.createElement('button');
            controlsButton.type = 'button';
            controlsButton.classList.add('btn', 'btn-sm', 'btn-outline-warning', 'p-0');
            controlsButton.setAttribute('data-toggle', 'dropdown');
            controlsButton.setAttribute('data-offset', '-1, 0');
            controlsButton.setAttribute('aria-haspopup', 'true');
            controlsButton.setAttribute('aria-expanded', 'false');

            const controlsIcon = document.createElement('i');
            controlsIcon.classList.add('fas', 'fa-ellipsis-h');

            controlsButton.appendChild(controlsIcon);

            const dropdownMenu = document.createElement('div');
            dropdownMenu.classList.add('dropdown-menu', 'dropdown-menu-right', 'm-0', 'p-0', 'mt-2');
            dropdownMenu.style.minWidth = 'auto';
            dropdownMenu.style.backgroundColor = 'unset';
            dropdownMenu.style.border = 'unset';
            dropdownMenu.style.boxShadow = 'unset';

            const editLink = document.createElement('a');
            editLink.href = `/admin/images/${imageResponse.id}/edit`;
            editLink.classList.add('dropdown-item', 'text-center', 'm-0', 'p-0');
            editLink.style.backgroundColor = 'unset';
            editLink.style.border = 'unset';

            const editIcon = document.createElement('i');
            editIcon.classList.add('fas', 'fa-edit');

            editLink.appendChild(editIcon);

            const deleteForm = document.createElement('form');
            deleteForm.action = `/admin/images/${imageResponse.id}`;
            deleteForm.method = 'POST';
            deleteForm.classList.add('dropdown-item', 'text-center', 'm-0', 'p-0', 'mt-2');

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = getCsrfToken(); // Replace with the actual CSRF token

            const deleteMethodInput = document.createElement('input');
            deleteMethodInput.type = "hidden";
            deleteMethodInput.name = "_method";
            deleteMethodInput.value = "DELETE";

            const deleteButton = document.createElement('button');
            deleteButton.type = 'submit';
            deleteButton.classList.add('btn-delete', 'text-center', 'p-0');

            const deleteIcon = document.createElement('i');
            deleteIcon.classList.add('fas', 'fa-trash-alt');

            deleteButton.appendChild(deleteIcon);

            deleteForm.appendChild(csrfToken);
            deleteForm.appendChild(deleteMethodInput);
            deleteForm.appendChild(deleteButton);

            dropdownMenu.appendChild(editLink);
            dropdownMenu.appendChild(deleteForm);

            controlsDiv.appendChild(controlsButton);
            controlsDiv.appendChild(dropdownMenu);

            containerDiv.appendChild(checkboxDiv);
            containerDiv.appendChild(anchorElement);
            containerDiv.appendChild(controlsDiv);

            albumBlock.appendChild(containerDiv);
        }
    },
    error: function (file, response) {
        Swal.fire(sweetAlertConfigs.error(response.message));
    }
});
