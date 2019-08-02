$(document).ready(function() {

    mostrar_ubigeo();
    $('#btn_datos_sunat').click(function() {

        var caracter = $('#form_agregar_cliente input[name=ruc]').val().length;
        if (caracter === 8) {
            datos_dni($(this).val());
        } else if (caracter === 11) {
            obtener_datos_sunat();


        } else {
            alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 3, function() {});
            $('#form_agregar_cliente')[0].reset();
            $("#form_agregar_cliente select[name=ubigeo]").select2({
                placeholder: "Seleccione Ciudad,Provincia,Distrito",
                allowClear: true
            });

        }
    });
    $('#btn_datos_sunat_modificar').click(function() {

        var caracter = $('#form_modificar_cliente input[name=ruc]').val().length;

        if (caracter === 8) {
            datos_dni($(this).val());
        } else if (caracter === 11) {
            obtener_datos_sunat_modificar();


        } else {
            alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 3, function() {});


        }
    });
    $('#form_modificar_cliente input[name=ruc]').change(function() {
        var caracter = $(this).val().length;
        if (caracter === 8) {
            datos_dni_m($(this).val());
        } else if (caracter === 11) {
            datos_ruc_m($(this).val());
        } else {
            alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 3, function() {});

        }
    });

    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Clientes/mostrar_clientes',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "escribe"
        }, {
            "data": "cli_nombre"
        }, {
            "data": "cli_ubigeo"
        }, {
            "data": "cli_direccion"
        }, {
            "data": "cli_telefono"
        }, {
            "data": "cli_email"
        }, {
            "data": "cli_web"
        }, {
            "data": "cli_observacion"
        }, {
            "defaultContent": "<button id = 'btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
        }, {
            "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
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
    /*table.row.add({
        "id": "<strong>TOTAL</strong>",
        "cli_ruc": "",
        "cli_nombre": "",
        "cli_ubigeo": "",
        "cli_direccion": "",
        "cli_telefono": "",
        "cli_email": "",
        "cli_web": "",
        "cli_observacion": "",
        "defaultContent": "",
        "defaultContent": "",
    }).draw();
    table.row.add({
        "id": "<strong>TOTAL</strong>",
        "cli_ruc": "",
        "cli_nombre": "",
        "cli_ubigeo": "",
        "cli_direccion": "",
        "cli_telefono": "",
        "cli_email": "",
        "cli_web": "",
        "cli_observacion": "",
        "defaultContent": "",
        "defaultContent": "",
    }).draw();
    table.row.add({
        "id": "<strong>TOTAL</strong>",
        "cli_ruc": "",
        "cli_nombre": "",
        "cli_ubigeo": "",
        "cli_direccion": "",
        "cli_telefono": "",
        "cli_email": "",
        "cli_web": "",
        "cli_observacion": "",
        "defaultContent": "",
        "defaultContent": "",
    }).draw();*/
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {

            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }

            var rowData = $('.datatable').DataTable().row(selected_row).data();

            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el cliente <strong>#' + rowData['id'] + '</strong>?',
                function() {
                    eliminar_cliente(rowData['id']);
                    alertify.notify('Se elimino el cliente <strong>#' + rowData['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });


        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el cliente <strong>#' + data['id'] + '</strong>?',
                function() {

                    eliminar_cliente(data['id']);
                    alertify.notify('Se elimino el cliente <strong>#' + data['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });

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


            editar_usuario(rowData['id']);

        } else {
            editar_usuario(data['id']);

        }
    });
    abrir_modal('modalmodificarcliente', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Cliente');
});

function eliminar_cliente(id) {
    $.ajax({
        url: '../Clientes/eliminar_cliente',
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
                table = $('.datatable').DataTable();
                table.ajax.reload();
                f[0].reset();
            },
            error: function() {},
        });
    });
});

function editar_usuario(id) {
    $('#form_modificar_cliente').show();
    alertify.modalmodificarcliente($('#form_modificar_cliente')[0]).set('selector', 'input[name="ruc"]');
    $.ajax({
        url: '../Clientes/mostrar_cliente',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {

            var form = $('#form_modificar_cliente');
            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=nombres]').val(data[0].cli_nombre);
            form.find('select[name=ubigeo]').select2('destroy');
            form.find('select[name=ubigeo]').val(data[0].cli_ubigeo);
            form.find('textarea[name=direccion]').val(data[0].cli_direccion);
            form.find('textarea[name=telefono]').val(data[0].cli_telefono);
            form.find('input[name=celular]').val(data[0].cli_celular);
            form.find('input[name=email]').val(data[0].cli_email);
            form.find('input[name=web]').val(data[0].cli_web);
            form.find('input[name=ruc]').val(data[0].cli_ruc);
            form.find('textarea[name=observacion]').val(data[0].cli_observacion);
            form.find("select[name=ubigeo]").select2({
                theme: "bootstrap",
            });
        }
    });
}
$(function() {
    $("#form_modificar_cliente").on("submit", function(e) {
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
                    alertify.modalmodificarcliente().close();
                    alertify.notify('<strong>Datos</strong> modificados correctamente.', 'custom-black', 3, function() {});
                }
            },
            error: function() {},
        });
    });
});

