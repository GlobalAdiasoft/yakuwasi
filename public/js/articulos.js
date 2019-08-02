$(document).ready(function() {

    $('input[name=nombre]').focus();
    $('#form_agregar input[name=ganancia]').change(function() {
        $("#form_agregar input[name=produ_precio_compra_conigv]").trigger("change");
    });
    $('#form_modificar input[name=ganancia]').change(function() {
        $("#form_modificar input[name=produ_precio_compra_conigv]").trigger("change");
    });
    $('#form_agregar input[name=produ_precio_compra_conigv]').change(function() {
        var ganancia = $('#form_agregar input[name=ganancia]').val();
        if (ganancia == 0 || ganancia == '') {
            ganancia = 0;
        }
        var precio = parseFloat($(this).val());
        $('#form_agregar input[name=produ_precio_compra_sinigv]').val(precio / 1.18);
        $('#form_agregar input[name=produ_precio_ventaconigv]').val(((precio * ganancia / 100) + precio) * 1.18);

        var precio_ventaconigv = $('#form_agregar input[name=produ_precio_ventaconigv]').val();
        $('#form_agregar input[name=produ_precio_ventasinigv]').val(precio_ventaconigv / 1.18);

    });
    $('#form_agregar input[name=produ_precio_compra_sinigv]').change(function() {
        var precio = parseFloat($(this).val());
        var ganancia = $('#form_agregar input[name=ganancia]').val();
        if (ganancia == 0 || ganancia == '') {
            ganancia = 0;
        }
        $('#form_agregar input[name=produ_precio_compra_conigv]').val(Math.round10(precio * 1.18));
        var precion_con = parseFloat($('#form_agregar input[name=produ_precio_compra_conigv]').val());
        $('#form_agregar input[name=produ_precio_ventaconigv]').val(((parseFloat(precion_con * ganancia / 100)) + parseFloat(precion_con)) * 1.18);
        $('#form_agregar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_agregar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });


    $('#form_modificar input[name=produ_precio_compra_conigv]').change(function() {
        var ganancia = $('#form_modificar input[name=ganancia]').val();
        if (ganancia == 0 || ganancia == '') {
            ganancia = 0;
        }
        var precio = parseFloat($(this).val());
        $('#form_modificar input[name=produ_precio_compra_sinigv]').val(precio / 1.18);
        $('#form_modificar input[name=produ_precio_ventaconigv]').val(((precio * ganancia / 100) + precio) * 1.18);

        var precio_ventaconigv = $('#form_modificar input[name=produ_precio_ventaconigv]').val();
        $('#form_modificar input[name=produ_precio_ventasinigv]').val(precio_ventaconigv / 1.18);

    });
    $('#form_modificar input[name=produ_precio_compra_sinigv]').change(function() {
        var precio = parseFloat($(this).val());
        var ganancia = $('#form_modificar input[name=ganancia]').val();
        if (ganancia == 0 || ganancia == '') {
            ganancia = 0;
        }
        $('#form_modificar input[name=produ_precio_compra_conigv]').val(Math.round10(precio * 1.18));
        var precion_con = parseFloat($('#form_modificar input[name=produ_precio_compra_conigv]').val());
        $('#form_modificar input[name=produ_precio_ventaconigv]').val(((parseFloat(precion_con * ganancia / 100)) + parseFloat(precion_con)) * 1.18);
        $('#form_modificar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_modificar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });

    $('#form_agregar input[name=produ_precio_ventaconigv]').change(function() {

        $('#form_agregar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_agregar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });
    $('#form_modificar input[name=produ_precio_ventaconigv]').change(function() {

        $('#form_modificar input[name=produ_precio_ventasinigv]').val(parseFloat($('#form_modificar input[name=produ_precio_ventaconigv]').val()) / 1.18);
    });
    $("#form_agregar input[name=nombre]").change(function() {
        var letras = $(this).val().substring(0, 3);
        var numeros = $(this).val().length;
        $("#form_agregar input[name=cod_articulo]").val(letras + numeros + '_art');
        $("#form_agregar input[name=codbarras]").val(letras + numeros + '_art');
        mostrar_cod_bar(letras + numeros + '_art');
        var datos = letras + numeros + '_art';
        var file_es = $("#file_especificacion").uploadFile({
            url: '../Articulos/upload_especificacion/',
            fileName: "especificaciontecnica",
            acceptFiles: '.pdf',
            allowedTypes: 'pdf',
            autoSubmit: true,
            formData: {
                archivo: datos,
            },
            maxFileSize: 5000000,
        })
        var file_im = $("#file_imagen").uploadFile({
            url: "../Articulos/upload_imagen",
            fileName: "imagen",
            acceptFiles: 'image/*',
            autoSubmit: true,
            formData: {
                archivo: datos,
            },
            maxFileSize: 5000000,
        });
        $('.resetdatos').click(function() {
            file_es.reset();
            file_im.reset();
        });
    });
    mostrar_familia();
    mostrar_marca();
    mostrar_fabricante();
    mostrar_unidad_medida();
    mostrar_proveedor();
    mostrar_ubicacion();
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Articulos/mostrar',
            "dataSrc": ""
        },
        "columns": [{
                "data": "id"
            }, {
                "data": "art_nombre"
            }, {
                "data": "art_familia"
            }, {
                "data": "art_marca"
            }, {
                "data": "art_fabricante"
            }, {
                "data": "art_descripcion"
            }, {
                "data": "art_unidadmedida"
            }, {
                "data": "art_ubicacion"
            }, {
                "data": "art_stock" //art_stock
            }, {
                "data": "art_stockminimo"
            }, {
                "data": "art_codigo"
            }, {
                "data": "art_especificaciontecnica"
            }, {
                "data": "art_imagen"
            }, {
                "data": "art_estado"
            }, {
                "data": "art_proveedor"
            }, {
                "data": "art_impuesto"
            }, {
                "data": "art_codbarras"
            }, {
                "data": "art_moneda"
            }, {
                "data": "art_ganancia"
            }, {
                "data": "art_precio_compra_sinigv"
            }, {
                "data": "art_precio_compra_conigv"
            }, {
                "data": "art_precio_ventasinigv"
            }, {
                "data": "art_precio_ventaconigv"
            }, {
                "data": "art_codusuario"
            }, {
                "data": "art_fechaalta"
            }, {
                "defaultContent": "<button id='btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
            }, {
                "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
            },
            /*{
                       "defaultContent": "<button id='btn_editar_especificaciones' class='btn btn-warning btn-sm'><i class='far fa-file-pdf'></i></button>"
                   }, {
                       "defaultContent": "<button id='btn_editar_imagenes' class='btn btn-success btn-sm'><i class='far fa-images'></i></button>"
                   },*/
            {
                "defaultContent": "<button id='btn_kardex' class='btn btn-info btn-sm'>Kardex</button>"
            },
        ],
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
    var table1 = $('.datatable1').DataTable({
        "ajax": {
            "url": '../Kardex/mostrar_kardex',
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
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el artículo <strong>' + rowData['art_nombre'] + '</strong>?', function() {
                eliminar(rowData['id']);
                alertify.notify('Se elimino el artículo <strong>' + rowData['art_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el artículo <strong>' + data['art_nombre'] + '</strong>?', function() {
                eliminare(data['id']);
                alertify.notify('Se elimino el artículo <strong>' + data['art_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        };
    });
    $('.datatable tbody').on('click', '#btn_editar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            modificar(rowData['id']);
        } else {
            modificar(data['id']);
        }
    });
    $('.datatable tbody').on('click', '#btn_kardex', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            modal_kardex(rowData['id']);
        } else {
            modal_kardex(data['id']);
        }
    });
    $('.datatable tbody').on('click', '#btn_editar_especificaciones', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            modificar_especificaciones(rowData['id']);
        } else {
            modificar_especificaciones(data['id']);
        }
    });
    $('.datatable tbody').on('click', '#btn_editar_imagenes', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            modificar_imagenes(rowData['id']);
        } else {
            modificar_imagenes(data['id']);
        }
    });
    abrir_modal('modalagregar', '<i class="fa fa-bars" aria-hidden="true"></i> Agregar Artículo <br> <small><i class="far fa-edit"></i> Aquí podrá agregar nuevos artículos.</small>');
    abrir_modal('modalmodificar', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Articulo <br> <small><i class="far fa-edit"></i> Aquí podrá modificar los artículos.</small>');
    abrir_modal('modalkardex', '<i class="fa fa-bars" aria-hidden="true"></i> Kadex Artículo');

    $('#btn_agregar').click(function() {
        $('#form_agregar').show();
        alertify.modalagregar($('#form_agregar')[0]).set('selector', 'input[name="nombre"]');
        actualizar_select2();
    });
});

function mostrar_familia() {
    $.ajax({
        url: '../Familias/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = familia]').append(data);
            $('select[name = familia]').select2();
        }
    });
}

function mostrar_marca() {
    $.ajax({
        url: '../Marcas/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = marca]').append(data);
            $('select[name = marca]').select2();
            actualizar_select2();
        }
    });
}

function mostrar_ubicacion() {
    $.ajax({
        url: '../Ubicacion/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = ubicacion]').append(data);
            $('select[name = ubicacion]').select2();
            actualizar_select2();
        }
    });
}

function mostrar_fabricante() {
    $.ajax({
        url: '../Fabricantes/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = fabricante]').append(data);
            $('select[name = fabricante]').select2();
            actualizar_select2();
        }
    });
}

