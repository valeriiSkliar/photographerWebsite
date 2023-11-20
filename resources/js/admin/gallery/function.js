import Swal from "sweetalert2";
import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import {sendUnpinRequest} from "@/functions.js";

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
            Swal.fire(sweetAlertConfigs.success(data.message));
            return data.images;
        } else if(!data.success) {
            Swal.fire(sweetAlertConfigs.error(data.message));
            return null;
        }
        else {
            Swal.fire(sweetAlertConfigs.error('Failed add images to album'));
            return null;
        }
    }
}

export async function makeImagesSortable() {
    const albumId = $('#albumId')[0].value
    $(function () {
        let originalOrder = [];
        $("#sortable").sortable({
            handle: 'img',
            // axis: 'x',
            scroll:false,
            start: function(event, ui) {

                originalOrder = $(this).sortable('toArray', { attribute: 'data-image-id' });
            },
            update: async function () {

                $(this).sortable('disable');
                const imageOrder = [];
                $(".selectable-item").each(function(index) {
                    const imageId = $(this).data("image_id");
                    imageOrder.push(imageId)
                });
                $.ajax({
                    url: '/admin/image-order/update',
                    method: 'POST',
                    data: {
                        album_id: albumId,
                        imageOrder: imageOrder,
                        _token: getCsrfToken()
                    },
                    success: function(response) {
                        console.log(response.success);
                        $("#sortable").sortable('enable');
                    },
                    error:function(response) {
                        console.log(response.error);
                        $("#sortable").sortable('cancel');
                    }
                });

            },
            complete: function() {
                $("#sortable").sortable('enable');
            }
        });
        $( "#sortable" ).disableSelection();
    });

    const selectableItem = $('.selectable-item')
    $(selectableItem).off('contextmenu').on('contextmenu', function(e) {
        e.preventDefault();
        $('#contextMenu').css({
            display: "block",
            left: e.pageX,
            top: e.pageY
        });

        const imageId = $(this).data('image_id');
        const target = $(this);
        $('#deleteFromAlbum').off('click').on('click', async function() {
            await sendUnpinRequest({
                imageId: imageId,
                albumId:albumId,
                target:target
            })

            $('#contextMenu').hide();
        });
    });

    $(document).click(function() {
        $('#contextMenu').hide();
    });
}

