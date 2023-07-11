class Products {


    _orders = [];
    _total = 0;
    _items = 0;

    setOrders(order) {
        this._orders.push(order)
    }

    getOrders(orderIndex) {
        if (this._orders[orderIndex] !== undefined) {
            return this._orders[orderIndex];
        }
    }

    removeOrders(orderIndex) {

    }
}

function orderProcess() {
    let _quantity = parseInt($(".order_qty").attr('data-qty'));

    let _tip = parseInt($(".tip_text").attr('data-amount'));
    let _extra_donation = parseFloat($('.donation_text').attr('data-amount'));

    let _totalField = parseFloat($('.total_field').attr('data-amount'));
    let _processingFee = parseFloat($('.processing_fee').attr('data-amount'));
    let _itemPrice = parseFloat($('.orderlineDetail').attr('data-orderline-pricing'));
    // calculate extra donation
    _processingFee = (((_quantity * _itemPrice) * 2.9) / 100) + 0.30;
    $('.processing_fee').attr('data-amount', _processingFee).text('AU $' + _processingFee.toFixed(2));

    _totalField = _processingFee + _extra_donation + (_quantity * _itemPrice) + _tip;
    $('.total_field').attr('data-amount', _totalField).text('AU $' + _totalField);

    $('.extra_donation').attr('data-amount', _extra_donation).text('$ ' + _extra_donation);
    $('.tip_amount').attr('data-amount', _tip).text('$ ' + _tip);


    let body = {
        'quantity': _quantity,
        'donation': _extra_donation,
        'tip': _tip
    }

    $.ajax({
        method: "POST",
        url: "/orders/update-order/" + $('.orderlineDetail').attr('data-order-index'),
        data: body,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    })
}

$(document).on('click', '.order_plus', function (event) {
    event.preventDefault();

    let _current_value = $(".order_qty").attr('data-qty');

    _current_value = parseFloat(_current_value) + 1;
    $(".order_qty").attr('data-qty', _current_value);
    $(".order_qty").text(_current_value);
    orderProcess();
})
$(document).on('click', '.order_minus', function (event) {
    event.preventDefault();
    let _current_value = $(".order_qty").attr('data-qty');

    if (_current_value <= 1) {
        return;
    }

    _current_value = parseFloat(_current_value) - 1;
    $(".order_qty").attr('data-qty', _current_value);
    $(".order_qty").text(_current_value);
    orderProcess();
})

$(document).on('click', '.donation_plus', function (event) {
    event.preventDefault();

    let _current_value = $(".donation_text").attr('data-amount');

    _current_value = parseFloat(_current_value) + 1;
    $(".donation_text").attr('data-amount', _current_value).text('$ ' + _current_value);
    orderProcess();
})

$(document).on('click', '.donation_minus', function (event) {
    event.preventDefault();
    let _current_value = $(".donation_text").attr('data-amount');;

    if (_current_value <= 0) {
        return;
    }
    _current_value = parseFloat(_current_value) - 1;
    $(".donation_text").attr('data-amount', _current_value).text('$ ' + _current_value);
    orderProcess();
})


$(document).on('click', '.donation_button', function (event) {
    event.preventDefault();
    $(".donation_text").attr('data-amount', $(this).attr('data-amount')).text('$ ' + $(this).attr('data-amount'));
    orderProcess();
})


$(document).on('click', '.tip_plus', function (event) {
    event.preventDefault();

    let _current_value = $(".tip_text").attr('data-amount');
    _current_value = parseFloat(_current_value) + 1;
    $(".tip_text").attr('data-amount', _current_value).text('$ ' + _current_value);
    orderProcess();
})

$(document).on('click', '.tip_minus', function (event) {
    event.preventDefault();
    let _current_value = $(".tip_text").attr('data-amount');;

    if (_current_value <= 0) {
        return;
    }
    _current_value = parseFloat(_current_value) - 1;
    $(".tip_text").attr('data-amount', _current_value).text('$ ' + _current_value);
    orderProcess();
})


$(document).on('click', '.tip_button', function (event) {
    event.preventDefault();
    $(".tip_text").attr('data-amount', $(this).attr('data-amount')).text('$ ' + $(this).attr('data-amount'));
    orderProcess();
})

$(document).on('click', '.select-bundle-project', function (event) {
    let _modal = window.modalElement;
    let _this = this;
    let _parentWrapper = `<div class="row mt-4 me-5"></div>`;
    $.ajax({
        method: 'POST',
        url: $(_this).attr('data-action'),
        success: function (response) {
            console.log('modal', $(_modal))
            $('#dynamic_js_modal').find('.modal-body').empty().html(response);
            loadProject();
        }
    })
})

window.loadProject = function () {
    let _element = $('.project-listing-loading');
    let _dataElement = $('#dynamic_js_modal').find('.modal-body');
    console.log('element', _element);
    let _items = '';
    $.ajax({
        method: 'GET',
        url: $(_element).attr('data-action'),
        success: function (response) {
            $.each(response.params.project, function (index, item) {
                console.log('item', item);
                _items += displayProjectList(item, $(_dataElement).attr('data-body'))
            })
            _items = `<div class="row mt-4 me-5">${_items}</div>`;
            $(".searchable-container").empty().html(_items);
        }
    })
}

function displayProjectList(item, data = {}) {
    let _currentModal = window.modalElement;
    let _data = JSON.parse(data);
    _data.project = item._p_id;
    data = JSON.stringify(_data);
    let _renderElement = `<div class="col-md-4 items">
    <div class="card my-3" style="box-shadow: none">
        <img src="${item.image}" class="img-fluid responsive-img" />
        <h1 class="mt-3 px-3 text-cemter"
            style="max-height:40px; overflow:hidden ;font-size:16px;color:#242254;line-height:1.3em;text-decoration:none;font-family:'Inter';font-weight:600">
            ${item.project_title}
        </h1>
        <div class="mt-1  text-center"
            style="font-size:16px; color:#242254;font-family:'Inter'">
            ${item.org_name}
        </div>
        <div class="card-footer bg-white mt-3 border-0">
            <button
                    data-project="${item._p_id}"
                    data-body='${data}'
                    data-method="post"
                    data-bs-target="#dynamic_js_modal"
                    data-action="/orders/create"
                 type="button" data-method='post' class="w-100  rounded-3 py-2 ajax-modal recommend-btn"
                style="background:#b81242;border:none !important">
                Select Project
            </button>
        </div>
    </div>
</div>`;
    return _renderElement;
}


$(document).on('click', '.signout-as-guest', function (event) {

    event.preventDefault();
    let _this = this;



    $(".login_user").fadeOut('medium', function () {
        $('.already-member-button').fadeIn();
        $(".checkout_as_guest").fadeIn();
        $(_this).fadeOut()
    })
});

$(document).on('click', '.already-member-button', function (event) {

    event.preventDefault();
    let _this = this;

    $(".checkout_as_guest").fadeOut('medium', function () {
        $('.signout-as-guest').fadeIn();
        $(".login_user").fadeIn();
        $(_this).fadeOut()
    })
});
