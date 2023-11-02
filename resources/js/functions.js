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


