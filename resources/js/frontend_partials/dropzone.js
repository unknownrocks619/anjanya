import Dropzone from 'dropzone';
Dropzone.autoDiscover = false;

window.frontendDropzone = function (element) {
    let formurl = $(element).closest('form').attr('action');
    let _formElement = $(element).closest('form')[0];
    $('div.main_registration_content').find('button').attr('disabled',true);
    window._formElement = _formElement;
    return new Dropzone(element, {
        paramName: "file",
        maxFiles: $(element).closest('form').data('max-file') ?? 1,
        maxFilesize: 4,
        accept: function (file, done) {
            done();
        },
        acceptedFiles: 'image/jpg,image/jpeg,image/png',
        url: formurl,
        withCredentials: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
        clickable: true,
        done: function (response, data) {

        },
        complete: function (file, response) {
            if (file.status == 'success') {
                console.log(file.xhr.response)
                handleOKResponse(JSON.parse(file.xhr.response));
            }
            $('div.main_registration_content').find('button').removeAttr('disabled');
        },
        error: function (file, message) {
            if (file.status == 'error') {
                window.messageBox(false, 'Unable to upload file');
            }
            $('div.main_registration_content').find('button').removeAttr('disabled');
        },
        addRemoveLinks: true,
        dictRemoveFileConfirmation: "Are you sure ?, This action cannot be undone.",

    });
}
