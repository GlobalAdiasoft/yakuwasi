$(window).load(function() {});
$(document).ready(function() {
    $('#form_agregar_caja_boleta input[name=total_pago]').change(function() {
        var total = $('#form_agregar_caja_boleta input[name=total_caja]').val();
        var total_pago = $('#form_agregar_caja_boleta input[name=total_pago]').val();
        var total_vuelto = total_pago - total;
        $('#form_agregar_caja_boleta input[name=total_vuelto]').val(parseFloat(total_vuelto).toFixed(2));
    });
    $('#form_agregar_caja_factura input[name=total_pago]').change(function() {
        var total = $('#form_agregar_caja_factura input[name=total_caja]').val();
        var total_pago = $('#form_agregar_caja_factura input[name=total_pago]').val();
        var total_vuelto = total_pago - total;
        $('#form_agregar_caja_factura input[name=total_vuelto]').val(parseFloat(total_vuelto).toFixed(2));
    });
    $("input[name=total_pago]").blur(function() {
        this.value = parseFloat(this.value).toFixed(2);
    });
    $("input[name=total_caja]").blur(function() {
        this.value = parseFloat(this.value).toFixed(2);
    });
    $("input[name=total_vuelto]").blur(function() {
        this.value = parseFloat(this.value).toFixed(2);
    });
    $('#form_factura select[name=condiciones_pago]').change(function() {
        condicionesdepago(this);
    });
    $('#form_factura select[name=medio_pago_change]').change(function() {
        mediosdepago(this);
    });
    $('#form_boleta select[name=medio_pago_change]').change(function() {
        mediosdepago_boleta(this);
    });
    $('#form_factura select[name=sunat_transaccion_change]').change(function() {
        verificar_sunat_transaccion(this);
    });
    $('#form_boleta select[name=sunat_transaccion_change]').change(function() {
        verificar_sunat_transaccion_boleta(this);
    });
    $('#form_factura select[name=modena_change]').change(function() {
        tipodecambio(this);
    });
    $('#form_boleta select[name=modena_change]').change(function() {
        tipodecambio_boleta(this);
    });
    $('select[name=busqueda]').change(function() {
        table.ajax.reload();
    });
    var table = $('.datatable_lista').DataTable({
        'responsive': true,
        "ajax": {
            "url": '../Listapedidos/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.busqueda = $('select[name=busqueda]').val();
            }
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "usuario_cod"
        }, {
            "data": "ped_cod_ped"
        }, {
            "data": "ped_tipo_doc"
        }, {
            "data": "ped_usuario"
        }, {
            "data": "ped_fecha"
        }, {
            "data": "ped_cli_id"
        }, {
            "data": "ped_aprobacion"
        }, {
            "data": "ped_moneda"
        }, {
            "data": "ped_tipocambio"
        }, {
            "data": "eliminar"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "order": [
            [0, "desc"]
        ]
    });
    $('.datatable_lista tbody').on('click', '#generar_factura', function() {
        $('#div_form_factura').show();
        var f = $('#form_factura');
        alertify.modal_factura($('#div_form_factura')[0]).set('selector', 'select[name="moneda"]');
        verificarnumerofactura();
        verificar_sunat_transaccion($('#form_factura select[name=sunat_transaccion_change]'));
        mediosdepago($('#form_factura select[name=medio_pago_change]'));
        $('#form_agregar_caja_factura input[name=caja_documento]').val($('#form_factura input[name=serie]').val());
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable_lista').DataTable().row(selected_row).data();
            var cliente_id = rowData['ped_cli_id'];
            cliente_id = cliente_id.split(" ");
            f.find('input[name=cli_id]').val(cliente_id[0]);
            $('#form_factura input[name=pedido_usuario]').val(rowData['ped_cod_ped'] + '/' + rowData['ped_usuario']);
            llamar_cliente($('#form_factura'));
            $('#form_factura select[name=modena_change]').val(rowData['ped_moneda']);
            tipodecambio($('#form_factura select[name=modena_change]'));
            $('#form_factura input[name=tipocambio]').val(rowData['ped_tipocambio']);
            tabla_itemspedido_totales_pedidos(rowData['ped_cod_ped'], rowData['ped_usuario'], f);
            $('#form_factura input[name=codigo_pedido]').val(rowData['ped_cod_ped']);
        } else {
            var cliente_id = data['ped_cli_id'];
            cliente_id = cliente_id.split(" ");
            f.find('input[name=cli_id]').val(cliente_id[0]);
            $('#form_factura input[name=pedido_usuario]').val(data['ped_cod_ped'] + '/' + data['ped_usuario']);
            llamar_cliente($('#form_factura'));
            $('#form_factura select[name=modena_change]').val(data['ped_moneda']);
            tipodecambio($('#form_factura select[name=modena_change]'));
            $('#form_factura input[name=tipocambio]').val(data['ped_tipocambio']);
            tabla_itemspedido_totales_pedidos(data['ped_cod_ped'], data['ped_usuario'], f);
            $('#form_factura input[name=codigo_pedido]').val(data['ped_cod_ped']);
        }
    });
    $('.datatable_lista tbody').on('click', '#generar_boleta', function() {
        $('#div_form_boleta').show();
        var f = $('#form_boleta');
        alertify.modal_boleta($('#div_form_boleta')[0]).set('selector', 'select[name="moneda"]');
        verificarnumeroboleta();
        verificar_sunat_transaccion_boleta($('#form_boleta select[name=sunat_transaccion_change]'));
        mediosdepago_boleta($('#form_boleta select[name=medio_pago_change]'));
        $('#form_agregar_caja_boleta input[name=caja_documento]').val($('#form_boleta input[name=serie]').val());
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable_lista').DataTable().row(selected_row).data();
            var cliente_id = rowData['ped_cli_id'];
            cliente_id = cliente_id.split(" ");
            f.find('input[name=cli_id]').val(cliente_id[0]);
            $('#form_boleta input[name=pedido_usuario]').val(rowData['ped_cod_ped'] + '/' + rowData['ped_usuario']);
            llamar_cliente($('#form_boleta'));
            $('#form_boleta select[name=modena_change]').val(rowData['ped_moneda']);
            tipodecambio_boleta($('#form_boleta select[name=modena_change]'));
            $('#form_boleta input[name=tipocambio]').val(rowData['ped_tipocambio']);
            tabla_itemspedido_totales_pedidos_boleta(rowData['ped_cod_ped'], rowData['ped_usuario'], f);
            $('#form_boleta input[name=codigo_pedido]').val(rowData['ped_cod_ped']);
        } else {
            $('#form_boleta select[name=codigo_pedido]').val(data['ped_cod_ped']);
            var cliente_id = data['ped_cli_id'];
            cliente_id = cliente_id.split(" ");
            f.find('input[name=cli_id]').val(cliente_id[0]);
            $('#form_boleta input[name=pedido_usuario]').val(data['ped_cod_ped'] + '/' + data['ped_usuario']);
            llamar_cliente($('#form_boleta'));
            $('#form_boleta select[name=modena_change]').val(data['ped_moneda']);
            tipodecambio_boleta($('#form_boleta select[name=modena_change]'));
            $('#form_boleta input[name=tipocambio]').val(data['ped_tipocambio']);
            tabla_itemspedido_totales_pedidos_boleta(data['ped_cod_ped'], data['ped_usuario'], f);
            $('#form_boleta input[name=codigo_pedido]').val(data['ped_cod_ped']);
        }
    })
    $('.datatable_lista tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable_lista').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el pedido <strong>' + rowData['ped_cod_ped'] + '</strong>?', function() {
                eliminar_pedido(rowData['ped_cod_ped'], rowData['ped_usuario']);
                alertify.notify('Se elimino el pedido <strong>' + rowData['ped_cod_ped'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el pedido <strong>' + data['ped_cod_ped'] + '</strong>?', function() {
                eliminar_pedido(data['ped_cod_ped'], data['ped_usuario']);
                alertify.notify('Se elimino el pedido <strong>' + data['ped_cod_ped'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        };
    });
    abrir_modal('modal_factura', '<i class="fa fa-bars" aria-hidden="true"></i> Factura');
    abrir_modal('modal_boleta', '<i class="fa fa-bars" aria-hidden="true"></i> Boleta');
});

