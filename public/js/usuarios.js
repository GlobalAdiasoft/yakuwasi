$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../User/mostrar_usuarios',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "usu_nombres"
        }, {
            "data": "usu_apellidos"
        }, {
            "data": "usu_email"
        }, {
            "data": "usu_telefono"
        }, {
            "data": "usu_celular"
        }, {
            "data": "usu_dni"
        }, {
            "data": "usu_fechaalta"
        }, {
            "data": "usu_usuario"
        }, {
            "data": "usu_acceso"
        }, {
            "defaultContent": "<button id='btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
        }, {
            "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm' onclick='eliminar_usuario()'><i class='far fa-trash-alt'></i></button>"
        }, {
            "defaultContent": "<button id='btn_editar_pass' class='btn btn-success btn-sm'><i class='fa fa-lock' aria-hidden='true'></i></button>"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
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
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el usuario <strong>#' + rowData['id'] + '</strong>?',
                function() {
                    eliminar_usuario(rowData['id']);
                    alertify.notify('Se elimino el usuario <strong>#' + rowData['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });



        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el usuario <strong>#' + data['id'] + '</strong>?',
                function() {

                    eliminar_usuario(data['id']);
                    alertify.notify('Se elimino el usuario <strong>#' + data['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                },
                function() {
                    alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });

        }
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
    $('.datatable tbody').on('click', '#btn_editar_pass', function() {
        var data = table.row($(this).parents('tr')).data();

        if (data == undefined) {

            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }

            var rowData = $('.datatable').DataTable().row(selected_row).data();


            editar_password(rowData['id']);
            $('#btn_editar_pass_modal').trigger('click');

        } else {
            editar_password(data['id']);
            $('#btn_editar_pass_modal').trigger('click');
        }
    });
    abrir_modal('modalusuario', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Usuario');
    abrir_modal('modalpassword', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Contraseña');
});

function eliminar_usuario(id) {
    $.ajax({
        url: '../User/eliminar_usuario',
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
$(function() {
    $("#form_agregar_usuario").on("submit", function(e) {
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
                $('#form_agregar_usuario .loading').show();
            },
            success: function(data) {
                $('#form_agregar_usuario .loading').hide();
                if (data == 0) {
                    $("#form_agregar_usuario .form-control").each(function() {
                        if ($(this).val() == "") {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem rgba(0,123,255,0.25)'
                            });
                        } else {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem transparent'
                            });
                        }
                    });
                    $('#form_agregar_usuario #emailHelp').html('<i class="fa fa-times" aria-hidden="true"></i> Rellene los campos que faltan');
                    $('#form_agregar_usuario #emailHelp').css({
                        'color': '#1B3156',
                    });
                    return;
                } else {
                    $("#form_agregar_usuario .form-control").each(function() {
                        $(this).css({
                            'box-shadow': ' 0 0 0 0.2rem transparent'
                        });
                    });
                }
                if (data == 1) {
                    $("#form_agregar_usuario input[name=email]").css({
                        'box-shadow': ' 0 0 0 0.2rem rgba(0,123,255,0.25)'
                    });
                    $("#form_agregar_usuario input[name=email]").focus();
                    $('#form_agregar_usuario #emailHelp').html('<i class="fa fa-times" aria-hidden="true"></i> El correo ya existe');
                    $('#form_agregar_usuario #emailHelp').css({
                        'color': '#1B3156',
                    });
                    return;
                } else {
                    $("#form_agregar_usuario input[name=email]").css({
                        'box-shadow': ' 0 0 0 0.2rem transparent'
                    });
                }
                if (data == 2) {
                    $("#form_agregar_usuario input[name=usuario]").css({
                        'box-shadow': ' 0 0 0 0.2rem rgba(0,123,255,0.25)'
                    });
                    $("#form_agregar_usuario input[name=usuario]").focus();
                    $('#form_agregar_usuario #emailHelp').html('<i class="fa fa-times" aria-hidden="true"></i> El usuario ya existe');
                    $('#form_agregar_usuario #emailHelp').css({
                        'color': '#1B3156',
                    });
                    return;
                } else {
                    $("#form_agregar_usuario input[name=usuario]").css({
                        'box-shadow': ' 0 0 0 0.2rem transparent'
                    });
                }
                if (data == 3) {
                    f[0].reset();
                    $('#form_agregar_usuario #emailHelp').html('<i class="fa fa-check" aria-hidden="true"></i> Usuario creado correctamente');
                    $('#form_agregar_usuario #emailHelp').css({
                        'color': '#1D95D2',
                    });
                    $("#form_agregar_usuario input[name=nombres]").focus();
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                }
            },
            error: function() {},
        });
    });
});

function editar_usuario(id) {
    $('#form_modificar_usuario').show();

    alertify.modalusuario($('#form_modificar_usuario')[0]).set('selector', 'input[name="nombres"]');
    $.ajax({
        url: '../User/mostrar_usuario',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {
            var form = $('#form_modificar_usuario');
            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=nombres]').val(data[0].usu_nombres);
            form.find('input[name=apellidos]').val(data[0].usu_apellidos);
            form.find('input[name=email]').val(data[0].usu_email);
            form.find('input[name=telefono]').val(data[0].usu_telefono);
            form.find('input[name=celular]').val(data[0].usu_celular);
            form.find('input[name=dni]').val(data[0].usu_dni);
            form.find('input[name=usuario]').val(data[0].usu_usuario);
            form.find('select[name=acceso]').val(data[0].usu_acceso);
        }
    });
}

function editar_password(id) {
    $('#form_modificar_password').show();
    alertify.modalpassword($('#form_modificar_password')[0]).set('selector', 'input[name="password"]');
    var form = $('#form_modificar_password');
    form.find('input[name=id]').val(id);
};
$(function() {
    $("#form_modificar_usuario").on("submit", function(e) {
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
                $("#form_modificar_usuario .loading").show();
            },
            success: function(response) {
                $("#form_modificar_usuario .loading").hide();
                if (response == 0) {
                    $("#form_modificar_usuario .form-control").each(function() {
                        if ($(this).val() == "") {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem rgba(0,123,255,0.25)'
                            });
                        } else {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem transparent'
                            });
                        }
                    });
                    $("#form_modificar_usuario #emailHelp").html('<i class="fa fa-times" aria-hidden="true"></i> Rellene los campos que faltan');
                    return;
                }
                if (response == 1) {

                    f[0].reset();
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                    $("#form_modificar_usuario #emailHelp").html(' ');
                }
                alertify.modalusuario().close();
                alertify.notify('<strong>Datos</strong> modificados correctamente.', 'custom-black', 3, function() {});
            },
            error: function() {},
        });
    });
});
$(function() {
    $("#form_modificar_password").on("submit", function(e) {
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
                if (response == 0) {
                    $("#form_modificar_password .form-control").each(function() {
                        if ($(this).val() == "") {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem rgba(0,123,255,0.25)'
                            });
                        } else {
                            $(this).css({
                                'box-shadow': ' 0 0 0 0.2rem transparent'
                            });
                        }
                    });
                    $("#form_modificar_password #emailHelp").html('<i class="fa fa-times" aria-hidden="true"></i> Rellene los campos que faltan');
                }
                if (response == 1) {

                    f[0].reset();
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                    $("#form_modificar_password #emailHelp").html(' ');
                }
                alertify.modalpassword().close();
                alertify.notify('<strong>Password</strong> modificado correctamente.', 'custom-black', 3, function() {});
            },
            error: function() {},
        });
    });
});