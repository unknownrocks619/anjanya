import Swal from 'sweetalert2';

Object.defineProperty(window, 'SIDEBAR_TEXT', {
    value: {
        1: 'first',
        2: "second",
        3: 'third',
        4: 'fourth',
        5: 'five',
        6: 'six',
    },
    writable: false,
    enumerable: true,
    configurable: false
})

import './frontend_partials/ajax_form.js';
import './frontend_partials/ajax-modal.js'
import './partials/splide.js'

$(function () {
    /**
     * Ajax Setup
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.ajax-append').each(function (index, element) {
        $(element).append(`<input type='hidden' name='_token' value='${$('meta[name=csrf-token]').attr('content')}' />`);

        let _first_row = $(element).find('div.row')[0];
        if (!$(_first_row).find('.ajax-form-message-box').length) {
            $(_first_row).prepend(`<div class='ajax-form-message-box'></div>`);
        }
    })


    window.handleOKResponse = function (response) {
        if (response.status == 200) {
            messageBox(response.state, response.msg);

            if ((response.callback !== null || response.callback !== '')) {
                let fn = window[response.callback];
                if (typeof (fn) === 'function') {
                    fn(response.params);
                }
            }
        }
    }

    window.handleBadResponse = function (response) {
        clearAllErrors();
        if (response.status == 422) {
            handle422Case(response.responseJSON ? response.responseJSON : response);
        }
    }

    window.handle422Case = function (data) {
        let message = data.message;
        if (data.msg !== undefined) {
            message = data.msg;
        }
        messageBox(false, message);
        if ($('.response-ajax-category').length) {
            $(".response-ajax-category").html("<div class='alert alert-danger'>" + message + "</div>");
        }
        $.each(data.errors ?? data.data.errors, function (index, error) {
            let inputElement = $(`[name="${index}"]`);
            console.log('input tleme', inputElement);
            let parentDiv = $(inputElement).closest('div.form-group');
            if (parentDiv.length) {
                let element = `<div class='text-danger ajax-response-error'>${error}</div>`
                parentDiv.append(element);
            }
        });
    }

    window.redirect = function (param) {
        if (typeof param.location !== 'undefined' || param.location !== null) {
            window.location.href = param.location
        }
    }

    window.reload = function () {
        window.location.reload();
    }


    $(document).on('click', '.ajax-button-confirm', function (event) {
        event.preventDefault();
        let _this = this;
        $(this).attr('disabled', true);
        $(this).addClass('text-muted');
        $.ajax({
            method: $(this).attr('data-method'),
            url: $(this).attr('data-action'),
            success: function (response) {
                handleOKResponse(response);
                $(_this).attr('disabled', false);
                $(_this).removeClass('text-muted');

            },
            error: function (response) {
                handleBadResponse(response);
                $(_this).attr('disabled', false);
                $(_this).removeClass('text-muted');
            }
        })
    })

    window.messageBox = function (state = null, message = null) {
        if (state == null || message == null) {
            return;
        }
        let _class = (state == true) ? 'alert alert-success bg-success text-white' : 'alert alert-danger';
        // check if to display on form
        if ($('.ajax-append').length && $('.ajax-submit-success').length && $(".ajax-form-message-box").length) {
            let _div = `<div class='row'> <div class='col-md-12 ${_class}'>${message}</div></div>`
            $('.ajax-submit-success').find('.ajax-form-message-box').html(_div);
            // $('.ajax-form-message-box').html(_div);
        }
        if (_class =='alert alert-success bg-success text-white') {
            $('.ajax-append').find('input').val('');
        }
    }


    window.clearAllErrors = function () {
        $('.ajax-response-error').remove();
        $('.ajax-form-message-box').empty();
        $(".response-ajax-category").empty();
    }

    if ($('.copy_link').length) {
        $(document).on('click', '.copy_link', function (event) {
            event.preventDefault();
            navigator.clipboard.writeText($(this).attr('data-url'));
            alert('Link Copied');
        });
    }

    setTimeout(function () {

        if ($("[data-style-background]").length) {

            $.each($('[data-style-background]'), function (index, element) {
                if ($(element).attr('data-style-background') != '') {
                    $(element).css(
                        {
                            'background': "url(" + $(element).attr('data-style-background') + ")",
                            'background-size': 'cover',
                            'background-position': "center",
                            'background-repeat': 'no-repeat'
                        })
                    // 'background', "url(" + $(element).attr('data-style-background') + ")");
                    // $(element).removeAttr('data-style-background');
                }
            })

        }

    }, 1000)


    $(document).on('click', '.data-confirm', function (event) {
        event.preventDefault()
        let confirmTitle = $(this).data('confirm')
        let ele = this;
        Swal.fire({
            title: 'Are You Sure ?',
            text: confirmTitle ?? "Are you Sure ?",
            showConfirmButton: true,
            showCloseButton: true,
            showCancelButton: true
        }).then((action) => {
            if (action.isConfirmed === true) {
                // perform ajax query.
                if ($(ele).data('action')) {
                    $.ajax({
                        method: $(ele).data('method'),
                        url: $(ele).data('action'),
                        data: $(ele).data('values'),
                        success: function (response) {
                            handleOKResponse(response)
                        },
                        error: function (response) {
                            handleBadResponse(response);
                        }
                    })
                }

                if ($(ele).attr('href') && !$(ele).attr('href') != '') {

                    let param = { location: $(ele).attr('href') }
                    redirect(param);
                }
            }
        })
    })

    if ($("registration").length) {
        let _text = 'Register Now'


        $.each($('registration'), function (registrationIndex, registrationElement) {

            let _elementText = $(registrationElement).text();

            if (_elementText != '') {
                _text = _elementText;
            }

            let _button = `<a href='/register' class='detail-btn mx-1 btn btn-default' >${_text}</a>`
            $(registrationElement).replaceWith(_button);
        })
    }

    if ($(document).find('div[contenteditable="true"]').length) {
        $(document).find('div[contenteditable="true"]')
                    .removeAttr('contenteditable')
                    .removeClass('tiny-mce')
                    .removeClass('mce-content-body')
                    .removeAttr('editable')
    };

})
