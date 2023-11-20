import 'jquery-ui-dist/jquery-ui.js';
import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import {sendUnpinRequest} from "@/functions.js";

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
