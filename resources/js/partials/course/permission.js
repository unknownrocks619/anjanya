if ($("select[name='permission']").length) {

    $(document).on('change', 'select[name="permission"]', function (event) {

        let _selectedValue = $(this).find(':selected').val();

        $(".organisation").addClass('d-none')
        $(".student").addClass('d-none')
        $(".teacher").addClass('d-none')

        if (_selectedValue == 'organisation') {
            $(".organisation").removeClass('d-none')
            $(".student").removeClass('d-none')
            $(".teacher").removeClass('d-none')
        }

        if (_selectedValue == 'teacher') {
            $(".teacher").removeClass('d-none');
        }

        if (_selectedValue == 'student') {
            $(".student").removeClass('d-none');
        }

    });
}
