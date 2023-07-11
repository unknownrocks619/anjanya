import DataTable from "datatables.net-dt";

if ($('.datatable-lister').length) {
    // $(".datatable-lister").DataTables();
    $.each($('.datatable-lister'), function (index, element) {
        new DataTable($(element));
    })
}


if ($ ('.datatable-lister-sortable').length) {
    $.each($('.datatable-lister-sortable'),function(index,element) {
        new DataTable($(element),{
             displayIndex: true,
            dataIndex: true,
            "ordering": false,
            paging: false,
        });
    });
}
