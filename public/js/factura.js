$(window).on('beforeunload', function() {
    console.log('hola');
});
$(window).load(function() {
    mostrar_ubigeo();
    $('input[name=caja_documento]').val($('#form_agregar_factura input[name=serie]').val());
    $('input[name=caja_numero]').val($('#form_agregar_factura input[name=numero_factura]').val());
});
$(document).ready(function() {
    $('input[name=total_pago]').change(function() {
        var total = $('input[name=total_caja]').val();
        var total_pago = $('input[name=total_pago]').val();
        var total_vuelto = total_pago - total;
        $('input[name=total_vuelto]').val(parseFloat(total_vuelto).toFixed(2));
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
    verificarnumerofactura();
    verificar_numero_pedido();
    $('#btn_facturar').click(function() {
        facturar();
    });
    llamar_rucs('FAC');
    $('input[name=cli_id]').change(function() {
        llamar_cliente();
    });
    $('input[name=codproducto]').change(function() {
        cod_producto($(this).val());
    });
    llamar_codpro();
    $('#form_agregar_factura input[name=moneda]').val($('#form_agregar_factura select[name=moneda_change]').val());
    $('#form_agregar_factura select[name=moneda_change]').change(function() {
        $('#form_agregar_factura input[name=moneda]').val($(this).val());
    });
    var table = $('.datatable').DataTable({
        "searching": false,
        "bLengthChange": false,
        "paging": false,
        "info": false,
        "ajax": {
            "url": '../Pedidos/tabla_itemspedido',
            "dataSrc": "",
            "data": function(d) {
                d.codigo_pedido = $('input[name=codigo_pedido]').val();
            }
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "ped_cantidad"
        }, {
            "data": "ped_cod_pro"
        }, {
            "data": "ped_nombre_pro"
        }, {
            "data": "ped_valor_venta_sin_igv"
        }, {
            "data": "ped_total"
        }, {
            "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [100, -1],
            [100, "All"]
        ]
    });
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar item <strong>' + rowData['ped_nombre_pro'] + '</strong>?', function() {
                eliminar_item(rowData['id']);
                alertify.notify('Se elimino el item <strong>' + rowData['ped_nombre_pro'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar item <strong>' + data['ped_nombre_pro'] + '</strong>?', function() {
                eliminar_item(data['id']);
                alertify.notify('Se elimino el item <strong>' + data['ped_nombre_pro'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        }
    });
    abrir_modal('modalagregar', '<i class="fa fa-bars" aria-hidden="true"></i> Agregar Cliente <br> <small><i class="far fa-edit"></i> Aquí podrá agregar clientes.</small>');
    $('#btn_agregar').click(function() {
        $('#form_agregar_cliente').show();
        alertify.modalagregar($('#form_agregar_cliente')[0]).set('selector', 'input[name="ruc"]');
        actualizar_select2();
    });
})

function verificarnumerofactura() {
    var correlativo = $('#form_agregar_factura input[name=serie]').val();
    $.ajax({
        url: '../Listapedidos/verificarnumerofactura',
        type: "POST",
        dataType: "html",
        data: {
            'correlativo': correlativo
        },
        success: function(data) {
            $('#form_agregar_factura input[name=numero_factura]').val(data);
        }
    });
}

function verificar_numero_pedido() {
    $.ajax({
        url: '../Pedidos/llamar_codigo_pedido',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#form_agregar_factura input[name=codigo_pedido]').val(data);
        }
    });
}

function llamar_rucs(documento) {
    $.ajax({
        url: '../Clientes/llamar_rucs/' + documento,
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#datalist_rucs').html(data);
        }
    });
}

function llamar_cliente() {
    var id = $('input[name=cli_id]').val();
    id = id.split("|");
    $.ajax({
        url: '../Clientes/llamar_cliente',
        type: "POST",
        dataType: "html",
        data: {
            'id': $.trim(id[0]),
        },
        success: function(data) {
            if (data == 'vacio') {
                alertify.notify('No se encontraron resultados del <strong>Cliente</strong>', 'custom', 5, function() {});
                $('input[name=cli_id]').focus();
                $('#cli_nombre').text('');
                $('#cli_ruc').text(' ');
                $('#cli_ubigeo').text(' ');
                $('#cli_direccion').text(' ');
                $('#cli_telefono').text(' ');
                $('#cli_celular').text(' ');
            } else {
                var obj = JSON.parse(data);
                $('#cli_nombre').text(obj[0].cli_nombre);
                $('#cli_ruc').text(obj[0].cli_ruc);
                $('#cli_ubigeo').text(obj[0].cli_ubigeo);
                $('#cli_direccion').text(obj[0].cli_direccion);
                $('#cli_telefono').text(obj[0].cli_telefono);
                $('#cli_celular').text(obj[0].cli_celular);
            }
        }
    })
}

function cod_producto(codart) {
    var str = codart;
    var res = str.split("|");
    var codart = res[0];
    $.ajax({
        url: '../Pedidos/codpro',
        type: "POST",
        dataType: "JSON",
        data: {
            'codart': codart,
        },
        success: function(data) {
            if (data == 0) {
                $('input[name=producto]').val('');
                $('input[name=preciounitario]').val('');
                $('input[name=total]').val('');
                $('input[name=stock]').val('');
            } else {
                $('input[name=producto]').val(data[0].art_nombre);
                $('input[name=valor_venta_sin_igv]').val(data[0].art_precio_ventasinigv);
                $('input[name=pro_id]').val(data[0].id);
                $('input[name=stock]').val(data[0].art_stock);
                var cantidad = $('input[name=cantidad]').val();
                var preciounitario = $('input[name=valor_venta_sin_igv]').val();
                var total = cantidad * preciounitario;
                $('input[name=total]').val(total);
            }
        }
    });
}

function llamar_codpro() {
    $.ajax({
        url: '../Articulos/llamar_codpro',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#datalist_codpro').html(data);
        }
    });
}
$(function() {
    $("#form_agregar_factura").on("submit", function(e) {
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
                var producto = $('#form_agregar_pedido input[name=codproducto]').val();
                if (response == 4) {
                    alertify.notify('No se encontro <strong>Cliente</strong> en nuestra base de datos.', 'custom', 5, function() {});
                    $('input[name=cli_id]').focus();
                    return;
                }
                if (response == 3) {
                    alertify.notify('No existe el producto <strong>' + producto + '</strong> en nuestra base de datos.', 'custom', 5, function() {});
                    $('#form_agregar_pedido input[name=codproducto]').focus();
                    return;
                }
                if (response == 1) {
                    alertify.notify('No cuenta con stock suficiente del producto <strong>' + producto + '.</strong>', 'custom', 5, function() {});
                    $('#form_agregar_pedido input[name=cantidad]').focus()
                    return;
                }
                if (response == 2) {
                    alertify.notify('Stock mínimo del producto <strong>' + producto + '.</strong>', 'custom', 5, function() {});
                }
                f.find('input[name=cantidad]').val('1');
                f.find('input[name=codproducto]').val('');
                f.find('input[name=producto]').val('');
                f.find('input[name=valor_venta_sin_igv]').val('');
                f.find('input[name=total]').val('');
                f.find('input[name=cli_id]').prop('readonly', true);
                f.find('select[name=tipo_documento_sel]').prop('disabled', true);
                f.find('input[name=stock]').val('');
                $('input[name=codproducto]').focus();
                alertify.notify('Agregado <strong>pedido</strong> correctamente.', 'custom-black', 5, function() {});
                var table = $('.datatable').DataTable();
                table.ajax.reload();
                tabla_itemspedido_totales();
                aprobar();
            },
            error: function() {},
        });
    });
});

