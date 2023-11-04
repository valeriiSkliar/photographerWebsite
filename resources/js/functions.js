 export function loadAddComponentInterface () {
     // $(document).ready(function() {
         $('#showAddComponentForm').on('click', function() {
             $.get('/get-component-form', function(data) {
                 $('#formContainer').html(data.markup);
             });
         // });
     });
 }
export function clearFormContainer() {
    $('#addComponentForm').off('submit', submitForm);
    $('#formContainer').off('click').html('');
}
 function fildsCounter () {
     let detailCount = 0
    return () => {
        return detailCount += 1;
    }
 }
 const counter = fildsCounter();

 export  function addDetailFields() {
     const componentDetailsContainer = document.getElementById('component-details');
     let detailCount = counter();
     console.log(detailCount)
     const newDetailDiv = document.createElement('div');
     newDetailDiv.className = 'component-detail';

     const keyLabel = document.createElement('label');
     keyLabel.textContent = 'Key:';
     const keyInput = document.createElement('input');
     keyInput.type = 'text';
     keyInput.name = `details[${detailCount}][key]`;
     keyInput.required = true;

     const valueLabel = document.createElement('label');
     valueLabel.textContent = 'Value:';
     const valueInput = document.createElement('input');
     valueInput.type = 'text';
     valueInput.name = `details[${detailCount}][value]`;
     valueInput.required = true;

     newDetailDiv.appendChild(keyLabel);
     newDetailDiv.appendChild(keyInput);
     newDetailDiv.appendChild(valueLabel);
     newDetailDiv.appendChild(valueInput);

     componentDetailsContainer.appendChild(newDetailDiv);

     detailCount++;
 }

 export function submitComponentForm() {
     let formData = $('#addComponentForm').serialize();

     $.ajax({
         url: '/components',
         type: 'POST',
         data: formData,
         success: function(response) {
             $('#component_list_table_body').append(response.markup);
             clearFormContainer();
             addListenerToLastChildOfTbody()
             new Swal(response.message);
         },
         error: function(xhr, status, error) {
             console.error('An error occurred:', error);
             const errorMessage = xhr.status + ': ' + xhr.statusText;
             alert('Error - ' + errorMessage);
         }
     });
 }

 export function initialListenersTbody() {
     $('#component_list_table_body').on('click', '.componentRow', function(event) {

         const componentId = $(this).data('componentid');
         getEditComponentForm(componentId);
     });
 }
 export function addListenerToLastChildOfTbody() {
     $('#component_list_table_body tr:last-child').on('click', function(event) {
         const componentId = $(this).data('componentid');
         getEditComponentForm(componentId);
     });
 }

 // export  function submitDestroyComponentForm(id) {
 // //     destroyComponentForm
 //     let formData = $('#destroyComponentForm').serialize();
 //     $.ajax({
 //         url: `/components/${id}/destroy`,
 //         type: 'POST',
 //         data: formData,
 //         success: function(response) {
 //             $(`[data-componentid="${response.id}"`).remove();
 //             // $('#component_list_table_body').append(response.markup);
 //             clearFormContainer();
 //             // addListenerToLastChildOfTbody()
 //             new Swal(response.message);
 //         },
 //         error: function(xhr, status, error) {
 //             // console.error('An error occurred:', error);
 //             const errorMessage = xhr.status + ': ' + xhr.statusText;
 //             new Swal('Error - ' + errorMessage);
 //         }
 //     });
 //     $('#formContainer').off('submit', '#destroyComponentForm').on('submit', '#destroyComponentForm', function (e) {
 //         e.preventDefault();
 //         $(`[data-componentid="${response.component.id}"`).replaceWith(response.markup)
 //     });
 // }

 export function getEditComponentForm(id) {
     $.ajax({
         url: `/components/${id}/edit`,
         type: 'GET',
         success: function (response) {
             $('#formContainer').html(response.markup);

             $('#formContainer').off('click', '#addComponentDetail').on('click', '#addComponentDetail', addDetailFields);

             $('#formContainer').off('submit', '#updateComponentForm').on('submit', '#updateComponentForm', function (e) {
                 e.preventDefault();
                 submitUpdateComponentForm(id);
             });

             $('#disconnect_btn').off('click').on('click', function () {
                 disconnectAlbum(id);
             });
         },
     });
 }
 export function disconnectAlbum(component_id) {
     $.ajax({
         url: `/api/component-album-disconnect/${component_id}`,
         method: 'POST',
         headers: {
             'X-Requested-With': 'XMLHttpRequest',
             'X-CSRF-TOKEN': `{{ csrf_token() }}`,
     },
         success: function (response) {
             new Swal(response.message);
             $('#imageContainer').html('')
             $('#connectedAlbumContainer').remove();
             $('#albumsSelect').css('display', 'block');
         },
     })
 }

 export function  submitUpdateComponentForm(id) {
     let formData = $('#updateComponentForm').serialize();

     $.ajax({
         url: `/components/${id}/update`,
         type: 'POST',
         data: formData,
         success: function(response) {
             $(`[data-componentid="${response.component.id}"`).replaceWith(response.markup)
             // $('#component_list_table_body').append(response.markup);
             clearFormContainer();
             // addListenerToLastChildOfTbody()
             new Swal(response.message);
         },
         error: function(xhr, status, error) {
             // console.error('An error occurred:', error);
             const errorMessage = xhr.status + ': ' + xhr.statusText;
             new Swal('Error - ' + errorMessage);
         }
     });
 }


 export function submitForm(e) {
     e.preventDefault();
     submitComponentForm();
 }


 export function addMetaTagRow() {
     // Get the container where meta tags are held
     const container = document.querySelector('.meta-tags-container');

     // Find the last index used in the name attributes (or -1 if there are no current meta tags)
     const lastMetaTagIndex = Array.from(container.querySelectorAll('input[name^="metaData["]'))
         .reduce((lastIndex, input) => {
             const matches = input.name.match(/\[(\d+)\]/);
             return matches ? Math.max(lastIndex, parseInt(matches[1], 10)) : lastIndex;
         }, -1);

     // The index for the new meta tag will be one more than the last index
     const newIndex = lastMetaTagIndex + 1;

     // Create the new row HTML (adjust according to your needs, especially the names array indexing)
     const newRowHtml = `
        <div class="row meta-tag-row">
            <input value="" name="metaData[${newIndex}][teg_id]" type="hidden">
            <div class="col-2 mb-2">
                <!-- Meta type select -->
                <!-- Repeat your meta tag type select structure here, adjusting the index -->
            </div>
            <div class="col-3 mb-2">
                <!-- Meta value select -->
                <!-- Repeat your meta tag value select structure here, adjusting the index -->
            </div>
            <div class="col-6 mb-2">
                <!-- Meta content input -->
                <input class="form-control"
                       name="metaData[${newIndex}][content]"
                       placeholder="Input content here!"
                       type="text">
            </div>
            <div class="col-1 mb-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger delete-meta-tag" data-meta-tag-id="">
                    x
                </button>
            </div>
        </div>
    `;

     // Append the new row to the container
     container.insertAdjacentHTML('beforeend', newRowHtml);
 }