function datos_ruc(ruc) {

    $.ajax({
        url: '../Sunat/datos',
        type: "POST",
        dataType: "json",
        data: {
            "ruc": ruc
        },
        beforeSend: function() {
            alertify.notify('Buscando ...', 'custom', 100, function() {});
        },

        success: function(data) {

            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 4, function() {});
                $('#form_agregar input[name=ruc]').focus();
            } else {
                $('#form_agregar_cliente select[name=ubigeo]').select2('destroy');
                $('#form_agregar_cliente input[name=nombres]').val(data.RazonSocial);
                $('#form_agregar_cliente textarea[name=direccion]').val(data.Direccion_corregida);
                $('#form_agregar_cliente select[name=ubigeo]').val(data.Id_ubigeo);
                $('#form_agregar_cliente select[name=ubigeo]').select2();
            };
        }
    });
}

function datos_dni(dni) {
    $.ajax({
        url: '../Reniec/datos',
        type: "POST",
        dataType: "json",
        data: {
            "dni": dni
        },
        success: function(data) {

            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>DNI</strong>', 'custom', 3, function() {});
            } else {
                $('#form_agregar_cliente input[name=nombres]').val(data.Nombres + ' ' + data.apellidos);
                $('#form_agregar_cliente textarea[name=direccion]').val(data.Departamento + '-' + data.Provincia + '-' + data.Distrito);
            }
        }
    });
}

function datos_ruc_m(ruc) {
    $.ajax({
        url: '../Sunat/datos',
        type: "POST",
        dataType: "json",
        data: {
            "ruc": ruc
        },
        success: function(data) {
            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 4, function() {});
                $('#form_agregar input[name=ruc]').focus();
            } else {

                $('#form_modificar_cliente input[name=nombres]').val(data.RazonSocial);
                $('#form_modificar_cliente textarea[name=direccion]').val(data.Direccion);


            };
        }
    });
}

function datos_dni_m(dni) {
    $.ajax({
        url: '../Reniec/datos',
        type: "POST",
        dataType: "json",
        data: {
            "dni": dni
        },
        success: function(data) {
            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>DNI</strong>', 'custom', 3, function() {});
            } else {
                $('#form_modificar_cliente input[name=nombres]').val(data.Nombres + ' ' + data.apellidos);
                $('#form_modificar_cliente textarea[name=direccion]').val(data.Departamento + '-' + data.Provincia + '-' + data.Distrito);
            }
        }
    });
}

function obtener_datos_sunat() {
    ruc = $('#form_agregar_cliente input[name=ruc]').val();
    $.ajax({
        url: '../Sunat/datos_jossmp',
        type: "POST",
        dataType: "json",
        data: {
            'ruc': ruc
        },
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Obteniendo <strong>DATOS</strong> <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});
        },
        success: function(data) {

            alertify.dismissAll();
            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 4, function() {});
                $('#form_agregar_cliente input[name=ruc]').focus();
                $('#form_agregar_cliente')[0].reset();
                $("#form_agregar_cliente select[name=ubigeo]").select2({
                    placeholder: "Seleccione Ciudad,Provincia,Distrito",
                    allowClear: true
                });
            } else {
                alertify.notify('<strong>DATOS</strong> obtenidos correctamente', 'custom-black', 4, function() {});
                f = $('#form_agregar_cliente');
                f.find('select[name=ubigeo]').select2('destroy');
                f.find('input[name=nombres]').val(data['result']['RazonSocial']);
                f.find('select[name=ubigeo]').val(data['Id_ubigeo']);
                f.find('textarea[name=direccion]').val(data['Direccion_corregida']);

                f.find("select[name=ubigeo]").select2({
                    theme: "bootstrap",
                });
            }
        },
        error: function(data) {

            alertify.dismissAll();
            alertify.notify('No hay conexión con <strong>SUNAT</strong>,vuelva a intentarlo o ingrese manualmente', 'custom', 6, function() {});
            $('#form_agregar_cliente input[name=ruc]').focus();
            $('#form_agregar_cliente')[0].reset();
            $("#form_agregar_cliente select[name=ubigeo]").select2({
                placeholder: "Seleccione Ciudad,Provincia,Distrito",
                allowClear: true
            });
        },
    });
}

function obtener_datos_sunat_modificar() {
    ruc = $('#form_modificar_cliente input[name=ruc]').val();
    $.ajax({
        url: '../Sunat/datos_jossmp',
        type: "POST",
        dataType: "json",
        data: {
            'ruc': ruc
        },
        beforeSend: function() {
            alertify.notify(' <img class="loading" src="../public/img/spinner.svg"> Obteniendo <strong>DATOS</strong> <img class="alertify-sunat" src="../public/img/sunat.png" alt="">', 'custom-black', 3600, function() {});
        },
        success: function(data) {

            alertify.dismissAll();
            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 4, function() {});
                $('#form_modificar_cliente input[name=ruc]').focus();


            } else {


                alertify.notify('<strong>DATOS</strong> obtenidos correctamente', 'custom-black', 4, function() {});
                f = $('#form_modificar_cliente');
                f.find('select[name=ubigeo]').select2('destroy');
                f.find('input[name=nombres]').val(data['result']['RazonSocial']);
                f.find('select[name=ubigeo]').val(data['Id_ubigeo']);
                f.find('textarea[name=direccion]').val(data['Direccion_corregida']);

                f.find("select[name=ubigeo]").select2({
                    theme: "bootstrap",
                });
            }
        },
        error: function() {
            alertify.dismissAll();
            alertify.notify('No hay conexión con <strong>SUNAT</strong>,vuelva a intentarlo o ingrese manualmente', 'custom', 6, function() {});

        },
    });
}