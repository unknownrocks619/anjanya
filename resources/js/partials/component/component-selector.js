import Masonry from "masonry-layout";
import tinymce from "tinymce";

$(document).on('click', '.select-component', function (event) {
    event.preventDefault();
    let _inputValue = $(this).closest('div.component-div').find("input[name='web_component[]']").val();
    if ($(this).hasClass('selected') ) {
        $(this).removeClass('selected');
        $(this).closest('div.component-div').removeClass('bg-success').addClass('bg-light');
        $(this).closest('div.component-div').find("input[type=checkbox]").removeAttr('checked');
    } else {
        $(this).closest('div.component-div').addClass('bg-success').removeClass('bg-light');
        $(this).addClass('selected');
        $(this).closest('div.component-div').find('input[type=checkbox]').attr('checked',true);
    }
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


export default class CommonComponentSelector {

    constructor(container, options=null) {
        this.container = $(container)

        if ( options !== null) {
            this.options = options;
        }

        this.component = $(container).data('modal');
        this.#init();
    }

    #init() {
        this.fetchAndUpdateView(this.container);
    }
    fetchAndUpdate(elm,name='componentView',params={}) {
        let _this = this;
        this.#setLoading(true);

        return this.#fetchView(name,params)
            .then(function(view) {
                elm.html(view)
                _this.#setLoading(false)
            })
    }

    #setLoading(enabled) {
        if (enabled) {
            $('input,select,textarea,button').prop('disabled',true);
            $('#componentBuilder__main .loader-element').removeClass('d-none');
        } else {
            $('#componentBuilder__main .loader-element').removeClass('d-none');
            $('input,select,textarea,button').prop('disabled',false);
        }
    }

    #fetchView(url = "" , name='componentView', params= {}) {
        return axios.get(url,{params : params})
            .then(function(response){
                if (response.status === 200) {
                    return response.data;
                }
            })
    }

    fetchAndUpdateView(elm,name='componentView',params={}) {
        console.log('elm: ',elm)
    }

    selectComponent(elm) {
        this.#setLoading(true);
        let _this = this;
        this.#fetchView($(elm).data('url'))
            .then(function (view) {
                $(_this.container).find('.component-builder-loader').html(view.params.view)
                if ($(_this.container).find('button.action-button').length) {
                    // let's make few adjustment.
                    if ($(_this.container).find('input[name="_source-option-id"]').length) {
                        $(_this.container).find('button.action-button').html('Save Component')
                    }
                }
                _this.#setLoading(false);
            });
    }

    saveNewComponent() {
        this.#setLoading(true);
        let _this = this;
        let componentFields = $(this.container).find('.component_field');
        const _form = new FormData();
        let _component_name = $(this.container).find('input[name="_component_name"]').val();
        $.each (componentFields, function (index,field) {
            if (! $(field).val() ) {
                _form.append($(field).attr('name'),$(field).text());
            } else if($(field).is(':checkbox')) {
                console.log($(field));
                if ($(field).is(":checked")) {
                    _form.append($(field).attr('name'), $(field).val());
                }
            } else {
                if ($(field).is('textarea') && $(field).hasClass('tiny-mce') ) {
                    console.log('ddd',tinyMCE.get($(field).attr('id')).getContent());
                    _form.append($(field).attr('name'), tinyMCE.get($(field).attr('id')).getContent())
                }
                _form.append($(field).attr('name'),$(field).val());
            }
        })
        axios.post('/admin/components/common/build-save/'+_component_name,_form)
            .then(function(response){
               let _response = response.data;
               window.handleOKResponse(_response);
            }).catch(function(response) {
                _this.#setLoading(false);
                window.handleBadResponse(response.data);
        });
    }

    updateComponent() {
        this.#setLoading(true);
        let _this = this;
        let componentFields = $(this.container).find('.component_field');
        const _form = new FormData();
        let _component_ID = $(this.container).find('input[name="_source-option-id"]').val();
        $.each (componentFields, function (index,field) {
            if (! $(field).val() ) {
                if ($(field).is('textarea') && $(field).hasClass('tiny-mce')) {
                    console.log(tinyMCE.get($(field).attr('id')).getContent());
                    _form.append($(field).attr('name'),tinyMCE.get($(field).attr('id')).getContent());
                } else {
                    _form.append($(field).attr('name'),$(field).html());
                }
            }else if($(field).is(':checkbox')) {
                if ($(field).is(":checked")) {
                    _form.append($(field).attr('name'), $(field).val());
                }
            }  else {
                if ($(field).is('textarea') && $(field).hasClass('tiny-mce') ) {
                    _form.append($(field).attr('name'), tinyMCE.get($(field).attr('id')).getContent())
                } else {
                    _form.append($(field).attr('name'),$(field).val());
                }
            }
        })
        axios.post('/admin/components/common/build-update/'+_component_ID,_form)
            .then(function(response){
                let _response = response.data;
                window.handleOKResponse(_response);
            }).catch(function(response) {
                _this.#setLoading(false);
               let _response =response.data;
               window.handleBadResponse(_response);
        });
    }

    removeComponent(elm) {
        this.#setLoading(true);
        let _this = this;
        let _componentID = $(elm).attr('data-component-id');
        let _webComponentID = $(this.container).find('input[name="_source-option-id"]').val();
        axios.post('/admin/components/common/delete-component/'+_webComponentID+'/'+_componentID)
            .then(function(response) {
                let _response = response.data;
                window.handleOKResponse(_response);
            })
    }
}
if ($('#commonComponentBuilder').length) {
    window.CB = new CommonComponentSelector($('#commonComponentBuilder'))
}