function aprobar(id) {
    $.ajax({
        url: '../Listapedidos/aprobar',
        type: "POST",
        dataType: "html",
        data: {
            'id': id
        },
        success: function(data) {
            table = $('.datatable_lista').DataTable();
            table.ajax.reload();
        }
    });
}

function rechazar(id) {
    $.ajax({
        url: '../Listapedidos/rechazar',
        type: "POST",
        dataType: "html",
        data: {
            'id': id
        },
        success: function(data) {
            table = $('.datatable_lista').DataTable();
            table.ajax.reload();
        }
    });
}

function llamar_cliente(f) {
    var id = f.find('input[name=cli_id]').val();
    $.ajax({
        url: '../Clientes/llamar_cliente',
        type: "POST",
        dataType: "html",
        data: {
            'id': id,
        },
        success: function(data) {
            if (data == 'vacio') {
                alertify.notify('No se encontraron resultados del <strong>Cliente</strong>', 'custom', 5, function() {});
                f.find('input[name=cli_id]').focus();
                f.find('#cli_nombre').text('');
                f.find('#cli_ruc').text(' ');
                f.find('#cli_ubigeo').text(' ');
                f.find('#cli_direccion').text(' ');
                f.find('#cli_telefono').text(' ');
                f.find('#cli_celular').text(' ');
            } else {
                var obj = JSON.parse(data);
                f.find('#cli_nombre').text(obj[0].cli_nombre);
                f.find('#cli_ruc').text(obj[0].cli_ruc);
                f.find('#cli_ubigeo').text(obj[0].cli_ubigeo);
                f.find('#cli_direccion').text(obj[0].cli_direccion);
                f.find('#cli_telefono').text(obj[0].cli_telefono);
                f.find('#cli_celular').text(obj[0].cli_celular);
            }
        }
    })
}

