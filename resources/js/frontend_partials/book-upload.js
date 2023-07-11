window.CURRENT_STEP = $('#book_upload_contianer').attr('data-current-step');

const STEP_COUNTER = {
    'step_zero': {
        'percentage': '100%',
        'step': 1,
        'progress_bar': '1%',
        'progress_checkmark': 'first'
    },
    'step_one': {
        'percentage': '100%',
        'step': 1,
        'progress_bar': '0%',
        'progress_checkmark': 'second'
    },
    'step_two': {
        'percentage': '80%',
        'step': 2,
        'progress_bar': '20%',
        'progress_checkmark': 'third'
    },
    'step_three': {
        'percentage': '60%',
        'step': 3,
        'progress_bar': '40%',
        'progress_checkmark': 'fourth'

    },
    'step_four': {
        'percentage': '40%',
        'step': 4,
        'progress_bar': '60%',
        'progress_checkmark': 'five'
    },
    'step_five': {
        'percentage': '20%',
        'step': 5,
        'progress_bar': '80%',
    },
    'step_six': {
        'percentage': '0%',
        'step': 6,
        'progress_bar': '100%'
    }
}

function bookUploaderSidebar(current_step) {

    let _stepElement = $('.book-upload-sidebar').find('.step-count');
    let _percentage = $('.book-upload-sidebar').find('.percent-complete');
    let _progressBar = $('.book-upload-sidebar').find('.progress-bar');
    $(_stepElement).text(STEP_COUNTER[current_step].step);
    $(_percentage).text(STEP_COUNTER[current_step].percentage);

    $('.sidebar').find('.information-circle-disabled').removeClass('active-circle');
    $('.sidebar').find('.information-line-disabled').removeClass('active-line')
    $('.sidebar').find('.information-disabled ').removeClass('active-text')

    let _active_checkmark = $('.sidebar').find('.' + window.SIDEBAR_TEXT[STEP_COUNTER[current_step].step]);
    $(_active_checkmark).find('.information-circle-disabled').addClass('active-circle')
    $(_active_checkmark).find('.information-line-disabled').addClass('active-line')
    $(_active_checkmark).find('.information-disabled ').addClass('active-text')

    for (let i = 1; i < STEP_COUNTER[current_step].step; i++) {
        let _checkmarkImage = $('.sidebar').find('.' + window.SIDEBAR_TEXT[i]);
        $(_checkmarkImage).find('.information-circle-disabled').addClass('active-circle')
        $(_checkmarkImage).find('.information-line-disabled').addClass('active-line')
        $(_checkmarkImage).find('.information-disabled ').addClass('active-text')
        $(_checkmarkImage).find('img').removeClass('d-none');
    }

    $(_progressBar).css('width', STEP_COUNTER[current_step].progress_bar);
}


window.bookUploaderNext = function (params) {
    console.log('heleo ', params);
    window.CURRENT_STEP = params.current_step;
    $("#book_upload_contianer").empty().html(params.view);
    bookUploaderSidebar(window.CURRENT_STEP);
    window.history.pushState(null, '', params.path);
    window.validateBook();
    checkmark();
    removeSidebar();
}


function removeSidebar() {
    if (window.CURRENT_STEP == 'step_six') {
        $('.book-upload-sidebar').remove();
    }
}

function checkmark() {

    if (!$('.checkmark').length) {
        return;
    }

    let counter = 0;
    $(".checkmark").each(function () {
        if ($(this).is(':checked')) {
            counter++;
        }
    });
    if (counter >= 5) {
        $(".checkmark").prop('disabled', true);
    } else {
        $('.checkmark').prop('disabled', false);
    }
    $(".checkmark").each(function () {
        if ($(this).is(':checked')) {
            $(this).prop('disabled', false);
        }
    });

}

$(document).on('change', '.checkmark', function (event) {
    checkmark();
})


window.bookUploaderBack = function () {
    // window.validateBook();

}

window.validateBook = function () {
    if (!$('.validate-book').length) {
        return;
    }

    let _container = $(".validate-book");
    let _correctSpan = '<i class="icon far fal fa-check-circle text-success"></i>';
    let _incorrectSpan = '<i class="icon far fal fa-times-circle text-danger"></i>';

    setTimeout(() => {
        $.ajax({
            method: "POST",
            data: "",
            url: $(_container).data('action'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                let _values = response.params.values;
                $.each(response.params.keys, function (index, keys) {
                    if ($('.' + keys).length) {

                        let _element = $("." + keys)
                        if ($(_element).find('.loading').length) {
                            if (_values[keys] == true) {
                                $(_element).find('.loading').html(_correctSpan)
                                $(_element).find('.validation-text').addClass('text-success')
                            } else {
                                $(_element).find('.loading').html(_incorrectSpan)
                                $(_element).find('.validation-text').addClass('text-danger')
                            }
                        }
                    }

                });
                $("#validationMessage").html(response.params.validation_message);
            }
        })
    }, 2000);

}


if ($('.book-upload-sidebar').length > 0) {
    removeSidebar();
    $(function () {
        bookUploaderSidebar(window.CURRENT_STEP);
        window.validateBook();
    });
}

if (typeof Dropzone !== 'undefined') {

    Dropzone.options.bookUploadDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 250, // MB
        acceptedFiles: "application/pdf",

        error: function (response, file) {

            $(".ajax-response-error").fadeIn("fast", function () {
                if (response.accepted == false) {
                    $(this).addClass('text-danger').text('Only PDF Files Accepted.').removeClass('d-none');
                }
            });
        },
        success: function (file, response) {

        },
        complete: function (response, file) {

            if (response.accepted == false) {
                this.removeAllFiles(response);
                $("#dz-file-allowed-error").fadeIn("fast")
            }
            let serverResponse = JSON.parse(response.xhr.response);
            if (response.status == 'error' && response.xhr.status == 422) {
                $(".ajax-response-error").fadeIn("fast", function () {
                    $(this).addClass('text-danger').text('Only PDF Files Accepted.').removeClass('d-none');
                });
                this.removeAllFiles(response);
                $("#dz-file-allowed-error").fadeIn("fast")
            }

            if (response.accepted == true && response.status == "success" && serverResponse.state == true) {
                window.handleOKResponse(serverResponse);
            } else {
                $(".ajax-response-error").fadeIn("fast", function () {
                    $(this).addClass('text-danger').text(serverResponse.msg).removeClass('d-none');
                });
                this.removeAllFiles(response);
                $("#dz-file-allowed-error").fadeIn("fast")
            }
        },
        queuecomplete: function (response) {
            console.log("queue is now complete.");
            console.log(response);
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }

}

$(document).on('click', '.step-back-book-uploader', function (event) {
    event.preventDefault();
    let _this = this;
    $.ajax({
        method: "POST",
        url: $(_this).attr('data-url'),
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf_token']").attr('content'),
        },
        success: function (response) {
            handleOKResponse(response);
        },
        error: function (response) {
            handleBadResponse(response);
        }
    })
})
