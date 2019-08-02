var documento_var = 0;
$(document).ready(function() {

    llamar_factura();
    $(".two-decimals").change(function() {
        var moneda = $(this).val();
        $(this).val(parseFloat(moneda).toFixed(2));
    });
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Cobranzas/mostrar_facturas',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "btn_cobranza"
        }, {
            "data": "fact_fecha"
        }, {
            "data": "fac_correlativo"
        }, {
            "data": "fact_condiciones_pago"
        }, {
            "data": "fact_fecha_vencimiento"
        }, {
            "data": "total_factura"
        }, {
            "data": "total_pagado"
        }, {
            "data": "total_por_pagar"
        }, {
            "defaultContent": "<button id='btn_historial' class='btn btn-info btn-sm' ><i class='fas fa-file-invoice-dollar fa-sm'></i> Historial</button>"
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

    var table1 = $('.datatable_historial').DataTable({
        "searching": false,
        "bLengthChange": false,
        "paging": false,
        "info": false,
        "ajax": {
            "url": '../Tablacobranzas/mostrar_historial',
            "dataSrc": "",
            "data": function(d) {
                d.documento = documento_var;
            }
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "cobra_documento"
        }, {
            "data": "cobra_fecha_hora"
        }, {
            "data": "cobra_usuario"
        }, {
            "data": "cobra_monto"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ]
    });
    abrir_modal('modal_agregar', '<i class="fa fa-bars" aria-hidden="true"></i> Cobranza');
    abrir_modal('modal_historial', '<i class="fa fa-bars" aria-hidden="true"></i> Historial');

    $('.datatable tbody').on('click', '#btn_cobranza', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            //alert(rowData);
            $('#form_agregar')[0].reset();
            cobranza(rowData['fac_correlativo'], rowData['total_por_pagar'], rowData['total_pagado']);
        } else {
            //alert(data);
            $('#form_agregar')[0].reset();
            cobranza(data['fac_correlativo'], data['total_por_pagar'], data['total_pagado']);
        };
    });
    $('.datatable tbody').on('click', '#btn_historial', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            //alert(rowData);
            historial(rowData['fac_correlativo']);
        } else {
            //alert(data);
            historial(data['fac_correlativo']);
        };
    });

});

function llamar_factura() {
    $.ajax({
        url: '../Cobranzas/llamar_factura',
        type: "POST",
        dataType: "html",

        success: function(data) {
            $('select[name=facturas]').append(data);
            var placeholder = "Seleccione Factura";

            $(".select2-single, .select2-multiple").select2({
                placeholder: placeholder,
                width: null,
                containerCssClass: ':all:'
            });
        }
    });
}

function cobranza(documento, porpagar, pagado) {
    $('#form_agregar').show();
    $('input[name=documento]').val(documento);
    $('#form_agregar span.total_pagar').html(porpagar);
    $('#form_agregar span.total_pagado').html(pagado);
    alertify.modal_agregar($('#form_agregar')[0]).set('selector', 'select[name="moneda"]');
}

function historial(documento) {

    documento_var = documento;
    table1 = $('.datatable_historial').DataTable();
    table1.ajax.reload();
    $('#div_historial').show();
    alertify.modal_historial($('#div_historial')[0]).set('selector', 'select[name="moneda"]');
}
$(function() {
    $("#form_agregar").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var metodo = f.attr("method");
        var url = f.attr("action");
        var formData = new FormData(this);
        formData.append("dato", "valor");
        $.ajax({
            url: url,
            type: metodo,
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Guardando', 'custom-black', 3600, function() {});
            },
            success: function(data) {
                alertify.dismissAll();
                alertify.modal_agregar().close();
                alertify.notify('<i class="fas fa-check"></i> Cobranza Efectuada', 'custom-black', 4, function() {});
                table = $('.datatable').DataTable();
                table.ajax.reload();

            },
            error: function() {},
        });
    });
});