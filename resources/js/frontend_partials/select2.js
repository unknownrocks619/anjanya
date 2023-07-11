
window.ajaxReinitalize = function (element, options = {}) {
    if (!$(element).hasClass('no-select-2')) {

        if (!$(element).hasClass('ajax-select-2')) {

            $(element).select2();

        } else {
            let action = $(element).data('action');
            console.log('action: ', action)
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
