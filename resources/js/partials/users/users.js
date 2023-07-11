$(document).on('change', '#same_as_billing', function (event) {
    let _isSame = $(this).is(":checked");

    if (_isSame == true) {
        $('.delivery_address_field').fadeOut('fast')
    } else {
        $('.delivery_address_field').fadeIn('fast')
    }

})


$(document).on('change', '.update_application_media', function (event) {
    event.preventDefault();
    let _value = $(this).find(":selected").val();
    console.log('value : ', _value);
    if (!_value) {
        return;
    }

    $.ajax({
        method: $(this).attr('data-method'),
        url: $(this).attr('data-action'),
        data: { 'status': _value },
        success: function (response) {
            window.handleOKResponse(response);
        },
        error: function (response) {
            window.handleBADResponse(response);
        }
    })
})
