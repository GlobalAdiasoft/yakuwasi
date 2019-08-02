$(document).ready(function() {
    $.extend(true, $.fn.dataTable.defaults, {
        "buttons": [{ "extend": 'copyHtml5', "text": 'Copiar', "className": 'btn btn-dark btn-sm' }, { "extend": 'excelHtml5', "text": 'Excel', "className": 'btn btn-dark btn-sm' }, { "extend": 'print', "text": 'IMPRIMIR', "className": 'btn btn-dark btn-sm', 'postfixButtons': ['colvisRestore'] }, { "extend": 'csvHtml5', "text": 'CSV', "className": 'btn btn-dark btn-sm', "fieldSeparator": '|', "fieldBoundary": "", "extension": ".txt", "header": false }, 'colvis'],
        dom: '<"row"<"col-12 col-sm-12 col-md-6"l><"col-12 col-sm-12 col-md-6"f>>rt<"top"B><"col-12"i>p',
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ]
    });
    $('.sorting').after().click(function() {
        table = $('.datatable').DataTable();
        table.columns.adjust().draw()
    });
});
$(window).load(function() {
    $('.sorting').after().click(function() {
        table = $('.datatable').DataTable();
        table.columns.adjust().draw()
    });
});