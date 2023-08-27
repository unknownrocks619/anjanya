window.image_slider = function (params) {
    $("#slider-file-preview").empty().html(params.view);
}

$(document).on('click','.image-preview-edit', function (event) {
    event.preventDefault();

    let _slider =`<div class='d-flex justify-content-center align-items-center'><img src="/loading.gif" class="img-fluid w-25" /></div>`;
    $('#slider-file-preview').empty().html(_slider);
    let _this = this;
    axios.get($(_this).attr('data-endpoint'))
        .then(function(response) {
            window.image_slider(response.data.params);
        })
})
