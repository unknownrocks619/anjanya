import $ from 'jquery'
import { Modal } from 'bootstrap';

$(document).on('click', '.ajax-modal', function (event) {
    let clickeElement = this;

    let ajaxIdElement = $(this).data('bs-target');
    let ajaxIdName = ajaxIdElement.substring(1, ajaxIdElement.length);

    let actionUrl = $(this).data('action') ?? event.relatedTarget.href;
    let ajaxMethod = $(this).data('method') ?? 'get';

    $(clickeElement).prop('disabled', true).addClass('disabled');

    $.ajax({
        method: ajaxMethod,
        url: actionUrl,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $(ajaxIdElement).find('div#' + ajaxIdName + 'modal-document').html(response);
            $("#" + ajaxIdName + "-modal-document").html(response);
            document.getElementById(ajaxIdName + '-modal-document').innerHTML = response;
            window.modalElement = new Modal($(ajaxIdElement));
            window.modalElement.show();
            $(clickeElement).prop('disabled', false).removeClass('disabled');
            // check for select 2 element.
            let select2Element = $('#' + ajaxIdName).find('select');

            if (select2Element.length) {
                $.each(select2Element, function (index, elem) {
                    window.ajaxReinitalize(elem, { dropdownParent: $('#' + ajaxIdName) });
                })
            }
        },
        error: function (response) {
            messageBox(false, 'Unable to load ');
            $(clickeElement).prop('disabled', false).removeClass('disabled');
        }
    })
});