function verificarnumerofactura() {
    var correlativo = $('#form_factura input[name=serie]').val();
    $.ajax({
        url: '../Listapedidos/verificarnumerofactura',
        type: "POST",
        dataType: "html",
        data: {
            'correlativo': correlativo
        },
        success: function(data) {
            $('#form_factura input[name=numero_factura]').val(data);
            $('#form_agregar_caja_factura input[name=caja_numero]').val(data);
        }
    });
}

function verificarnumeroboleta() {
    var correlativo = $('#form_boleta input[name=serie]').val();
    $.ajax({
        url: '../Listapedidos/verificarnumeroboleta',
        type: "POST",
        dataType: "html",
        data: {
            'correlativo': correlativo
        },
        success: function(data) {
            $('#form_boleta input[name=numero_boleta]').val(data);
            $('#form_agregar_caja_boleta input[name=caja_numero]').val(data);
        }
    });
}

function tipodecambio(t) {
    var f = $('#form_factura');
    f.find('input[name=moneda]').val($(t).val());
    var tipodecambio = f.find('input[name=moneda]').val();
    if (tipodecambio == 'USD') {
        f.find('input[name=tipocambio]').attr('readonly', false);
        f.find('input[name=tipocambio]').attr("required", true);
    }
    if (tipodecambio == 'PEN') {
        f.find('input[name=tipocambio]').attr('readonly', true);
        f.find('input[name=tipocambio]').attr("required", false);
    }
}

function tipodecambio_boleta(t) {
    var f = $('#form_boleta');
    f.find('input[name=moneda]').val($(t).val());
    var tipodecambio = f.find('input[name=moneda]').val();
    if (tipodecambio == 'USD') {
        f.find('input[name=tipocambio]').attr('readonly', false);
        f.find('input[name=tipocambio]').attr("required", true);
    }
    if (tipodecambio == 'PEN') {
        f.find('input[name=tipocambio]').attr('readonly', true);
        f.find('input[name=tipocambio]').attr("required", false);
    }
}

function verificar_sunat_transaccion(t) {
    var f = $('#form_factura');
    f.find('input[name=sunat_transaccion]').val($(t).val());
    var value = f.find('input[name=sunat_transaccion]').val();
    if (value == 1) {
        f.find("select[name=condiciones_pago]").prop("disabled", true);
        f.find("input[name=guia_serie]").prop("disabled", true);
        f.find("select[name=condiciones_pago]").attr("required", false);
        f.find("input[name=guia_serie]").attr("required", false);
    }
    if (value == 10) {
        f.find("select[name=condiciones_pago]").prop("disabled", false);
        f.find("input[name=guia_serie]").prop("disabled", false);
        f.find("select[name=condiciones_pago]").attr("required", true);
        f.find("input[name=guia_serie]").attr("required", true);
    }
};

function verificar_sunat_transaccion_boleta(t) {
    var f = $('#form_boleta');
    f.find('input[name=sunat_transaccion]').val($(t).val());
    var value = f.find('input[name=sunat_transaccion]').val();
    if (value == 1) {
        f.find("select[name=condiciones_pago]").prop("disabled", true);
        f.find("input[name=guia_serie]").prop("disabled", true);
        f.find("select[name=condiciones_pago]").attr("required", false);
        f.find("input[name=guia_serie]").attr("required", false);
    }
    if (value == 10) {
        f.find("select[name=condiciones_pago]").prop("disabled", false);
        f.find("input[name=guia_serie]").prop("disabled", false);
        f.find("select[name=condiciones_pago]").attr("required", true);
        f.find("input[name=guia_serie]").attr("required", true);
    }
};

function mediosdepago(t) {
    $('#form_factura input[name=medio_pago]').val($(t).val());
}

function mediosdepago_boleta(t) {
    $('#form_boleta input[name=medio_pago]').val($(t).val());
}

