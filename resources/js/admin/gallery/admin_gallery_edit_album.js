import {addToAlbum, selectAllImages} from "@/admin/gallery/function.js";

document.getElementById('selectAll')
    .addEventListener('change', selectAllImages);


document.getElementById('btnAddToAlbum')
    .addEventListener('click', async function addImagesToAlbum () {
       const images = JSON.parse( await addToAlbum(this.dataset.albumId) );
       if (images) {
           const albumImageCards = document.querySelector('.albumImageCards');

           if (!albumImageCards) return;

           for (let i = 0; i < images.length; i+=1) {
               albumImageCards.insertAdjacentHTML("beforeend", `
                   <div class="col-md-2 my-3">
                        <div class="image-container">
                            <a href="${images[i].file_url}" data-lightbox="album images"
                               data-title="${images[i].title}">
                                <img src="${images[i].file_url}" class="fluid img-thumbnail"
                                     alt="${images[i].atl_text}">
                            </a>
                        </div>
                    </div>
               `);
           }
       }
    });
