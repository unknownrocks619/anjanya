if ($(".lession_video_type").length) {

    $(document).on('click', '.lession_video_type', function (event) {
        let _isChecked = $(this).is(':checked');
        let _enable_button = $(this).attr('name');


        if (_enable_button == 'enable_vimeo_video') {
            if (_isChecked == true) {
                $(".lession_vimeo_link").removeClass('d-none')
            } else {
                $(".lession_vimeo_link").addClass('d-none')
            }
        }


        if (_enable_button == 'enable_youtube_video') {
            if (_isChecked == true) {
                $(".lession_youtube_link").removeClass('d-none')
            } else {
                $(".lession_youtube_link").addClass('d-none')
            }
        }
        if (_enable_button == 'enable_preview') {
            if (_isChecked == true) {
                $(".preview_link").removeClass('d-none')
            } else {
                $(".preview_link").addClass('d-none')
            }
        }

    });

}


$(document).on('change', 'select.lession-course-selection', function (event) {
    let _seletedCourse = $(this).find(':selected').val();
    let _baseUrl = $(this).attr('data-action');

    let _buildUrl = _baseUrl + '/' + $(this).find(':selected').val();

    if ($(this).attr('data-chapter')) {
        _buildUrl += "/" + $(this).attr('data-chapter');
    }


    let _selectElement = $("<select>");
    _selectElement.addClass('form-control', 'chapter-ajax')
    _selectElement.attr('name', 'chapter');
    $(this).find('.remove-after-click').remove().trigger('change');
    $.ajax({
        type: "get",
        url: _buildUrl,
        success: function (response) {
            if (response.count_filtered >= 1) {

                $.each(response.results, function (index, item) {
                    let optionElement = $('<option>');
                    optionElement.attr('value', item.id);
                    optionElement.text(item.text);
                    _selectElement.append(optionElement);
                })

                $(".chapter-group").find('select').remove();
                $(".chapter-group").find('span').remove();
                $(".chapter-group").append(_selectElement);
                window.ajaxReinitalize(_selectElement);
            }
        }
    })

});
