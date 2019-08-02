$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Verfacturas/mostrarfacturas',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "fac_correlativo"
        }, {
            "data": "fac_numero_factura"
        }, {
            "data": "btn_generarfacturasunat"
        }, {
            "data": "fact_pdf"
        }, {
            "data": "fact_xml"
        }, {
            "data": "fact_cdr"
        }, {
            "data": "descripcion"
        }, {
            "data": "btn_imprimirguia"
        }, ],


        "order": [
            [2, "desc"]
        ]
    });
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        eliminar_factura(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_imprimirfactura', function() {
        var data = table.row($(this).parents('tr')).data();
        imprimir_factura(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_generarfacturasunat', function() {
        var data = table.row($(this).parents('tr')).data();
        generarfacturasunat(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_imprimirguia', function() {
        var data = table.row($(this).parents('tr')).data();
        imprimir_guia(data['fac_correlativo'], data['fac_numero_factura'], data['id']);
    });
    $('.datatable tbody').on('click', '#btn_volvera_generarfacturasunat', function() {
        var data = table.row($(this).parents('tr')).data();
        volvera_generarfacturasunat(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_anular', function() {
        var data = table.row($(this).parents('tr')).data();
        anular_factura(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_actualizar_factura', function() {
        var data = table.row($(this).parents('tr')).data();
        actualizar_factura(data['fac_correlativo'], data['fac_numero_factura']);
    });
    $('.datatable tbody').on('click', '#btn_actualizar_anulacion', function() {
        var data = table.row($(this).parents('tr')).data();
        actualizar_anulacion(data['fac_correlativo'], data['fac_numero_factura']);
    });
});

function eliminar_factura(fac_correlativo, fac_numero_factura) {
    $.ajax({
        url: '../Verfacturas/eliminar_factura',
        type: "POST",
        dataType: "html",
        data: {
            'fac_numero_factura': fac_numero_factura,
            'fac_correlativo': fac_correlativo,
        },
        success: function(data) {
            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}

function imprimir_factura(fac_correlativo, fac_numero_factura) {
    window.open('../Facturas/imprimirfactura?fac_correlativo=' + fac_correlativo + '&fac_numero_factura=' + fac_numero_factura, '_blank');
}

function imprimir_guia(fac_correlativo, fac_numero_factura, id) {
    window.open('../Facturas/imprimirguia?fac_correlativo=' + fac_correlativo + '&fac_numero_factura=' + fac_numero_factura + '&id=' + id, '_blank');
}

function generarfacturasunat(fac_correlativo, fac_numero_factura) {
    cambiar_envio_sunat(fac_correlativo, fac_numero_factura);
    window.open('../Facturas/pruebas/' + fac_correlativo + '/' + fac_numero_factura, '_blank');
}

function volvera_generarfacturasunat(fac_correlativo, fac_numero_factura) {
    window.open('../Facturas/consultar_comprobante/' + fac_correlativo + '/' + fac_numero_factura, '_blank');
}

function cambiar_envio_sunat(fac_correlativo, fac_numero_factura) {
    $.ajax({
        url: '../Facturas/cambiar_envio_sunat',
        type: "POST",
        dataType: "html",
        data: {
            'fac_numero_factura': fac_numero_factura,
            'fac_correlativo': fac_correlativo,
        },
        success: function(data) {
            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}

function anular_factura(correlativo, numero) {

    $.ajax({
        url: '../Facturar/anular_factura/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Anulando <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {
            alertify.dismissAll();
            alertify.notify('<strong>Factura </strong> Anulación enviada', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}

function actualizar_factura(correlativo, numero) {

    $.ajax({
        url: '../Facturar/consultar_factura/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Actualizando con <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {
            alertify.dismissAll();
            alertify.notify('<strong>Factura</strong> Actualizado correctamente', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });

}

function actualizar_anulacion(correlativo, numero) {


    $.ajax({
        url: '../Facturar/consultar_anulacion/' + correlativo + '/' + numero,
        type: "POST",
        dataType: "html",
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Actualizando con <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

        },
        success: function(data) {
            console.log(data);
            alertify.dismissAll();
            alertify.notify('<strong>Factura</strong> Actualizado correctamente', 'custom-black', 1, function() {});

            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}