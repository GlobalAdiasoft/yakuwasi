$(document).ready(function() {
    llamar_pro_busqueda();
    $('.generar').click(function() {
        valorizado();
    });
    var table = $('.datatable1').DataTable({
        "ajax": {
            "url": '../Compras/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.fechainicio = $('input[name=fecha_incio]').val();
                d.fechafinal = $('input[name=fecha_final').val();
                d.pro_busqueda = $('input[name=pro_busqueda').val();
            },

        },
        "columns": [{
            "data": "id"
        }, {
            "data": "factura"
        }, {
            "data": "proveedor"
        }, {
            "data": "producto"
        }, {
            "data": "cantidad"
        }, {
            "data": "moneda"
        }, {
            "data": "precio_compra_conigv"
        }, {
            "data": "precio_compra_sinigv"
        }, {
            "data": "total"
        }, {
            "data": "fecha_hora"
        }, {
            "data": "usuario"
        }, {
            "defaultContent": "<button id='btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
        }, {
            "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
        }, ],
       
        
        
    });
    $(".fechas_ui").datepicker({ dateFormat: 'yy-mm-dd' });
    $(".fechas_ui,input[name=pro_busqueda]").change(function() {

        table.ajax.reload();
        valorizado();
    })
    $('.datatable tbody').on('click', '#btn_editar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            editar(rowData['id']);
        } else {
            editar(data['id']);
        }
    });
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la compra de la factura <strong>' + rowData['factura'] + '</strong>?',
                function() {
                    eliminar(rowData['id']);
                    alertify.notify('Se elimino la compra de la factura <strong>' + rowData['factura'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la compra de la factura <strong>' + data['factura'] + '</strong>?',
                function() {
                    eliminar(data['id']);
                    alertify.notify('Se elimino la compra de la factura<strong>' + data['factura'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        }
    });
    $(".moneda").blur(function() {
        this.value = parseFloat(this.value);
    });
    mostrar_proveedor();
    mostrar_articulos();
    $('#form_agregar input[name=produ_precio_ventaconigv]').change(function() {

        $('#form_agregar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_agregar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });

    $('#form_agregar input[name=produ_precio_ventasinigv]').change(function() {

        $('#form_agregar input[name=produ_precio_ventaconigv]').val(parseFloat($('#form_agregar input[name=produ_precio_ventasinigv]').val()) * 1.18);
    });
    $('#form_modificar input[name=produ_precio_ventaconigv]').change(function() {

        $('#form_modificar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_modificar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });

    $('#form_modificar input[name=produ_precio_ventasinigv]').change(function() {

        $('#form_modificar input[name=produ_precio_ventaconigv]').val(parseFloat($('#form_modificar input[name=produ_precio_ventasinigv]').val()) * 1.18);
    });
    abrir_modal('modalmodificar', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Compra');

});

function mostrar_proveedor() {
    $.ajax({
        url: '../Proveedores/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = proveedor]').append(data);
            $('select[name = proveedor]').select2();
        }
    });
}

function mostrar_articulos() {
    $.ajax({
        url: '../Compras/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = articulo]').append(data);
            $('select[name = articulo]').select2();
        }
    });
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
            beforeSend: function() {},
            success: function(data) {
                llamar_pro_busqueda();
                f.find('select[name=proveedor]').select2('destroy');
                f.find('select[name=articulo]').select2('destroy');
                f[0].reset();
                table = $('.datatable').DataTable();
                table.ajax.reload();
                alertify.notify('Se agrego <strong>COMPRA</strong> correctamente.', 'custom-black', 4, function() {})
                f.find("select[name=proveedor]").select2({
                    theme: "bootstrap",
                });
                f.find("select[name=articulo]").select2({
                    theme: "bootstrap",
                });
                f.find('input[name=numero_factura]').focus();

            },
            error: function() {},
        });
    });
});

