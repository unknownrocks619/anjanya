import AjaxRequest from "./Ajax";
import Swal from 'sweetalert2';

export default class OrderLine {
    _customer;
    _Services;
    _options;
    _orderLine = [];
    _studio;
    _orders;

    constructor() {
        this._orders = {
            totalOrderItem: 0,
            grossTotal: 0,
            discountPercentage: 0,
            discountAmount: 0,
            taxPercentage: 0,
            taxAmount: 0,
            netTotal: 0
        }
    }

    setStudio(studioRecord) {
        this._studio = studioRecord;
    }

    setCustomer(customerRecord) {
        this._customer = customerRecord;
    }

    setService() {

    }

    setOptions() {

    }

    createOrderline(records) {
        this._orderLine.push(records);
    }

    orderLineBuilder() {
        let _html = '';

        if (!this._orderLine.length) {
            _html += `
            <div class="row">
                <div class="col-md-12 lister-parent">
                    <div class="row lister-item">
                        <div class="col-md-12 text-center">
                            Please Select service and type to calculate.
                        </div>
                    </div>
                </div>
            </div>`
        } else {
            this._orderLine.forEach((element, index) => {
                _html += this.appendOrderLine(element, index);
            });
        }
        $('.lister-parent').empty().html(_html);
        this.orderLineTotal();
    }

    appendOrder(index) {
        console.log('total order Line: ', this._orderLine.length);
        if (this._orderLine.length == 0) {
            let _html = `
            <div class="row lister-item no-item border-bottom py-2">
                <div class="col-md-12 text-center">
                    Please Select service and type to calculate.
                </div>
            </div>`
            $(".lister-parent").append(_html);
        } else {
            $('.no-item').remove();
            $(".lister-parent").append(this.appendOrderLine(this._orderLine[index], index))
        }

        this.orderLineTotal();
    }

    appendOrderLine(element, index) {
        return `
                <div class="row mt-2 border-bottom lister-item text-center" data-order-index="${index}"  data-service-id="${element.service.id_sss}">
                    <div class="col-md-1 text-center">
                        ${index + 1}
                    </div>
                    <div class="col-md-4 text-center">
                        ${element.service.service_name_sss}
                        <br />
                        <span class='badge bg-dark text-white px-3'>Option: ${element.service.selectedOptions.label_ssp}</span>
                    </div>
                    <div class="col-md-1 text-center">
                        <input value="1" type="number" name="qty" id="qty" class="form-control" />
                    </div>
                    <div class='col-md-3 text-center' data-measure-qty="${element.service.selectedOptions.settings_ssp.default_quantity}">
                        ${element.service.selectedOptions.settings_ssp.size} ${element.service.selectedOptions.settings_ssp.unit}
                        <br />
                        <span class='badge bg-info px-2'>Contains:${element.service.selectedOptions.settings_ssp.default_quantity}</span>
                    </div>
                    <div class="col-md-2 text-center price-text" data-service-price='${element.service.selectedOptions.prices_ssp}'>
                        NRs. ${element.service.selectedOptions.prices_ssp}
                    </div>
                    <div class='col-md-1 text-end'>
                        <button class='btn btn-danger btn-sm delete-order'><i class="icofont icofont-ui-delete"></i>
                        </button>
                    </div>
        </div>`
        return _html
    }

    updateQuantity(index, quantity) {
        this._orderLine[index].service.selectedQty = quantity;
        this.orderLineTotal();
    }

    orderLineTotal() {
        var total = 0;
        var totalItem = this._orderLine.length;
        this._orderLine.forEach((element, index) => {
            // get pricing
            let _pricePerservice = parseFloat(element.service.selectedOptions.prices_ssp);
            let _quantity = parseFloat(element.service.selectedQty);
            console.log('pricePerService : ', _pricePerservice);
            console.log('quantity : ', _quantity);
            total += _pricePerservice * _quantity


        })

        let _discountQuantity = $('input[name="discount"]').val() ?? 0;
        let _discountAmount = Math.floor(parseFloat(_discountQuantity) * total / 100);
        let _netAfterDiscountAmount = total - _discountAmount;

        console.log("discount:", _discountQuantity, _discountAmount, _netAfterDiscountAmount);

        let _taxPercentage = $('input[name="tax_amount"]').val() ?? 0;
        let _taxAmount = Math.floor(_taxPercentage * total) / 100;
        let _netAfterTaxAmount = total - _taxAmount;

        console.log("Tax:", _taxPercentage, _taxAmount, _netAfterTaxAmount);

        let _netAmount = (total - _discountAmount) + _taxAmount;

        this._orders = {
            totalOrderItem: totalItem,
            grossTotal: total,
            discountPercentage: _discountQuantity,
            discountAmount: _discountAmount,
            taxPercentage: _taxPercentage,
            taxAmount: _taxAmount,
            netTotal: _netAmount
        }

        $('.bill-item-line').empty().html(totalItem);
        $(".bill-discount-amount").empty().html('NRs.' + _discountAmount);
        $(".gross-bill-amount").empty().html('NRs. ' + total);
        $('.net-total').empty().html('NRs. ' + _netAmount)

    }

    updateOrderLine(index, values) {
        this._orderLine[index] = values;
        this.orderLineTotal();
    }

    checkMinQuantity() {

    }

