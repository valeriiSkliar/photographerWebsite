import 'jquery-ui-dist/jquery-ui.js';
import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import {sendUnpinRequest} from "@/functions.js";
import {addToAlbum, appendImagesToAlbum, makeImagesSortable} from "@/admin/gallery/function.js";

document.addEventListener('DOMContentLoaded', makeImagesSortable)

const albumId = $('#albumId')[0].value;

let containerImages = $('#images')
$('#add-to-album').droppable({
    accept: "#images > .image_from_all_heaps",
    classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
    },
    activate:function (event, {helper}) {
        $(helper).addClass('ui-droppable-active');
    },
    over: function(event, ui) {
        $(this).removeClass('bg-gradient-white');
        $(this).addClass('bg-success');
    },
    out: function(event, ui) {
        $(this).removeClass('bg-gradient-success');
        $(this).addClass('bg-gradient-white');
    },
    drop: async function( event, ui ) {
        $(this).removeClass('bg-gradient-success');
        $(this).addClass('bg-gradient-white');
        const imageId = $(ui.draggable).find('input').data('image-id');
        const images = await addToAlbum(albumId,[imageId]);
        if (images) {
            appendImagesToAlbum(images);
            await makeImagesSortable();
        }
    }
});
$( ".image_from_all_heaps", containerImages ).draggable({
        revert: "invalid",
        containment: "document",
        helper: "clone",
});
