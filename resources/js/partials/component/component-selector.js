import Masonry from "masonry-layout";

$(document).on('click', '.select-component', function (event) {
    event.preventDefault();
    $('.select-component').removeClass('selected');
    $(".component-div").removeClass('bg-success');

    $(this).closest('div.component-div').addClass('bg-success').removeClass('bg-light');
    $(this).addClass('selected');
    $(".selected-component-input").val($(this).data('key'));
})

window.componentRenderElement = function (params) {
    let _selectedComponent = `<input type='hidden' name='component' value='${params.current_component}' />`;
    $('#component-render').find('div').remove();
    $('#component-render').find('input[name="component"]').remove();
    $("#component-render").append(_selectedComponent);
    $("#component-render").append(params.view);
    window.setupTinyMce();

    if ($("#component-render").find('select').length) {
        $.each($("#component-render").find('select'), function (index, element) {
            window.ajaxReinitalize(element);
        })
    }
}



$(document).on('click', '.clone-component', function (event) {
    event.preventDefault();
    let _toCloneElement = $(this).closest('div.clone_element');
    let _clone = $(_toCloneElement).clone();
    $(_clone).removeClass('clone_element');
    $(_clone).find('.clone-component').addClass('d-none');
    $(_clone).find('.remove-clone-component').removeClass('d-none');

    $(_toCloneElement).parent('div').append(_clone);
});

$(document).on('click', '.remove-clone-component', function (event) {
    event.preventDefault();
    $(this).closest('div.row').fadeOut('fast').remove();
})


if ($('.mansonry-design-component-preview-wrapper').length) {
    var mansry = new Masonry('.mansonry-design-component-preview')
}

if ($('.component-position-save').length) {


    $(document).on('click', '.component-position-save', function (event) {
        event.preventDefault();

        let paramsElement = $(this).closest('tr').find('select');
        let _selectedVal = $(paramsElement).find(":selected");
        let values = [];
        $.each(_selectedVal, function (index, ele) {
            values.push($(ele).val());
        });

        $.ajax({
            method: "POST",
            url: $(paramsElement).attr('data-action'),
            data: { 'widgets': values },
            success: function (response) {
                handleOKResponse(response);
            },
            error: function (response) {
                handleBadResponse(response);
            }
        })

    })

}



$(document).on('click', '.clone_accordian_component', function (event) {
    event.preventDefault();
    let _toCloneElement = $(this).closest('div.first_accordian');
    let _clone = $(_toCloneElement).clone();
    $(_clone).removeClass('first_accordian');
    $(_clone).find('.tox-tinymce').remove();
    $(_clone).find('textarea').fadeIn('fast').attr('id', 'tinyID_' + Math.random().toString(36).slice(-8));
    $(_toCloneElement).parent('div').append(_clone);
    $(_clone).find('.clone_accordian_component').addClass('d-none');
    $(_clone).find('.remove_accordian_component').removeClass('d-none');
    window.setupTinyMce();
});

$(document).on('click', '.remove_accordian_component', function (event) {
    event.preventDefault();
    $(this).closest('div.row').fadeOut('fast').remove();
})


$(document).on('blur', '.component-name-change', function (event) {
    event.preventDefault();
    let _this = this;
    let _params = {
        'name': $(this).val(),
        'active_component_status': $(this).closest('div').find('input[name="active_component_status"]').is(':checked') ? 1 : 0
    }
    $(this).attr('disabled', true);
    $.ajax({
        method: "POST",
        data: _params,
        url: $(this).attr('data-action'),
        success: function (response) {
            handleOKResponse(response);
            $(_this).attr('disabled', false);
        },
        error: function (response) {
            handleBadResponse(response);
            $(_this).attr('disabled', false);
        }
    })
})
$(document).on('click', 'input[name="active_component_status"]', function (event) {
    let _this = this;
    let _params = {
        'name': $(this).closest('div.row').find('.component-name-change').val(),
        'active_component_status': $(this).is(':checked') ? 1 : 0
    }
    $(this).attr('disabled', true);
    $.ajax({
        method: "POST",
        data: _params,
        url: $(this).closest('div.row').find('.component-name-change').attr('data-action'),
        success: function (response) {
            handleOKResponse(response);
            $(_this).attr('disabled', false);
        },
        error: function (response) {
            handleBadResponse(response);
            $(_this).attr('disabled', false);
        }
    })
})


$(document).on('change', '.component_card_media_type', function (event) {
    let _selectedValue = $(this).find(":selected").val();
    let _closestParent = $(this).closest('div.row');

    if (!_selectedValue) {
        $(_closestParent).find(".component_card_image_selector").addClass('d-none');
        $(_closestParent).find('.component_card_video_selector').addClass('d-none');
    }
    console.log('selected vlue: ', _selectedValue)
    console.log('clsoest element: ', _closestParent);

    if (_selectedValue == 'video') {
        $(_closestParent).find('.component_card_video_selector').removeClass('d-none');
        $(_closestParent).find(".component_card_image_selector").addClass('d-none');
    }

    if (_selectedValue == 'image') {
        $(_closestParent).find(".component_card_image_selector").removeClass('d-none');
        $(_closestParent).find(".component_card_video_selector").addClass('d-none');
    }
})


$(document).on('change', '.project-list-type-selector', function (event) {
    event.preventDefault();
    let _currentValue = $(this).find(":selected").val();

    if (!$('.' + _currentValue).length) {
        return;
    }
    $('.type_selector_div').fadeOut('fast', function () {
        $(this).addClass('d-none');
    })

    $("." + _currentValue).fadeIn('fast', function () {
        $(this).removeClass('d-none');
    })
})


window.componentContactPreview = function (ele) {

    let _preivewElementClass = $(ele).attr('name') + '_preview';

    let _targetEle = $('.contact-preview-sample-area').find('.' + _preivewElementClass);

    if ($(_targetEle).is('div')) {
        $(_targetEle).empty().html($(ele).val());
    }

    if ($(_targetEle).is('input') || $(_targetEle).is('textarea')) {
        $(_targetEle).attr('placeholder', $(ele).val());
    }
    if ($(_targetEle).is('button')) {
        $(_targetEle).text($(ele).val());
    }
}
