$(document).on('click', '.clone-button', function (event) {
    event.preventDefault();
    let _parentDiv = $(this).closest('div.break-downamount');

    let _clone = $(_parentDiv).clone();
    $(_clone).find('.clone-button').remove();
    $(_clone).find('.remove-clone').removeClass('d-none');

    $(_parentDiv).closest('div.card').append(_clone);

})

$(document).on('click', '.remove-clone', function (event) {
    event.preventDefault();
    $(this).closest('div.break-downamount').fadeOut('fast');
})
