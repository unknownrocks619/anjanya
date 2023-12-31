
window.ajaxReinitalize = function (element, options = {}) {

    if (!$(element).hasClass('no-select-2')) {

        if (!$(element).hasClass('ajax-select-2')) {

            $(element).select2(options);

        } else {
            let action = $(element).data('action');
            options.ajax = {
                url: action,
                dataType: 'json',
                type: 'GET',
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                },
                results: function (data) {
                    console.log('data: ', data);
                    return { results: data };
                }
            }
            $(element).select2(options)

        }
    }
}

if ($('select').length) {
    $.each($('select'), function (index, element) {
        if (!$(element).hasClass('no-select-2')) {
            window.ajaxReinitalize(element);
        }
    });
}

$(document).on('change', '.update-from-select', function (event) {
    event.preventDefault();
    let url = $(this).data('action');
    let params = {
        'record': $(this).find(':selected').val()
    }
    let method = $(this).data('method') ?? 'get';

    $.ajax({
        method: method,
        url: url,
        data: params,
        success: function (response) {
            window.handleOKResponse(response);
        },
        erorr: function (response) {
            window.handleBADResponse(response);
        }
    })
})

$(document).on('change', 'select[name="slider_layout"]', function (event) {
    event.preventDefault();
    let _sliderValue = $(this).find(':selected').val();
    $(".slider_row").addClass('d-none');

    if ($('.' + _sliderValue).length) {
        $('.' + _sliderValue).removeClass('d-none');
    }
})
