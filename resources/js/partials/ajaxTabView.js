$(document).on('click','.ajax-view-tab', function(e) {
    
    let _this = this;

    if ( $('.ajax-view-tab').hasClass('active') &&  !$(_this).hasClass('loaded')) {
        let _data = $($(this).attr('data-bs-target')).find('.ajax-loader-view');
        // get options.
        let _body = {
            'params' : _data.attr('data-params')
        }

        axios.post('/admin/users/ajax-load/tab-view/'+$(_data).attr('data-source')+'/'+$(_data).attr('data-view'),_body)
            .then(function(response){
                $(_data).parent().html(response.data.params.view);
                $(_this).addClass('loaded');
            }).catch(function(error) {
                $(_data).parent().html('Failed to load ajax content.');
            });
    }

});

window.loadAjaxView = function () {
    $('.ajax-view-tab.active').trigger('click');
}

$(document).on('click','.tab-view', function(e) {
    $('.tab-view').removeClass('btn-light').addClass('btn-primary');
    $(this).addClass('btn-light').removeClass('btn-primary')
});

window.loadAjaxView();