    removeOrderLine(index) {
        this._orderLine.splice(index, 1);
        this.orderLineTotal();
    }

    getOrderByIndex(index) {
        return this._orderLine[index];
    }

    getCalculationData(itemName) {
        return this._orders[itemName];
    }
}
window.orderLine = new OrderLine;

window.activateSelect2OnServiceSelection = function (params) {
    let element = $('service');
    ajaxReinitalize(element);
}

$(document).on('click', '.service-selection', function (event) {
    event.preventDefault();
    let ajaxRequest = new AjaxRequest;
    ajaxRequest.buildRequest({ url: $(this).attr('action') })
})

$(document).on('change', '.studio-service-selection', function (event) {
    event.preventDefault();
    let _this = this;
    let _selectedValue = $(_this).find(':selected').val();
    let _service_options_element = $('.service-option-element');
    _service_options_element.removeAttr('data-method', 'POST').removeAttr('data-action').addClass('no-select-2').removeClass('ajax-select-2');
    if (_selectedValue == '') {
        return;
    }

    if ($(_service_options_element).hasClass('select2-hidden-accessible')) {
        $(_service_options_element).select2('destroy');
    }
    let url = '/studio/select2/studio/' + parseInt(_selectedValue) + '/services/options';
    // _service_options_element.attr('data-method', 'POST').attr('data-action', url).removeClass('no-select-2').addClass('ajax-select-2');
    $.each(_service_options_element, function (index, element) {
        $(element).attr('data-method', 'POST').attr('data-action', url).removeClass('no-select-2').addClass('ajax-select-2')
        $(element).data('action', url);
        window.ajaxReinitalize(element, { dropdownParent: $(".modal") })
        $(element).val(null).trigger('change');
    })
})

$(document).on('change', '.service-option-element', function (event) {
    event.preventDefault();

    let currentValue = $(this).find(':selected').val();
    let parentDiv = $(this).closest('div.modal');

    if (currentValue == '' || currentValue == undefined) {
        $(parentDiv).find('button.save').prop('disabled', true);
        return;
    }

    console.log('parent div: ', parentDiv);
    $(parentDiv).find('button.save-service').removeAttr('disabled');
})

$(document).on('click', '.save-service', function (event) {
    event.preventDefault();
    let _this = this;
    let _params =
    {
        'service': $('select.studio-service-selection').find(':selected').val(),
        'options': $('select.service-option-element').find(':selected').val()
    };

    if (_params.service == '' || _params.options == '') {
        return;
    }
    let studio = $('#studio-record')
    let studioData = JSON.parse($(studio).attr('data-studio'));
    let _url = '/studio/order-line/order-detail/' + studioData.id_usd

    $.ajax({
        method: 'POST',
        data: _params,
        url: _url,
        success: function (response) {
            let orderLineCount = window.orderLine._orders.totalOrderItem;
            window.orderLine.createOrderline(response);
            window.orderLine.appendOrder(orderLineCount);
        },
    })

    $(".close-service-selection-modal").trigger('click');

})


$(document).on('change', 'input[name="qty"]', function (event) {
    event.preventDefault();
    //
    let _this = this;
    let _parentDiv = $(_this).closest('div.lister-item');

    let _currentOrderIndex = window.orderLine.getOrderByIndex($(_parentDiv).data('order-index'));

    let _servicePrice = parseFloat(_currentOrderIndex.service.selectedOptions.prices_ssp);
    let _priceDiv = $(_parentDiv).find('.price-text');
    let _currentPrice = parseFloat($(_priceDiv).attr('data-service-price'));
    let _finalPrice = _servicePrice * parseFloat($(_this).val());

    window.orderLine.updateQuantity($(_parentDiv).data('order-index'), $(_this).val());

    $(_priceDiv).removeAttr('data-service-price').attr('data-service-price', _finalPrice).empty().html('NRs. ' + _finalPrice);
})


$(document).on('change', 'input[name="tax_amount"]', function (event) {
    event.preventDefault();
    window.orderLine.orderLineTotal();
})

$(document).on('change', 'input[name="discount"]', function (event) {
    event.preventDefault();
    window.orderLine.orderLineTotal();
})

$(document).on('click', 'button.delete-order', function (event) {
    let _this = this;
    Swal.fire({
        title: 'Are You Sure ?',
        text: "You are about to remove selected service from order",
        showConfirmButton: true,
        showCloseButton: true,
        showCancelButton: true
    }).then((action) => {
        if (action.isConfirmed === true) {
            let parentDiv = $(_this).closest('div.lister-item');
            $(parentDiv).fadeOut('fast', function () {
                $(this).remove();
            })
            window.orderLine.removeOrderLine($(parent).data('order-index'));

            if (window.orderLine.getCalculationData('totalOrderItem') == 0) {
                window.orderLine.appendOrder(0);
            }
        }
    })
});

$(document).on('click', 'button.save-order', function (event) {
    event.preventDefault();
    let ordersDetail = window.orderLine._orderLine;
    let customers = window.customerRecord;
    let studioRecord = $("#studio-record").data('studio');
    let calculations = window.orderLine._orders
    $.ajax({
        method: "post",
        data: {
            'orders': ordersDetail,
            'calculations': calculations,
            'customers': customers,
            'studio': studioRecord
        },
        url: "/studio/customer/billing/save",
        success: function (response) {
            window.handleOKResponse(response);
        }
    })

})