function mostrar_unidad_medida() {
    $.ajax({
        url: '../Unidades/mostrar_select',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name = unidad_medida]').append(data);
            $('select[name = unidad_medida]').select2();
        }
    });
}

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

function mostrar_cod_bar(code) {
    $.ajax({
        url: '../Barcode/generar',
        type: "POST",
        dataType: "html",
        data: {
            'code': code,
        },
        success: function(data) {
            $('#imagen_cod_bar').html(data);
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
                if (data == 0) {
                    $('input[name=nombre]').focus();
                    alertify.notify('Ya existe articulo con ese nombre.', 'custom', 4, function() {});
                    return;
                } else {
                    $('#form_agregar select[name = familia]').select2('destroy');
                    $('#form_agregar select[name = marca]').select2('destroy');
                    $('#form_agregar select[name = fabricante]').select2('destroy');
                    $('#form_agregar select[name = unidad_medida]').select2('destroy');
                    $('#form_agregar select[name = proveedor]').select2('destroy');
                    f[0].reset();
                    $('#form_agregar select[name = familia]').select2();
                    $('#form_agregar select[name = marca]').select2();
                    $('#form_agregar select[name = fabricante]').select2();
                    $('#form_agregar select[name = unidad_medida]').select2();
                    $('#form_agregar select[name = proveedor]').select2();
                    $('input[name=nombre]').focus();
                    alertify.notify('Se agregro <strong>articulo</strong> correctamente.', 'custom-black', 4, function() {});
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                    alertify.modalagregar().close();
                }
                $(".resetdatos").trigger("click");
            },
            error: function() {},
        });
    });
});