function condicionesdepago(t) {
    $('#form_factura input[name=condiciones_pago]').val($(t).val());
}
$(function() {
    $("#form_factura").on("submit", function(e) {
        e.preventDefault();
        if ($('#form_agregar_caja_factura input[name=total_pago]').val() == '' || $('#form_agregar_caja_factura input[name=total_pago]').val() == '0' || $('#form_agregar_caja_factura input[name=total_pago]').val() == '0.00') {
            $('#form_agregar_caja_factura input[name=total_pago]').val('0');
            $('#form_agregar_caja_factura input[name=total_pago]').focus();
            alertify.notify('Ingrese <strong>monto</strong> recibido', 'custom-black', 4, function() {});
        } else {
            $('.btn_caja_factura').trigger('click');
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
                    alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Enviando <strong>Factura</strong> a <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});
                },
                success: function(data) {
                    alertify.dismissAll();
                    if (data == 0) {
                        alertify.notify('<strong>Factura</strong> enviada correctamente', 'custom-black', 5, function() {});
                        alertify.modal_factura().close();
                        $('#form_factura')[0].reset();
                        table = $('.datatable_lista').DataTable();
                        table.ajax.reload();
                    }
                },
                error: function() {},
            });
        }
    });
});
$(function() {
    $("#form_boleta").on("submit", function(e) {
        e.preventDefault();
        if ($('#form_agregar_caja_boleta input[name=total_pago]').val() == '' || $('#form_agregar_caja_boleta input[name=total_pago]').val() == '0' || $('#form_agregar_caja_boleta input[name=total_pago]').val() == '0.00') {
            $('#form_agregar_caja_boleta input[name=total_pago]').val('0');
            $('#form_agregar_caja_boleta input[name=total_pago]').focus();
            alertify.notify('Ingrese <strong>monto</strong> recibido', 'custom-black', 4, function() {});
        } else {
            $('.btn_caja_boleta').trigger('click');
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
                    alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Enviando <strong>Boleta</strong> a <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});
                },
                success: function(data) {
                    alertify.dismissAll();
                    if (data == 0) {
                        alertify.notify('<strong>Boleta</strong> enviada correctamente', 'custom-black', 5, function() {});
                        alertify.modal_boleta().close();
                        $('#form_factura')[0].reset();
                        table = $('.datatable_lista').DataTable();
                        table.ajax.reload();
                    } else {
                        alertify.notify(data, 'custom', 5, function() {});
                        alertify.modal_boleta().close();
                        $('#form_boleta')[0].reset();
                        table = $('.datatable_lista').DataTable();
                        table.ajax.reload();
                    }
                },
                error: function() {},
            });
        }
    });
});

function eliminar_pedido(nropedido, usuario) {
    $.ajax({
        url: '../Listapedidos/eliminar_pedido',
        type: "POST",
        dataType: "html",
        data: {
            'nropedido': nropedido,
            'usuario': usuario
        },
        success: function(data) {
            table = table = $('.datatable_lista').DataTable();
            table.ajax.reload();
        }
    });
}

function tabla_itemspedido_totales_pedidos(pedido, usuario, f) {
    $.ajax({
        url: '../Pedidos/tabla_itemspedido_totales_pedidos/' + pedido + '/' + usuario,
        type: "POST",
        dataType: "json",
        success: function(data) {
            f.find('.label_subtotal,.label_igv,.label_total').html('');
            f.find('.label_subtotal').html(data[0].subtotal);
            f.find('.label_igv').html(data[0].igv);
            f.find('.label_total').html(data[0].total);
            $('#form_agregar_caja_factura input[name=total_caja]').val(data[0].total);
            $('#form_agregar_caja_factura input[name=total_pago]').val(data[0].total);
            $('#form_agregar_caja_factura input[name=total_pago]').trigger('change')
        }
    });
}

function tabla_itemspedido_totales_pedidos_boleta(pedido, usuario, f) {
    $.ajax({
        url: '../Pedidos/tabla_itemspedido_totales_pedidos/' + pedido + '/' + usuario,
        type: "POST",
        dataType: "json",
        success: function(data) {
            f.find('.label_subtotal,.label_igv,.label_total').html('');
            f.find('.label_subtotal').html(data[0].subtotal);
            f.find('.label_igv').html(data[0].igv);
            f.find('.label_total').html(data[0].total);
            $('#form_agregar_caja_boleta input[name=total_caja]').val(data[0].total);
            $('#form_agregar_caja_boleta input[name=total_pago]').val(data[0].total);
            $('#form_agregar_caja_boleta input[name=total_pago]').trigger('change')
        }
    });
}
$(function() {
    $("#form_agregar_caja_boleta").on("submit", function(e) {
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
            success: function(response) {},
            error: function() {},
        });
    });
});
$(function() {
    $("#form_agregar_caja_factura").on("submit", function(e) {
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
            success: function(response) {},
            error: function() {},
        });
    });
});