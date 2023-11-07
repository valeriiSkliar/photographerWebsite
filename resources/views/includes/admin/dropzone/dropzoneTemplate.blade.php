@pushonce('iframe.style')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/dropzone.min.css') }}">
    @vite(["resources/scss/admin/dropzone/dropzoneTheme.scss"])
@endpushonce

@pushonce('iframe.script')
    <script src="{{ asset('AdminLTE/plugins/dropzone/dropzone.js') }}"></script>
@endpushonce

<form style="max-height: 450px; overflow-y: auto" enctype="multipart/form-data"
      class="dropzone fileuploader" id="zdrop">
    @csrf
    <div id="upload-label" class="dz-message">
        <i class="fas fa-cloud-upload-alt"></i>
        <span class="title note">Click the Button or Drop Files Here</span>
    </div>
</form>
<div id="preview-template" style="display: none;">
    <div class="dz-preview dz-file-preview">
        <div class="dz-image"><img data-dz-thumbnail=""></div>
        <div class="dz-details">
            <div class="dz-size"><span data-dz-size=""></span></div>
            <div class="dz-filename"><span data-dz-name=""></span></div>
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
    </div>
</div>
