$(document).ready(function() {
    $('select[name=correlativo]').change(function() {
        llamar_cod($(this).val());
    });
    llamar_codpro();
    $('select[name=documento_modi] ,input[name=numero_modi] ').change(function() {
        $('.reset_datos').html(' ');
        $('input[name=cli_id]').val('');
        $('select[name=moneda]').val('');
        traer_datos_factura();

    });
    $(".fecha_ui").datepicker();
    llamar_rucs();
    $('input[name=cli_id]').change(function() {
        llamar_cliente();
    });

    $('input[name=codproducto]').change(function() {

        cod_producto($(this).val());
    });
    var table = $('.datatable').DataTable({
        "searching": false,
        "bLengthChange": false,
        "paging": false,
        "info": false,
        "ajax": {
            "url": '../Notadebito/traer_datos_item_nota',
            "dataSrc": "",
            "data": function(d) {
                d.correlativo = $('select[name=correlativo]').val();
                d.numero = $('input[name=numero]').val();
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
            "defaultContent": "<button id='btn_eliminar2' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [100, -1],
            [100, "All"]
        ]
    });
    $('.datatable tbody').on('click', '#btn_eliminar2', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el artículo <strong>' + rowData['ped_nombre_pro'] + '</strong>?', function() {
                eliminar(rowData['id']);
                alertify.notify('Se elimino el artículo <strong>' + rowData['ped_nombre_pro'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el artículo <strong>' + data['ped_nombre_pro'] + '</strong>?', function() {
                eliminar(data['id']);
                alertify.notify('Se elimino el artículo <strong>' + data['ped_nombre_pro'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        };
    });
});

function llamar_rucs() {
    $.ajax({
        url: '../Clientes/llamar_rucs/',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('#datalist_rucs').html(data);
        }
    });
}

function llamar_cliente() {
    var id = $('input[name=cli_id]').val();
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

function llamar_cod(documento) {
    $.ajax({
        url: '../Notadebito/llamar_cod',
        type: "POST",
        dataType: "html",
        data: {
            'documento': documento,
        },
        success: function(data) {
            $('input[name=numero]').val(data);
            var table = $('.datatable').DataTable();
            table.ajax.reload();

        }
    });
}

function cod_producto(codart) {
    var str = codart;
    var res = str.split("-");
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
            } else {
                $('input[name=producto]').val(data[0].art_nombre);
                $('input[name=valor_venta_sin_igv]').val(data[0].art_precio_ventasinigv);
                $('input[name=pro_id]').val(data[0].id);
                var cantidad = $('input[name=cantidad]').val();
                var preciounitario = $('input[name=valor_venta_sin_igv]').val();
                var total = cantidad * preciounitario;
                $('input[name=total]').val(parseFloat(total).toFixed(2));
            }
        }
    });
}

function traer_datos_factura() {
    documento = $('select[name=documento_modi]').val();
    numero = $('input[name=numero_modi]').val();
    if (numero == '') {
        llamar_cliente();
    } else {
        $.ajax({
            url: '../Notadebito/traer_datos_factura',
            type: "POST",
            dataType: "json",
            data: {
                'documento': documento,
                'numero': numero,
            },
            success: function(data) {
                if (data.length > 0) {

                    if (documento == 1) {
                        $('input[name=cli_id]').val(data[0].fac_cli_id);
                        $('select[name=moneda]').val(data[0].fact_moneda);
                        if (data[0].fact_moneda == 'USD') {
                            $('input[name=tipocambio]').val();
                        }

                        llamar_cliente();
                    } else {
                        $('input[name=cli_id]').val(data[0].bol_cli_id);
                        $('select[name=moneda]').val(data[0].bol_moneda);
                        llamar_cliente();

                    }
                }
            }
        });
    }
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

function abre_ventana() {

    documento = $('select[name=documento_modi]').val();
    numero = $('input[name=numero_modi]').val();
    if (documento == '') {
        $('select[name=documento_modi]').focus();

    }
    if (numero == '') {
        $('input[name=numero_modi]').focus();

    } else {

        if ($('select[name=correlativo]').val() == null) {
            $('select[name=correlativo]').focus();
            return;
        }
        if ($('input[name=numero]').val() == '') {
            $('input[name=numero]').focus();
            return;
        } else {
            ventana = window.open('../Index/facturacionelectronica_nota_debito_tabla?documento=' + documento + '&numero=' + numero, "mywindow", 'toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=0,width=1000,height=650');
            ventana.focus();
        }
    }

}

function actualizar() {

    table = $('.datatable').DataTable();
    table.ajax.reload();
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
                alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Enviando <strong>Nota de Débito</strong> a <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});

            },
            success: function(response) {
                alertify.dismissAll();
                if (response == 1) {
                    alertify.notify('<strong>Nota de Débito</strong> enviada correctamente', 'custom-black', 5, function() {});
                    f[0].reset();

                }
                if (response == 0) {
                    alertify.notify('<strong>Nota de Débito</strong> guardada en base de datos pero no enviada', 'custom-black', 5, function() {});
                    f[0].reset();

                }
                if (response == 3) {
                    alertify.notify('<strong>Nota de Débito</strong> debete tener item de especificación ', 'custom', 5, function() {});

                }
            },
            error: function() {},
        });
    });
});

function eliminar(id) {

    $.ajax({
        url: '../Notadebito/eliminar',
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

function agregaritems() {

    var f = $('#form_agregar');
    var codpro = f.find('input[name=codproducto]').val();
    var correlativo = f.find('select[name=correlativo]').val();
    var numero = f.find('input[name=numero]').val();
    var producto = f.find('input[name=producto]').val();
    var cantidad = f.find('input[name=cantidad]').val();

    if (correlativo == null) {
        f.find('select[name=correlativo]').focus();

    } else if (f.find('input[name=numero_modi]').val() == '') {
        f.find('input[name=numero_modi]').focus()
    } else if (codpro == '') {

        f.find('input[name=codproducto]').focus();
    } else if (f.find('input[name=cantidad]').val() == '' || f.find('input[name=cantidad]').val() == 0) {
        f.find('input[name=cantidad]').focus()
    } else {
        $.ajax({
            url: '../Notadebito/guardar_items_directo/' + codpro + '|' + correlativo + '|' + numero + '|' + producto + '|' + cantidad + '|',
            type: 'POST',

            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(response) {
                console.log(response);
                table = $('.datatable').DataTable();
                table.ajax.reload();
                f.find('input[name=codproducto]').val('');

                f.find('input[name=producto]').val('');
                f.find('input[name=cantidad]').val('');
                f.find('input[name=valor_venta_sin_igv]').val('');
                f.find('input[name=codproducto]').focus();
            },
            error: function() {

            },
        });
    }
}