import axios from "axios";

function selectAllImages() {
    const allImages = document.querySelectorAll('.image-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    allImages.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
}

function deleteSelectedImages() {
    const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
    if (selectedImages.length) {
        // axios.delete()
    }
}

function addToAlbum() {
    const selectedImages = [...document.querySelectorAll('.image-checkbox:checked')].map(checkbox => checkbox.dataset.imageId);
    if (selectedImages.length) {
        // Make an AJAX request to add the selected images to an album.
        // This might require another interface for the user to select which album to add the images to.
    }
}

let albumId = null;

function createNewAlbum() {
    [...document.querySelectorAll('.dz-preview')].forEach(item => item.remove())
    const newAlbumFields = document.getElementById('newAlbumFields');
    newAlbumFields.style.display = 'block';
    fetch('/create-album', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
        });
}

Dropzone.autoDiscover = false;

new Dropzone("#my-dropzone", {
    url: "/upload",
    maxFiles: 10,
    sending: function (file, xhr, formData) {
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("album_id", albumId);
    },
    success: function (file, response) {
        if (response.success && response.image) {
            const albumBlock = document.getElementById('images');  // Or use a more specific selector if needed
            const newImageBlock = document.createElement('div');
            newImageBlock.classList.add('col-lg-2', 'col-md-4', 'col-sm-6', 'mb-4');

            const cardDiv = document.createElement('div');
            cardDiv.classList.add('card');

            const imageResponse = JSON.parse(response.image)
            const imgTag = document.createElement('img');
            imgTag.src = imageResponse.file_url;
            imgTag.alt = imageResponse.alt_text;
            imgTag.title = imageResponse.title;
            imgTag.classList.add('card-img-top');

            cardDiv.appendChild(imgTag);
            newImageBlock.appendChild(cardDiv);
            albumBlock.appendChild(newImageBlock);
        }
    }
});

