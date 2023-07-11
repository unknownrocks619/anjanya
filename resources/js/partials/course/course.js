if ($("select[name='intro_video']").length) {

    $(document).on('change', 'select[name="intro_video"]', function (event) {
        event.preventDefault();
        let _currentValue = $(this).find(':selected').val();

        if (_currentValue == '') {
            $(".intro_video_type").addClass('d-none');
            return;
        }
        console.log('current_ value', _currentValue);
        $(".intro_video_type").find('.video_type').addClass('d-none');
        $("." + _currentValue).removeClass('d-none');
        $(".intro_video_type").removeClass('d-none');
    })
}
