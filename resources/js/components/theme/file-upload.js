(function ($) {
    'use strict';
    $(function () {
        $(document).on('click', '.file-upload-browse', function () {
            var file = $(this).parent().parent().parent().find('.file-upload-default');
            file.trigger('click');
        });
        $(document).on('change', '.file-upload-default', function () {

            var files = $(this)[0].files;

            var placeholder = [];

            for (var i = 0; i < files.length; i++) {
                placeholder.push(files[i].name);
            }

            $(this).parent().find('.form-control').val(
                placeholder.join(', ')
            );

            $(this).parent().find('.upload-image').removeAttr('hidden')
        });

        $(document).on('click','.remove-multiple-image', function(event) {
            event.preventDefault();
            let _buttonParentDiv = $(this).closest('.image');
            let _parentDiv = $(this).closest('div.js-component-upload-image');
            let _selectedIndex = $(this).attr('data-index-id');
            let _imageElement = $(_parentDiv).find('.js-component-upload-image-json');
            let _images =$(_imageElement).val();
            let updateImage = []
            let name = '';
            $.each(JSON.parse(_images), function (index, element) {
                if (index != _selectedIndex && element) {
                    updateImage.push(element);
                    name += element.name_img  + ', ';
                }
            });
            $(_parentDiv).find('.file-upload-info').val(name);

            if ( ! updateImage.length ) {
                $(_imageElement).val('');
                $(_parentDiv).find('.js-remove-component-image').trigger('click');
            } else {
                $(_imageElement).val(JSON.stringify(updateImage));
            }
            window.initImageFields();
        })
    });
})(jQuery);
