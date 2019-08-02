$(document).ready(function() {
    llamar_pro_busqueda();
    $(".fechas_ui").datepicker({ dateFormat: 'yy-mm-dd' });
    $(".fechas_ui,input[name=pro_busqueda]").change(function() {

        table.ajax.reload();
        valorizado();
    })
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Ventas/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.fechainicio = $('input[name=fecha_incio]').val();
                d.fechafinal = $('input[name=fecha_final').val();
                d.pro_busqueda = $('input[name=pro_busqueda').val();

            },

        },
        "columns": [{
            "data": "fecha"
        }, {
            "data": "nombre_producto"
        }, {
            "data": "usuario"
        }, {
            "data": "codigo_producto"
        }, {
            "data": "cantidad"
        }, {
            "data": "valor_sin_igv"
        }, {
            "data": "correlativo"
        }, {
            "data": "numero_factura"
        }, {
            "data": "total"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            // [10, 15, 20, "All"]
            ["All"],
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

function llamar_pro_busqueda() {

    $.ajax({
        url: '../Ventas/productos_busqueda',
        type: "POST",
        dataType: "html",
        success: function(data) {

            $('#datalist_pro_busqueda').html(data);
        }
    });
}

function valorizado() {
    fechainicio = $('input[name=fecha_incio]').val();
    fechafinal = $('input[name=fecha_final').val();
    pro_busqueda = $('input[name=pro_busqueda').val();
    table = $('.datatable').DataTable();
    $.ajax({
        url: '../Ventas/item_valorizado',
        type: "GET",
        data: {
            "fechainicio": fechainicio,
            "fechafinal": fechafinal,
            "pro_busqueda": pro_busqueda,
        },
        dataType: "json",

        success: function(data) {
            table.row.add({
                "fecha": "",
                "nombre_producto": "",
                "usuario": "",
                "codigo_producto": "",
                "cantidad": "",
                "valor_sin_igv": "",
                "correlativo": "",
                "numero_factura": "",
                "total": "",

            }).draw();
            table.row.add({
                "fecha": "<strong>Subtotal :</strong>",
                "nombre_producto": "<strong>" + data.subtotal + "</strong>",
                "usuario": "",
                "codigo_producto": "",
                "cantidad": "",
                "valor_sin_igv": "",
                "correlativo": "",
                "numero_factura": "",
                "total": "",

            }).draw();
            table.row.add({
                "fecha": "<strong>IGV :</strong>",
                "nombre_producto": "<strong>" + data.igv + "</strong>",
                "usuario": "",
                "codigo_producto": "",
                "cantidad": "",
                "valor_sin_igv": "",
                "correlativo": "",
                "numero_factura": "",
                "total": "",

            }).draw();
            table.row.add({
                "fecha": "<strong>Total :</strong>",
                "nombre_producto": "<strong>" + data.total + "</strong>",
                "usuario": "",
                "codigo_producto": "",
                "cantidad": "",
                "valor_sin_igv": "",
                "correlativo": "",
                "numero_factura": "",
                "total": "",

            }).draw();



        }
    });
}