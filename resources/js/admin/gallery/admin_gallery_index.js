import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import Swal from "sweetalert2";
import { confirmDelete, addToAlbum, deleteSelectedImages, selectAllImages } from "@/admin/gallery/function.js";

const upload_label = document.getElementById('upload-label');
let albumId = null;


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
                Swal.fire(sweetAlertConfigs.success(data.message));

            } else {
                Swal.fire(sweetAlertConfigs.error(data.message ?? 'Failed to create album'));
            }
        });
}

document.getElementById('selectAll')
    .addEventListener('change', selectAllImages);

document.getElementById('btnDeleteSelectedImages')
    .addEventListener('click', deleteSelectedImages);

document.getElementById('btnAddToAlbum')
    .addEventListener('click', function addImagesToAlbum () {
        const albumSelect = document.getElementById('albumSelect');
        addToAlbum(albumSelect.value);
    });

document.getElementById('createNewAlbum')
    .addEventListener('click', createNewAlbum);

const albums =  document.querySelectorAll('.album-delete');

if (albums.length) {
 albums.forEach((album) => {
     album.addEventListener('click', async function ( e) {
         e.preventDefault();
         const willAlbumDelete = await confirmDelete();
         if (willAlbumDelete) {
             const form = this.closest('.album-controls form');
             form.submit();
         }
     });
 });
}

document.getElementById('zdrop').addEventListener('dragenter', () => {
    upload_label.style.color = '#e7615c';
});
document.getElementById('zdrop').addEventListener('dragleave', () => {
    upload_label.style = null;
});

Dropzone.autoDiscover = false;

new Dropzone("#zdrop", {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    url: "/upload",
    maxFiles: 10,
    acceptedFiles: 'image/*',
    maxFilesize: 10,
    sending: function (file, xhr, formData) {
        // formData.append("_token", getCsrfToken());
        formData.append("album_id", albumId);
    },
    success: function (file, response) {
        console.log(response)
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
        console.log("Error: ", response);
        Swal.fire(sweetAlertConfigs.error(response.message));
    }
});
