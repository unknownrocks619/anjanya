
$(document).on('submit', 'form.ajax-form', function (event) {
    event.preventDefault();
    window.clearAllErrors();
    let form = this;
    $(form).addClass('ajax-submit-success');
    disableAllButtons(form);
    $.ajax({
        method: $(form).attr('method'),
        url: $(form).attr('action'),
        data: $(form).serializeArray(),
        success: function (response) {
            handleOKResponse(response);
            if (window.modalElement) {
                window.modalElement.hide();

            }
            $(form).removeClass('ajax-submit-success');
        },
        error: function (response) {
            handleBadResponse(response);
            enableAllButtons(form);
            if (window.modalElement) {
                window.modalElement.hide();
            }
            $(form).removeClass('ajax-submit-success');
        }
    })
});


$(document).on('submit', 'form.ajax-component-form', function (event) {
    event.preventDefault();

    let form = this;
    disableAllButtons(form);

    $.ajax({
        method: $(form).attr('method'),
        url: $(form).attr('action'),
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            handleOKResponse(response);
            if (window.modalElement) {
                window.modalElement.hide();

            }
            enableAllButtons(form);

        },
        error: function (response) {
            handleBadResponse(response);
            enableAllButtons(form);
        }
    })
});



window.disableAllButtons = function (element = null) {
    if (!element) {
        $(document).find("button").prop('disabled', true);
        return;
    }

    $(element).find('button').prop('disabled', true)
}

window.enableAllButtons = function (element = null) {
    if (!element) {
        $(document).find("button").prop('disabled', false);
        return;
    }

    $(element).find('button').prop('disabled', false)
}
