$(function () {
    $('button[data-dismiss="modal"]').on('click', function () {
        $(this).closest('.modal').modal('hide');
    });
})
