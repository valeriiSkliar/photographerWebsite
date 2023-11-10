import 'jquery-ui-dist/jquery-ui.js';
import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import {getPageID} from "@/helpers/getPageID.js";

export function updateComponentOrder(newOrder) {
    return $.ajax({
        url: '/api/update-components-list/order',
        type: 'POST',

        data: {
            order: newOrder,
            page_id: getPageID(),
            _token: `${getCsrfToken()} `
        },
        success: function(response) {
            console.log(response.message);
            return response.success;
        },
        error: function(response) {
            console.error(response.error);
            return response.error;
        }
    });
}

$("#component_list_table_body").sortable({
    handle: ".drag-handle",
    // placeholder: "placeholder",
    //     helper: "clone",
    // items: "> tr",
    helper: function(event, ui) {
        // ui.css('opacity', '0')
        const sortableItem = document.createElement("div");
        sortableItem.classList.add('sortableItem');
        sortableItem.textContent = ui.clone().data('component_name');
        return sortableItem;

        // const $clone = ui.clone();
        // $clone.children('td').each(function(index){
        //     $(this).width(ui.children('td').eq(index).width());
        // });
        // return $clone;
    },
    update:async function(event, ui) {
        const sortedItems = [];
        $(".componentRow").each(function(index) {
            const componentId = $(this).data("componentid");

            sortedItems.push({
                id: componentId,
                order: index
            });
        });

        const changeComponentsOrder = await updateComponentOrder(sortedItems);
        if (changeComponentsOrder) {
            ui.item.addClass('highlight-animation').delay(1500).queue(function(next){
                $(this).removeClass('highlight-animation');
                next();
            });
        }
    }
}).disableSelection();
