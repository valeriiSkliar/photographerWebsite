import {addToAlbum, makeImagesSortable, selectAllImages} from "@/admin/gallery/function.js";

document.getElementById('selectAll')
    .addEventListener('change', selectAllImages);


document.getElementById('btnAddToAlbum')
    .addEventListener('click', async function addImagesToAlbum() {
        const images = JSON.parse(await addToAlbum(this.dataset.albumId));
        if (images) {
            const albumImageCards = document.querySelector('.albumImageCards');

            if (!albumImageCards) return;

            for (let i = 0; i < images.length; i++) {
                albumImageCards.insertAdjacentHTML("beforeend", `
                <div class="col-md-4 my-3 selectable-item" data-image_id="${images[i].id}" style="min-width: 8rem;">
                    <div class="image-container">
                        <a href="${images[i].file_url}" data-lightbox="album images" data-title="${images[i].title}" class="wrapper-for-lazy-image">
                            <div class="aspect-ratio-16-9 rounded"></div>
                            <img src="${images[i].file_url}" class="img-thumbnail lazy-image-thumbnail" alt="${images[i].alt_text}" title="${images[i].title}" loading="lazy">
                        </a>
                    </div>
                </div>
            `);
            }
            makeImagesSortable();
        }
    });
