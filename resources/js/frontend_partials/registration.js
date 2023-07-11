import './dropzone';

const REGISTRATION_COUNTER = {
    'step_one': {
        'step': 1,
    },
    'step_two': {
        'step': 2,
    },
    'step_three': {
        'step': 3,
    },
    'step_four': {
        'step': 4,

    },
    'step_five': {
        'step': 5
    },
    'step_six': {
        'step': 6
    },
    'step_seven': {
        'step': 7
    }
}
window.CURRENT_STEP = 0;

$(document).on('click', '.gender-select', function (e) {
    e.preventDefault();

    let _parent = $(this).closest('.gender-mark');

    $('.gender-mark').find("input[type='checkbox']").prop('checked', false);
    $('.gender-mark').find("button.gender-select").removeClass('btn-success').addClass('btn-primary');
    $('.gender-mark').find('button>i').addClass('d-none')
    $(_parent).find('input[type="checkbox"]').prop('checked', true);
    $(_parent).find('button.gender-select').addClass('btn-success').removeClass('btn-primary');
    $(_parent).find('button>i').removeClass('d-none');
})


$(document).on('click', '.js-address-toggle', function (e) {
    e.preventDefault();
    let _parent = $(this).closest('div');

    if ($(_parent).find('input[type="checkbox"]').is(':checked')) {
        $('.temporary_address').removeClass('d-none');
        $(_parent).find('input[type="checkbox"]').prop('checked', false);
        $(_parent).find('button>i').addClass('d-none');

        $(this).addClass('btn-danger').removeClass('btn-success').removeClass('text-white');
    } else {
        $('.temporary_address').addClass('d-none');
        $(_parent).find('input[type="checkbox"]').prop('checked', true);
        $(_parent).find('button>i').removeClass('d-none');
        $(this).addClass('btn-success').removeClass('btn-danger').addClass('text-white');
    }

})

$(document).on('click', '.copy_guardian_info', function (event) {
    event.preventDefault();
    let _first_name = $('input[name="first_name_of_parent"]').val();
    let _last_name = $('input[name="last_name_of_parent"]').val();
    let _full_name = _first_name + ' ' + _last_name;
    let _relationship = $('input[name="parent_relationship"]').val();
    let _phone_number = $('input[name="phone_number_of_parent"]').val();

    $("input[name='emergency_contact_full_name']").val(_full_name);
    $("input[name='emergency_contact_number']").val(_phone_number);
    $('input[name="relation_to_emergency_contact"]').val(_relationship)
})

$(document).on('change', 'select[name="perma_country"]', function (event) {
    event.preventDefault();
    let _selectedID = $(this).find(':selected').val();
    let _permaState = $('select[name="perma_state"]');
    let _basePath = $(_permaState).attr('data-base');
    let _parentID = $(_permaState).attr('data-parent-id');

    if (!_selectedID) {
        $(_permaState).removeAttr('data-endpoint');

    }

    let _removeChart = _basePath.replace('/' + _parentID, '/' + _selectedID);

    $(_permaState).attr('data-parent-id', _selectedID);
    $(_permaState).attr('data-action', _removeChart);
    $(_permaState).attr('data-base', _removeChart);
    $(_permaState).find('option').remove();
    $(_permaState).select2('destroy');
    getCities(_removeChart, function (response) {
        if (response.count_filtered >= 1) {

            $.each(response.results, function (index, item) {
                let optionElement = $('<option>');
                optionElement.attr('value', item.id);
                optionElement.text(item.text);
                _permaState.append(optionElement);
            })
        }
    })
    window.ajaxReinitalize(_permaState);
})

$(document).on('change', 'select[name="temp_country"]', function (event) {
    event.preventDefault();
    let _selectedID = $(this).find(':selected').val();
    let _tempState = $('select[name="temp_state"]');
    let _basePath = $(_tempState).attr('data-base');
    let _parentID = $(_tempState).attr('data-parent-id');

    if (!_selectedID) {
        $(_tempState).removeAttr('data-endpoint');

    }

    let _removeChart = _basePath.replace('/' + _parentID, '/' + _selectedID);

    $(_tempState).attr('data-parent-id', _selectedID);
    $(_tempState).attr('data-action', _removeChart);
    $(_tempState).attr('data-base', _removeChart);
    $(_tempState).select2('destroy');
    $(_tempState).find('option').remove();
    getCities(_removeChart, function (response) {
        if (response.count_filtered >= 1) {

            $.each(response.results, function (index, item) {
                let optionElement = $('<option>');
                optionElement.attr('value', item.id);
                optionElement.text(item.text);
                _tempState.append(optionElement);
            })
        }
    })
    window.ajaxReinitalize(_tempState);

})

