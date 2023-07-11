import axios from "axios";

$(document).on('click', 'button.newsletter-button', function (event) {
    let _this = this;
    event.preventDefault();
    $(this).prop('disabled', true);

    if ($('#newsletter-message-div').length) {
        $('#newsletter-message-div').remove();
    }

    let _subscriptionEmail = $(this).closest('div.widget-content').find('input[name="email"]');
    $(_subscriptionEmail).prop('disabled', true);
    console.log('_subscription email> ', _subscriptionEmail);
    axios.post('/newsletter/store', { email: _subscriptionEmail.val() })
        .then(function (response) {
            let _returnData = response.data
            if (_returnData.state == true) {
                $(_subscriptionEmail).val('');

                let _row = document.createElement('div');
                _row.setAttribute('class', 'row')
                _row.setAttribute('id', 'newsletter-message-div')

                let _col = document.createElement('div');
                _col.setAttribute('class', 'col alert alert-success')
                _col.innerHTML = _returnData.msg;

                _row.appendChild(_col);
                $(_this).closest('div.widget-content').prepend(_row);

            }
            $(_subscriptionEmail).removeAttr('disabled');
            $(_this).removeAttr('disabled');
        })
        .catch(function (errorResponse) {
            $(_this).removeAttr('disabled', false);
            $(_subscriptionEmail).removeAttr('disabled', false);
            let _returnData = errorResponse.response
            console.log(errorResponse);
            window.handleBadResponse(_returnData);
        })
})
