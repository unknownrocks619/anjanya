import $ from 'jquery';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;
$(function () {
    if ($('.dz-area').length) {
        $.each($('.dz-area'), function (index, element) {
            let formurl = $(element).closest('form').attr('action');
            let dropzone = new Dropzone(element, {
                paramName: "file",
                maxFiles: $(element).closest('form').data('max-file') ?? 1,
                maxFilesize: 150,
                accept: function (file, done) {
                    done();
                },
                url: formurl,// $(element).closest('form').attr('action'),
                withCredentials: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                },
                clickable: true,
                done: function (response, data) {
                },
                complete: function (file, response) {
                    if (file.status == 'success') {
                        handleOKResponse(JSON.parse(file.xhr.response));
                    }
                },
                error: function (file, message) {
                    if (file.status == 'error') {
                        window.messageBox(false, 'Unable to upload file');
                    }
                }
            });
        });
    }
});
