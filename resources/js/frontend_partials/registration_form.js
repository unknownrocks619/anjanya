
// const STEP_REGISTRATION_COUNTER = {
//     'step_one': {
//         'percentage': '100%',
//         'step': 1,
//         'progress_bar': '1%',
//         'progress_checkmark': 'first'
//     },
//     'step_two': {
//         'percentage': '67%',
//         'step': 2,
//         'progress_bar': '33%',
//         'progress_checkmark': 'second'
//     },
//     'step_three': {
//         'percentage': '33%',
//         'step': 3,
//         'progress_bar': '67%',
//         'progress_checkmark': 'third'
//     },
//     'step_four': {
//         'percentage': '0%',
//         'step': 3,
//         'progress_bar': '100%',
//         'progress_checkmark': 'fourth'

//     },
// }
// window.CURRENT_REGISTRATION_STEP = $("#book_upload_contianer").data('current-step');

// $(document).on('change', 'select[name="canva_terms_options"]', function (event) {

//     // search for terms binding canva.
//     let _current_value = $(this).find(":selected").val();

//     if (_current_value == 'yes') {
//         $('.canva-term').fadeIn('fast', function () {
//             $(this).find('input').attr('required', true);
//         });
//     } else {
//         $('.canva-term').fadeOut('fast', function () {
//             $(this).find('input').removeAttr('required');
//         });
//     }
// })

// $(document).on('click', '.upload-picture-icon', function (event) {
//     event.preventDefault();
//     $('#profile-picture').trigger('click');

// })

// $(document).on('change', '#profile-picture', function (event) {
//     let parentDiv = $(this).closest('form');
//     let uploadBarDiv = $(this).closest('div.up-content');
//     $(uploadBarDiv).append("<p class='ajax-upload-bar-text text-danger'>Uploading file...</p>");
//     $(document).find('button').prop('disabled', true);

//     setTimeout(() => {
//         $(document).find('button').prop('disabled', false);
//     }, 2000);

//     var formData = new FormData($(parentDiv)[0]);
//     $.ajax({
//         url: $(parentDiv).attr('action'),
//         type: $(parentDiv).attr('method'),
//         data: formData,
//         async: false,
//         cache: false,
//         contentType: false,
//         enctype: 'multipart/form-data',
//         processData: false,
//         success: function (response) {
//             window.handleOKResponse(response)
//         },
//         error: function (response) {
//             window.handleBadResponse(response);
//         }
//     });
// })


// $(document).on('change', '.upload-bulk-user', function (event) {
//     let parentDiv = $(this).closest('form');
//     let uploadBarDiv = $(this).closest('div.cvc-uploader');
//     $(uploadBarDiv).append("<p class='ajax-upload-bar-text text-danger'>Uploading file...</p>");
//     var formData = new FormData($(parentDiv)[0]);
//     console.log('bbok upload.');
//     $.ajax({
//         url: $(parentDiv).attr('action'),
//         type: $(parentDiv).attr('method'),
//         data: formData,
//         async: false,
//         cache: false,
//         contentType: false,
//         enctype: 'multipart/form-data',
//         processData: false,
//         success: function (response) {
//             window.handleOKResponse(response)
//         },
//         error: function (response) {
//             window.handleBadResponse(response);
//         }
//     });
// })

// window.profileImage = function (params) {

//     if ($("div.up-img").length) {
//         $('div.up-img').empty().html("<img src='" + params.image_path +
//             "' class='img-fluid rounded rounded-5' />")
//     }

//     if ($("div.user-img").length) {
//         $('div.user-img').empty().html("<img src='" + params.image_path +
//             "' class='img-fluid rounded rounded-5' />")
//     }

//     if ($(".ajax-upload-bar-text").length) {
//         $('.ajax-upload-bar-text').remove();
//     }
// }


// function registrataionSidebar(current_step) {

//     let _stepElement = $('.signup-progress-bar').find('.step-count');
//     let _percentage = $('.signup-progress-bar').find('.percent-complete');
//     let _progressBar = $('.signup-progress-bar').find('.progress-bar');
//     $(_stepElement).text(STEP_REGISTRATION_COUNTER[current_step].step);
//     $(_percentage).text(STEP_REGISTRATION_COUNTER[current_step].percentage);

//     $('.sidebar').find('.information-circle-disabled').removeClass('active-circle');
//     $('.sidebar').find('.information-line-disabled').removeClass('active-line')
//     $('.sidebar').find('.information-disabled ').removeClass('active-text')

//     let _active_checkmark = $('.sidebar').find('.' + window.SIDEBAR_TEXT[STEP_REGISTRATION_COUNTER[current_step].step]);
//     $(_active_checkmark).find('.information-circle-disabled').addClass('active-circle')
//     $(_active_checkmark).find('.information-line-disabled').addClass('active-line')
//     $(_active_checkmark).find('.information-disabled ').addClass('active-text')

//     for (let i = 1; i < STEP_REGISTRATION_COUNTER[current_step].step; i++) {
//         let _checkmarkImage = $('.sidebar').find('.' + window.SIDEBAR_TEXT[i]);
//         $(_checkmarkImage).find('.information-circle-disabled').addClass('active-circle')
//         $(_checkmarkImage).find('.information-line-disabled').addClass('active-line')
//         $(_checkmarkImage).find('.information-disabled ').addClass('active-text')
//         $(_checkmarkImage).find('img').removeClass('d-none');
//     }

//     $(_progressBar).css('width', STEP_REGISTRATION_COUNTER[current_step].progress_bar);
// }


// window.registrationNext = function (params) {
//     window.CURRENT_REGISTRATION_STEP = params.current_step;
//     $("#book_upload_contianer").empty().html(params.view);
//     registrataionSidebar(window.CURRENT_REGISTRATION_STEP);
//     window.history.pushState(null, '', params.path);
//     removeSidebar();
// }

// function removeSidebar() {
//     if (window.CURRENT_REGISTRATION_STEP == 'step_four') {
//         $('.sidebar').remove();
//         $('#book_upload_contianer').addClass('col-md-12').removeClass('col-md-8')
//     }
// }

// $(() => {
//     if ($('#book_upload_contianer').length == 1) {

//         registrataionSidebar(window.CURRENT_REGISTRATION_STEP);
//         removeSidebar();

//     }
// });
