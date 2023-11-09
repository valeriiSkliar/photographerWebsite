import {showMetaTagSwalModal} from "@/functions.js";

const deleteButtons = document.querySelectorAll('.btn-delete');

deleteButtons.forEach(button => {
    button.addEventListener('click', async function (e) {
        e.preventDefault();
        const pageHref = this.getAttribute('data-page-href');
        const result = await Swal.fire(sweetAlertConfigs.modalConfirm());
        // Use Fetch API for the delete request
        if (result.value) {
            try {
                this.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Page deleted successfully',

                })
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error deleting page: ' + error.message,
                });

                // Optionally, you can show an error message to the user
            }
        }
    })
})


function confirmDelete (form) {
    Swal.fire(sweetAlertConfigs.modalConfirm())
        .then((result) => {
            if (result.value) {
                form.submit();
            }
        });
}

$('#showMetaTagsForm').on('click', showMetaTagSwalModal)