function eliminar(id) {
    $.ajax({
        url: '../Compras/eliminar',
        type: "POST",
        dataType: "html",
        data: {
            'id': id,
        },
        success: function(data) {
            table = $('.datatable').DataTable();
            table.ajax.reload();
        }
    });
}

function editar(id) {
    $('#form_modificar').show();
    alertify.modalmodificar($('#form_modificar')[0]).set('selector', 'input[name=""]');
    $.ajax({
        url: '../Compras/mostrar_compras',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {

            var form = $('#form_modificar');

            form.find('select[name=proveedor]').select2('destroy');
            form.find('select[name=articulo]').select2('destroy');

            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=numero_factura]').val(data[0].factura);
            form.find('select[name=proveedor]').val(data[0].proveedor);
            form.find('select[name=articulo]').val(data[0].producto);
            form.find('input[name=cantidad]').val(data[0].cantidad);
            form.find('select[name=moneda]').val(data[0].moneda);
            form.find('input[name=produ_precio_ventaconigv]').val(data[0].precio_compra_conigv);
            form.find('input[name=produ_precio_ventasinigv]').val(data[0].precio_compra_sinigv);

            form.find("select[name=proveedor]").select2({
                theme: "bootstrap",
            });
            form.find("select[name=articulo]").select2({
                theme: "bootstrap",
            });
        }
    });
}
$(function() {
    $("#form_modificar").on("submit", function(e) {
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
            beforeSend: function() {},
            success: function(response) {
                f[0].reset();
                table = $('.datatable').DataTable();
                table.ajax.reload();
                alertify.modalmodificar().close();
                alertify.notify('<strong>Compra</strong> modificada correctamente.', 'custom-black', 3, function() {});
            },
            error: function() {},
        });
    });
});

function valorizado() {
    fechainicio = $('input[name=fecha_incio]').val();
    fechafinal = $('input[name=fecha_final').val();
    pro_busqueda = $('input[name=pro_busqueda').val();
    table = $('.datatable').DataTable();
    $.ajax({
        url: '../Compras/item_valorizado',
        type: "GET",
        data: {
            "fechainicio": fechainicio,
            "fechafinal": fechafinal,
            "pro_busqueda": pro_busqueda,
        },
        dataType: "json",

        success: function(data) {
            console.log(data);
            table.row.add({
                "id": "<strong>CANTIDAD :</strong>",
                "factura": "<strong>" + data.cantidad + "</strong>",
                "proveedor": "",
                "producto": "",
                "cantidad": "",
                "moneda": "",
                "precio_compra_conigv": "",
                "precio_compra_sinigv": "",
                "total": "",
                "fecha_hora": "",
                "usuario": "",
                "defaultContent": "",
                "defaultContent": "",
            }).draw();
            table.row.add({
                "id": "<strong>TOTAL :</strong>",
                "factura": "<strong>" + data.total + "</strong>",
                "proveedor": "",
                "producto": "",
                "cantidad": "",
                "moneda": "",
                "precio_compra_conigv": "",
                "precio_compra_sinigv": "",
                "total": "",
                "fecha_hora": "",
                "usuario": "",
                "defaultContent": "",
                "defaultContent": "",
            }).draw();
            table.row.add({
                "id": "<strong>VALOR :</strong>",
                "factura": "<strong>" + data.valor + "</strong>",
                "proveedor": "",
                "producto": "",
                "cantidad": "",
                "moneda": "",
                "precio_compra_conigv": "",
                "precio_compra_sinigv": "",
                "total": "",
                "fecha_hora": "",
                "usuario": "",
                "defaultContent": "",
                "defaultContent": "",
            }).draw();


        }
    });
}

function llamar_pro_busqueda() {

    $.ajax({
        url: '../Compras/productos_busqueda',
        type: "POST",
        dataType: "html",
        success: function(data) {
            console.log(data);
            $('#datalist_pro_busqueda').html(data);
        }
    });
}