function aprobar() {
    var pedido = $('#form_agregar_factura input[name=codigo_pedido]').val();
    $.ajax({
        url: '../Listapedidos/aprobar2',
        type: "POST",
        dataType: "html",
        data: {
            'pedido': pedido
        },
        success: function(data) {
            table = $('.datatable_lista').DataTable();
            table.ajax.reload();
        }
    });
}

function tabla_itemspedido_totales() {
    var codigo_pedido = $('input[name=codigo_pedido]').val();
    $.ajax({
        url: '../Pedidos/tabla_itemspedido_totales',
        type: "POST",
        dataType: "json",
        data: {
            'codigo_pedido': codigo_pedido,
        },
        success: function(data) {
            $('.label_subtotal,.label_igv,.label_total').html('');
            $('.label_subtotal').html(data[0].subtotal);
            $('.label_igv').html(data[0].igv);
            $('.label_total').html(data[0].total);
            $('input[name=total_caja]').val(data[0].total);
            $('input[name=total_pago]').val(data[0].total);
            $('input[name=total_pago]').trigger('change');
        }
    });
}

function facturar() {
    if ($('input[name=total_pago]').val() == '' || $('input[name=total_pago]').val() == '0' || $('input[name=total_pago]').val() == '0.00') {
        $('input[name=total_pago]').val('0');
        $('input[name=total_pago]').focus();
        alertify.notify('Ingrese <strong>monto</strong> recibido', 'custom-black', 4, function() {});
    } else {
        //$('.btn_caja').trigger('click');
        var f = $('#form_agregar_factura');
        var metodo = f.attr("method");
        var url = '../Facturar/crear_factura2';
        var formData = new FormData(document.getElementById("form_agregar_factura"));
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
                console.log(data);
                alertify.dismissAll();
                if (data == 0) {
                    $('.btn_caja').trigger('click');
                    alertify.notify('<strong>Factura</strong> enviada correctamente', 'custom-black', 1, function() {
                        location.reload();
                    });
                } else {
                    alertify.notify(data, 'custom', 5, function() {});
                    table = $('.datatable_lista').DataTable();
                    table.ajax.reload();
                }
            },
            error: function() {},
        });
    };
};
$(function() {
    $("#form_agregar_caja").on("submit", function(e) {
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

function btn_facturar() {
    if ($('input[name=total_pago]').val() == '' || $('input[name=total_pago]').val() == '0' || $('input[name=total_pago]').val() == '0.00') {
        $('input[name=total_pago]').val('0');
        $('input[name=total_pago]').focus();
        alertify.notify('Ingrese <strong>monto</strong> recibido', 'custom_m', 4, function() {});
    } else {
        $('.btn_caja').trigger('click');
    }
}
$(function() {
    $("#form_agregar_cliente").on("submit", function(e) {
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
                f[0].reset();
                llamar_rucs('FAC');
                alertify.modalagregar().close();
            },
            error: function() {},
        });
    });
});

function mostrar_ubigeo() {
    $.ajax({
        url: '../Clientes/mostrar_ubigeo2',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = ubigeo]').append(data);
            var placeholder = "Seleccione Ciudad,Provincia,Distrito";
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".select2-single, .select2-multiple").select2({
                placeholder: placeholder,
                width: null,
                containerCssClass: ':all:'
            });
        }
    });
}