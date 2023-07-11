$('.datatable-sortable-component').sortable({
    handle: '.sortable-handle',
    update: function (event, ui) {
        let items = {};
        $(this).find('[data-sort-id]').each(function (index, item) {
            items[$(item).attr('data-sort-id')] = index;
        })

        let url = $(this).closest('.component-parent').attr('data-action');
        $.ajax({
            method: "POST",
            url: url,
            data: items,
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
            success: function (response) {
                handleOKResponse(response)
            },
            error: function (response) {

            }
        });
    }
});

if ($(".datatable-lister-sortable").length) {
    $('table.datatable-lister-sortable>tbody').sortable({
        handle: '.sortable-handle',
        start: function (event, ui) {
            let parentID = ui.item.attr('data-sort-id');
            var parentTr = ui.item.closest("tbody");

            if (parentTr.length) {
                var childTrs = parentTr.find("[data-parent-id='" + parentID + "']");
                ui.item.data("child-trs", childTrs);
            }
        },
        sort: function (event, ui) {
            var childTrs = ui.item.data('child-trs');
            if (childTrs && childTrs.length) {
                childTrs.insertAfter(ui.placeholder);
            }
        },
        update: function (event, ui) {
            let items = {};
            $(this).find('[data-sort-id]').each(function (index, item) {
                items[$(item).attr('data-sort-id')] = index;
            })
            let url = $(this).closest('table').attr('data-action');

            $.ajax({
                method: "POST",
                url: url,
                data: items,
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function (response) {
                    handleOKResponse(response)
                },
                error: function (response) {

                }
            });
        }
    });

    $('table.datatable-lister-sortable').sortable({
        handle: '.child-sortable-handle',
        connectWith: '.parent',
        items: 'tr.children',
        update: function (event, ui) {
            let items = {};
            let parentMenu = {};

            let _currentTr = ui.item[0];

            $(this).find('[data-child-sort]').each(function (index, item) {
                items[$(item).attr('data-child-sort')] = index;
            })

            let _parentTr = $(this).find('tr[data-sort-id="' + $(_currentTr).attr('data-parent-id') + '"]');
            let url = $(this).closest('table').attr('data-action');
            url += '/' + $(_currentTr).attr('data-parent-id');

            $.ajax({
                method: "POST",
                url: url,
                data: items,
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function (response) {
                    handleOKResponse(response);
                },
                error: function (response) {

                }
            });
        }
    })

}
