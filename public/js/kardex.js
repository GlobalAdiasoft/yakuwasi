$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Kardex/mostrar_kardex2',
            "dataSrc": "",
            "data": function(d) {
                d.nrokardex = $('input[name=nrokardex]').val();
            }
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "articulo"
        }, {
            "data": "cod_articulo"
        }, {
            "data": "fecha"
        }, {
            "data": "hora"
        }, {
            "data": "ingreso"
        }, {
            "data": "salida"
        }, {
            "data": "saldo"
        }, {
            "data": "usuario"
        }, {
            "data": "documento"
        }, {
            "data": "correlativo"
        }, {
            "data": "proveedor"
        }, {
            "data": "observaciones"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "buttons": [
            { "extend": 'copyHtml5', "text": 'Copiar', "className": 'btn btn-dark btn-sm' },
            { "extend": 'excelHtml5', "text": 'Excel', "className": 'btn btn-dark btn-sm' },
            { "extend": 'csvHtml5', "text": 'CSV', "className": 'btn btn-dark btn-sm' },
            { "extend": 'pdfHtml5', "text": 'PDF', "className": 'btn btn-dark btn-sm' },
            { "extend": 'print', "text": 'IMPRIMIR', "className": 'btn btn-dark btn-sm', 'postfixButtons': ['colvisRestore'] },
        ],
        dom: '<"row"<"col-12 col-sm-12 col-md-6"l><"col-12 col-sm-12 col-md-6"f>>rt<"top"B><"col-12"i>p',
        "order": [
            [0, "desc"]
        ]
    });
});