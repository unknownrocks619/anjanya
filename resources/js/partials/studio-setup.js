import $ from 'jquery'

$(document).on('submit', 'form.studio-setup-steps', function (event) {
    event.preventDefault();
    let form = this;
    disableAllButtons(form)
    $.ajax({
        method: $(form).attr('method'),
        action: $(form).attr('action'),
        data: $(form).serializeArray(),
        success: function (response) {
            handleOKResponse(response);
        },
        error: function (response) {
            handleBadResponse(response);
            enableAllButtons(form);
        }
    })
})
