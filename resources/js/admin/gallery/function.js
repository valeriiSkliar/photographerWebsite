import Swal from "sweetalert2";
import {getCsrfToken} from "@/helpers/getCsrfToken.js";

export async function confirmDelete() {
    const result = await Swal.fire(sweetAlertConfigs.modalConfirm());
    return result.isConfirmed;
}

export function selectAllImages() {
    const allImages = document.querySelectorAll('.image-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    allImages.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
}

export function deleteSelectedImages() {
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
                    Swal.fire(sweetAlertConfigs.success(response.message));

                    selectedImageCheckboxes.forEach(checkbox => {
                        const parentCard = checkbox.closest('.image_from_all_heaps');
                        if (parentCard) {
                            parentCard.remove();
                        }
                    });
                } else {
                    Swal.fire(sweetAlertConfigs.error('Failed to delete selected images'));
                }
            });
    }
}

export async function addToAlbum(albumId, images = '.image-checkbox:checked') {
    if (!albumId) {
        Swal.fire(sweetAlertConfigs.warning("Can't find this album"));
        return null;
    }
    const selectedImages = [...document.querySelectorAll(images)].map(checkbox => {
        checkbox.checked = false;
        return checkbox.dataset.imageId;
    });
    if (selectedImages.length) {
        const response = await fetch('/add-selected-images', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                images: selectedImages,
                album_id: albumId
            })
        });

        if (!response.ok) {
            Swal.fire(sweetAlertConfigs.error('Failed add images to album'));
            return null;
        }

        const data = await response.json();

        if (data.success) {
            Swal.fire(sweetAlertConfigs.success(response.message));
            console.log(data);
            return data.images;
        } else {
            Swal.fire(sweetAlertConfigs.error('Failed add images to album'));
            return null;
        }
    }
}