$(document).on('click', '.sadhak_info', function (event) {
    event.preventDefault();
    $('.sadhak_info').removeClass('btn-success').removeClass('text-white');
    $('.sadhak_info').find('button>i').addClass('d-none');
    $(this).closest('.parent_sadhak_info').find('input').prop('checked', false);
    $(this).addClass('btn-success text-white');
    $(this).find('i').removeClass('d-none');

    if ($(this).data('value') == false) {
        $(this).closest('.parent_sadhak_info').find('input').prop('checked', false);
    } else {
        $(this).closest('.parent_sadhak_info').find('input').prop('checked', true);
    }

})


$(document).on('click', '.dikshya_info', function (event) {
    event.preventDefault();

    if ($(this).data('value') == 'none') {

        if (!$(this).hasClass('btn-success')) {
            $(".dikshya_info").removeClass('btn-success').removeClass('text-white');
            $(".dikshya_info_checkbox").prop('checked', false);
            $('.dikshit_name').fadeOut();
            $(this).find('i').removeClass('d-none');
            $.each($('.dikshya_info'), function (index, elm) {
                if ($(elm).data('value') != 'none') {
                    $(elm).find('i').addClass('d-none');
                    $('.' + $(elm).data('value')).fadeOut('fast');
                }
            });
            $(this).addClass('btn-success').addClass('text-white');

        } else {
            $(this).removeClass('btn-success').removeClass('text-white');
            $(this).find('i').addClass('d-none');
        }

        return;
    }

    $(".dikshya_info[data-value='none']").removeClass('btn-success').removeClass('text-white');
    $(".dikshya_info[data-value='none']").find('i').addClass('d-none');

    if ($(this).hasClass('btn-success')) {
        $(this).removeClass('btn-success').removeClass('text-white');
        $(this).find('i').addClass('d-none');
        $('input[name="' + $(this).data('value') + '"]').prop('checked', false);
        $('.' + $(this).data('value')).fadeOut('fast');
    } else {
        $(this).addClass('btn-success').addClass('text-white');
        $('input[name="' + $(this).data('value') + '"]').prop('checked', true);
        $('.' + $(this).data('value')).fadeIn('fast');
        $(this).find("i").removeClass('d-none');
    }

    if (!$('button').is('.dikshya_info.btn-success')) {
        $('.dikshit_name').fadeOut();
    } else {
        $('.dikshit_name').fadeIn();
    }
})

function getCities(url, callback) {
    $.ajax({
        method: 'get',
        url: url,
        success: function (response) {
            callback(response)
        }
    })
}

function registrataionSidebarActive() {
    let _stepElement = $('.progress-bar').find('li');
    $(_stepElement).removeClass('active');
    let _stepNumber = REGISTRATION_COUNTER[window.CURRENT_STEP];

    $.each(_stepElement, function (liIndex, liElem) {
        console.log(_stepNumber.step);
        if ($(liElem).data('step') <= _stepNumber.step) {

            $(liElem).addClass('active');
        }

    });
}


window.registrationNext = function (params) {
    window.CURRENT_STEP = params.current_step;
    $('.main_registration_content').attr('data-current-step', params.current_step);
    $(".main_registration_content").empty().html(params.view);
    registrataionSidebarActive();
    // window.history.pushState(null, '', params.path);
    initializeDropZone();
}

if ($('.main_registration_content').length) {
    window.CURRENT_STEP = $(".main_registration_content").attr('data-current-step');
    $(function () {
        registrataionSidebarActive();
        initializeDropZone();
    })

}

function initializeDropZone() {
    if ($('.dz-area').length) {
        $.each($('.dz-area'), function (index, element) {
            window.frontendDropzone(element);
        });
    }
}

window.identityPhoto = function (params) {
    console.log('params:', params);
    $("input[name='profile']").val(params.info);
}

window.verificationPhoto = function (params) {
    $('input[name="verification_card"]').val(params.info);
}

$(document).on('click', '.step-back', function (event) {
    event.preventDefault();
    $.ajax({
        method: "GET",
        url: $(this).data('url'),
        success: function (response) {
            registrationNext(response.params)
        }
    })
})

$(document).on('change', '#education_level', function (event) {
    event.preventDefault();
    let _currentEducation = $(this).find(":selected").val();
    if (_currentEducation != 'primary_school' && _currentEducation != 'middle_school') {
        $("#education_major").closest('div.form-group').show();
    } else {
        $("#education_major").closest('div.form-group').hide();
    }
})

$(document).on('click', '.terms_button', function (event) {
    event.preventDefault();
    if ($(this).hasClass('btn-success')) {
        $(this).find('i').addClass('d-none');
        $(this).closest('div.form-group').find('input[type="checkbox"]').prop('checked', false);
        $(this).removeClass('btn-success').removeClass('text-white');
    } else {
        $(this).find('i').removeClass('d-none');
        $(this).closest('div.form-group').find('input[type="checkbox"]').prop('checked', true);
        $(this).addClass('btn-success').addClass('text-white');
    }
})
