$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Verboletas/mostrarboletas',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "bol_correlativo"
        }, {
            "data": "bol_numero_boleta"
        }, {
            "data": "btn_generarfacturasunat"
        }, {
            "data": "bol_pdf"
        }, {
            "data": "bol_xml"
        }, {
            "data": "bol_cdr"
        }, {
            "data": "descripcion"
        }, {
            "data": "btn_imprimirguia"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "order": [
            [2, "desc"]
        ]
    });
    $('.datatable tbody').on('click', '#btn_anular', function() {
        var data = table.row($(this).parents('tr')).data();
        anular_boleta(data['bol_correlativo'], data['bol_numero_boleta']);
    });
    $('.datatable tbody').on('click', '#btn_actualizar_factura', function() {
        var data = table.row($(this).parents('tr')).data();
        actualizar_boleta(data['bol_correlativo'], data['bol_numero_boleta']);
    });
    $('.datatable tbody').on('click', '#btn_actualizar_anulacion', function() {
        var data = table.row($(this).parents('tr')).data();
        actualizar_anulacion(data['bol_correlativo'], data['bol_numero_boleta']);
    });
});

function anular_boleta(correlativo, numero) {

    $.ajax({
        url: '../Boletear/anular_boleta/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Anulando <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {
            alertify.dismissAll();
            alertify.notify('<strong>Boleta </strong> Anulación enviada', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}

function actualizar_boleta(correlativo, numero) {

    $.ajax({
        url: '../Boletear/consultar_boleta/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Actualizando con <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {

            alertify.dismissAll();
            alertify.notify('<strong>Boleta</strong> Actualizado correctamente', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });

}

function actualizar_anulacion(correlativo, numero) {


    $.ajax({
        url: '../Boletear/consultar_anulacion/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Actualizando con <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {


            alertify.dismissAll();
            alertify.notify('<strong>Boleta</strong> Actualizado correctamente', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}