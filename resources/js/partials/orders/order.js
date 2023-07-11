$(document).on('change', '.order_status_update', function (event) {
    event.preventDefault();
    let _this = this;
    let _currentValues = $(this).find(":selected").val();
    $('.order_status_options').addClass('d-none')
    if ($('.' + _currentValues).length >= 1) {
        $("." + _currentValues).removeClass('d-none');
    }
    let _url = $(this).closest('form').attr('data-action');
    $(this).closest('form').attr('action', _url + '/' + 'status');
    $(this).closest('form').trigger('submit');
});


$('div.order_status_options').on('change', ':input', function (event) {
    event.preventDefault();
    let _url = $(this).closest('form').attr('data-action');
    $(this).closest('form').attr('action', _url + '/' + 'status');
    $(this).closest('form').trigger('submit');
})


$(document).on('focusout', 'textarea[name="order_note"]', function (event) {
    let _url = $(this).closest('form').attr('data-action');
    $(this).closest('form').attr('action', _url + '/' + 'note');
    $(this).closest('form').trigger('submit');
})


window.orderLogAPI = function () {
    let _orderTbody = $(".log-tbody");
    let _logs = "";
    $.ajax({
        method: "GET",
        url: $(_orderTbody).attr('data-action'),
        success: function (response) {
            $.each(response, function (index, item) {
                _logs +=
                    `
                    <tr>
                        <td>
                            ${item.type}
                        </td>
                        <td>
                            ${item.admin_user_id}
                        </td>
                        <td>
                            ${item.message}
                        </td>
                        <td>
                            ${item.date}
                        </td>
                    </tr>
                `
            });
            console.log("items; ", _logs);
            $(_orderTbody).empty().html(_logs);

        }
    })
}
