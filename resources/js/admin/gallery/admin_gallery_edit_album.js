import {addToAlbum, appendImagesToAlbum, makeImagesSortable} from "@/admin/gallery/function.js";

document.getElementById('btnAddToAlbum')
    .addEventListener('click', async function addImagesToAlbum() {
        const images = await addToAlbum(this.dataset.albumId);
        if (images) {
            appendImagesToAlbum(images);
            await makeImagesSortable();
        }
    });

