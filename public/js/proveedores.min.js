$(document).ready(function() {
    ubigeo_all();
    $('#btn_datos_sunat').click(function() {
        var caracter = $('#form_agregar input[name=ruc]').val().length;
        if (caracter === 8) {
            alertify.notify('No hay conexión <strong>Reniec</strong>', 'custom', 3, function() {});
        } else if (caracter === 11) {
            obtener_datos_sunat();
        } else {
            alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 3, function() {});
            $('#form_agregar')[0].reset();
            $("#form_agregar select[name=ubigeo]").select2({
                placeholder: "Seleccione Ciudad,Provincia,Distrito",
                allowClear: true
            });
        }
    });
    $('#btn_datos_sunat_modificar').click(function() {
        var caracter = $('#form_modificar input[name=ruc]').val().length;
        if (caracter === 8) {
            dalertify.notify('No hay conexión <strong>Reniec</strong>', 'custom', 3, function() {});
        } else if (caracter === 11) {
            obtener_datos_sunat_modificar();
        } else {
            alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 3, function() {});
        }
    });
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Proveedores/mostrar',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "pro_ruc"
        }, {
            "data": "pro_razonsocial"
        }, {
            "data": "pro_sectorcomercial"
        }, {
            "data": "pro_ubigeo"
        }, {
            "data": "pro_direccion"
        }, {
            "data": "pro_telefono"
        }, {
            "data": "pro_correo"
        }, {
            "data": "pro_ctasoles"
        }, {
            "data": "pro_ctadolares"
        }, {
            "defaultContent": "<button id='btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
        }, {
            "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
        }, ],
    });
    $('.datatable tbody').on('click', '#btn_eliminar', function() {
        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable').DataTable().row(selected_row).data();
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el proveedor <strong>' + rowData['pro_razonsocial'] + '</strong>?', function() {
                eliminar(rowData['id']);
                alertify.notify('Se elimino el proveedor <strong>' + rowData['pro_razonsocial'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el proveedor <strong>' + data['pro_razonsocial'] + '</strong>?', function() {
                eliminar(data['id']);
                alertify.notify('Se elimino el proveedor <strong>' + data['pro_razonsocial'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', {
                ok: 'Eliminar',
                cancel: 'Cancelar'
            });
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
            editar(rowData['id']);
        } else {
            editar(data['id']);
        }
    });
    abrir_modal('modalproveedor', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Proveedor');
});

function ubigeo_all() {
    $.ajax({
        url: '../Ubigeo/ubigeo_all',
        type: "POST",
        dataType: "html",
        success: function(data) {
            $('select[name=ubigeo]').append(data);
            $('select[name=ubigeo]').select2({
                theme: "bootstrap",
            });
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
                if (data == 'ruc') {
                    alertify.notify('Campo <strong>ruc</strong> vacío.', 'custom', 4, function() {});
                    $("#form_agregar input[name=ruc]").focus();
                }
                if (data == 'razonsocial') {
                    alertify.notify('Campo <strong>razon social</strong> vacío.', 'custom', 4, function() {});
                    $("#form_agregar input[name=razonsocial]").focus();
                }
                if (data == 'ubigeo') {
                    alertify.notify('Campo <strong>ubigeo</strong> vacío.', 'custom', 4, function() {});
                    $("#form_agregar select[name=ubigeo]").focus();
                }
                if (data == 'direccion') {
                    alertify.notify('Campo <strong>dirección</strong> vacío.', 'custom', 4, function() {});
                    $("#form_agregar input[name=direccion]").focus();
                }
                if (data == 0) {
                    f[0].reset();
                    $("#form_agregar input[name=ruc]").focus();
                    table = $('.datatable').DataTable();
                    table.ajax.reload();
                    alertify.notify('Se agrego <strong>proveedor</strong> correctamente.', 'custom-black', 4, function() {})
                };
            },
            error: function() {},
        });
    });
});

function eliminar(id) {
    $.ajax({
        url: '../Proveedores/eliminar',
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
    $('#form_modifica select[name=ubigeo]').select2('destroy');
    $('#form_modificar').show();
    alertify.modalproveedor($('#form_modificar')[0]).set('selector', 'input[name="ruc"]');
    $.ajax({
        url: '../Proveedores/mostrar_proveedor',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {
            var form = $('#form_modificar');
            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=ruc]').val(data[0].pro_ruc);
            form.find('input[name=razonsocial]').val(data[0].pro_razonsocial);
            form.find('input[name=sectorcomercial]').val(data[0].pro_sectorcomercial);
            form.find('select[name=ubigeo]').val(data[0].pro_ubigeo);
            form.find('textarea[name=direccion]').val(data[0].pro_direccion);
            form.find('textarea[name=telefono]').val(data[0].pro_telefono);
            form.find('input[name=email]').val(data[0].pro_correo);
            form.find('input[name=ctasoles]').val(data[0].pro_ctasoles);
            form.find('input[name=ctadolares]').val(data[0].pro_ctadolares);
            $("#form_modificar select[name=ubigeo]").select2({
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
                alertify.modalproveedor().close();
                alertify.notify('<strong>Proveedor</strong> modificado correctamente.', 'custom-black', 3, function() {});
            },
            error: function() {},
        });
    });
});

function obtener_datos_sunat() {
    ruc = $('#form_agregar input[name=ruc]').val();
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
            console.log(data);
            alertify.dismissAll();
            if (Object.entries(data).length === 0) {
                alertify.notify('No se encontro <strong>RUC ó DNI</strong>', 'custom', 4, function() {});
                $('#form_agregar input[name=ruc]').focus();
                $('#form_agregar')[0].reset();
                $("#form_agregar select[name=ubigeo]").select2({
                    placeholder: "Seleccione Ciudad,Provincia,Distrito",
                    allowClear: true
                });
            } else {
                alertify.notify('<strong>DATOS</strong> obtenidos correctamente', 'custom-black', 4, function() {});
                f = $('#form_agregar');
                f.find('select[name=ubigeo]').select2('destroy');
                f.find('input[name=razonsocial]').val(data['result']['RazonSocial']);
                f.find('select[name=ubigeo]').val(data['Id_ubigeo']);
                f.find('textarea[name=direccion]').val(data['Direccion_corregida']);
                f.find("select[name=ubigeo]").select2({
                    theme: "bootstrap",
                });
            }
        },
        error: function(data) {
            console.log(data);
            alertify.dismissAll();
            alertify.notify('No hay conexión con <strong>SUNAT</strong>,vuelva a intentarlo o ingrese manualmente', 'custom', 6, function() {});
            $('#form_agregar input[name=ruc]').focus();
            $('#form_agregar')[0].reset();
            $("#form_agregar select[name=ubigeo]").select2({
                placeholder: "Seleccione Ciudad,Provincia,Distrito",
                allowClear: true
            });
        },
    });
}

function obtener_datos_sunat_modificar() {
    ruc = $('#form_modificar input[name=ruc]').val();
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
                $('#form_modificar input[name=ruc]').focus();
            } else {
                alertify.notify('<strong>DATOS</strong> obtenidos correctamente', 'custom-black', 4, function() {});
                f = $('#form_modificar');
                f.find('select[name=ubigeo]').select2('destroy');
                f.find('input[name=razonsocial]').val(data['result']['RazonSocial']);
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