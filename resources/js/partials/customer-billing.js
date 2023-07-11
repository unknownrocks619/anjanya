import axios from 'axios';
import $ from 'jquery'
import CustomerRecord from './blueprints/CustomerClass';

window.customerOrderRecord = new CustomerRecord;

$(() => {
    if ($('.customer-billing').length) {

        // $(document).on('keydown', function (event) {
        //     if (event.which === 78) {
        //         // change layout options.
        //     }
        // });
    }

    if ($('.ajax-image').length && $('.ajax-image').children('div.loader-box').length) {

        $.each($('.ajax-image'), function (index, element) {
            let imageElement = $(element).find('img');

            if ($(imageElement).length && $(imageElement).data('src')) {
                axios.get($(imageElement).data('src'), {
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                }).then((response) => {
                    $(element).empty();
                    $(imageElement).attr('src', response.data).removeClass('d-none')
                    $(element).append(imageElement);
                }).catch((response) => {
                    console.log("error: ");

                })
            }
        })
    }

    $(document).on('click', '.billing-new-customer', function (event) {
        event.preventDefault();
        let _this = this;
        $(_this).prop('disabled', true);
        axios.get($(this).data('action')).then(function (response) {
            $('.billing-customer').html(response.data);
        }).catch(function (response) {
            $(_this).prop('disabled', false);
            window.messageBox(false, 'Unable to load form.');
        });
    })

    $(document).on('click', '.old-customer-detail', function (event) {
        event.preventDefault();
        let _this = this;
        let dataValue = $(_this).data('search');
        let data = {};
        if (dataValue == 'form') {
            data.customer = $(this).closest('form').serializeArray();
        }

        if (dataValue && dataValue != 'form') {
            let closestMatchingDIV = $(_this).closest('div.billing-loader');
            let selectElement = $(closestMatchingDIV).find('.' + dataValue).find(':selected').val();
            data.customer = selectElement
        }

        axios.post($(_this).data('action'), data).then(function (response) {
            $('.billing-customer').html(response.data);
            let _customer_detail = $('.billing-customer').find('#customerDetail');
            if (_customer_detail.length) {
                window.customerOrderRecord.setCustomerRecord(JSON.parse($(_customer_detail).attr('data-customer')));
            }
        }).catch(function (response) {
            console.log('error catch: ', response);
        })


        $(".billing-new-customer").prop('disabled', true)
    });

})


window.billingPostCustomer = function (params) {
    $('.billing-customer').html(params.renderHTML);
}