function eliminar(id) {
    $.ajax({
        url: '../Articulos/eliminar',
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

function modificar(id) {
    $('#form_modificar').show();
    alertify.modalmodificar($('#form_modificar')[0]).set('selector', 'input[name="nombre"]');
    $.ajax({
        url: '../Articulos/mostrar_articulo',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {
            var form = $('#form_modificar');
            $('#form_modificar select[name=familia]').select2('destroy');
            $('#form_modificar select[name=marca]').select2('destroy');
            $('#form_modificar select[name=fabricante]').select2('destroy');
            $('#form_modificar select[name=unidad_medida]').select2('destroy');
            $('#form_modificar select[name=proveedor]').select2('destroy');
            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=nombre]').val(data[0].art_nombre);
            form.find('select[name=familia]').val(data[0].art_familia);
            form.find('select[name=marca]').val(data[0].art_marca);
            form.find('select[name=fabricante]').val(data[0].art_fabricante);
            form.find('textarea[name=descripcion]').val(data[0].art_descripcion);
            form.find('select[name=unidad_medida]').val(data[0].art_unidadmedida);
            form.find('select[name=ubicacion]').val(data[0].art_ubicacion);
            form.find('input[name=codbarras]').val(data[0].art_codbarras);
            form.find('input[name=cod_articulo]').val(data[0].art_codigo);
            form.find('select[name=estado]').val(data[0].art_estado);
            form.find('select[name=proveedor]').val(data[0].art_proveedor);
            form.find('input[name=impuesto]').val(data[0].art_impuesto);
            form.find('input[name=stock]').val(data[0].art_stock);
            form.find('input[name=stockminimo]').val(data[0].art_stockminimo);
            form.find('select[name=moneda]').val(data[0].art_moneda);

            form.find('input[name=ganancia]').val(data[0].art_ganancia)
            form.find('input[name=produ_precio_compra_sinigv]').val(data[0].art_precio_compra_sinigv);
            form.find('input[name=produ_precio_compra_conigv]').val(data[0].art_precio_compra_conigv);
            form.find('input[name=produ_precio_ventasinigv]').val(data[0].art_precio_ventasinigv);
            form.find('input[name=produ_precio_ventaconigv]').val(data[0].art_precio_ventaconigv);
            $('select[name = familia]').select2();
            $('select[name = marca]').select2();
            $('select[name = fabricante]').select2();
            $('select[name = unidad_medida]').select2();
            $('select[name = proveedor]').select2();
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
                if (response == 1) {
                    f[0].reset();
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                    alertify.modalmodificar().close();
                    alertify.notify('<strong>Datos</strong> modificados correctamente.', 'custom-black', 3, function() {});
                }
            },
            error: function() {},
        });
    });
});

function modificar_especificaciones(id) {
    $.ajax({
        url: '../Articulos/modificar_especificaciones',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {
            //table = $('.datatable').DataTable();
            //table.ajax.reload();

        }
    });
}

function modificar_imagenes() {
    alert('imagenes');
}

function modal_kardex(id) {

    $('#kardex').show();
    alertify.modalkardex($('#kardex')[0]);
    $('input[name=nrokardex]').val(id);
    table1 = $('.datatable1').DataTable();
    table1.ajax.reload();
}