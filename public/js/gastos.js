$(document).ready(function() {
    $(".fechas_ui").datepicker({ dateFormat: 'yy-mm-dd' });
    listar_proveedores();
    listar_usuarios();
    $(".fechas_ui").change(function() {
        table.ajax.reload();
        totales();
    });
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Gastos/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.fecha_inicio = $('input[name=fecha_inicio]').val();
                d.fecha_final = $('input[name=fecha_final').val();
            },
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "fecha"
        }, {
            "data": "impuesto"
        }, {
            "data": "costo_total"
        }, {
            "data": "costo"
        }, {
            "data": "porcentaje_impuesto"
        }, {
            "data": "descripcion"
        }, {
            "data": "usuario"
        }, {
            "data": "razon"
        }, {
            "data": "categoria"
        }, {
            "data": "documento"
        }, {
            "data": "correlativo"
        }, {
            "data": "numero"
        }, {
            "data": "proveedor"
        }, {
            "data": "aprobado"
        }, {
            "data": "nota"
        }, {
            "data": "retiro"
        }, {
            "data": "condicion"
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
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el gasto <strong>' + rowData['id'] + '</strong>?', function() {
                eliminar(rowData['id']);
                alertify.notify('Se elimino el gasto <strong>' + rowData['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        } else {
            alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el gasto <strong>' + data['id'] + '</strong>?', function() {
                eliminar(data['id']);
                alertify.notify('Se elimino el gasto <strong>' + data['id'] + '</strong> correctamente.', 'custom-black', 4, function() {});
            }, function() {
                alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
            }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
        }
    });
    abrir_modal('modalmodificar', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Gasto');
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
});

function listar_proveedores() {
    $.ajax({
        url: '../Gastos/mostrar_proveedores',
        success: function(data) {
            $('select[name=proveedor]').html(data);
        },
    });
}

function listar_usuarios() {
    $.ajax({
        url: '../Gastos/mostrar_empleados',
        success: function(data) {
            $('select[name=aprobado]').html(data);
        },
    });
}
$(function() {
    $("#form_agregar1").on("submit", function(e) {
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
                $("#form_agregar input[name=fecha]").focus();
                table = $('.datatable').DataTable();
                table.ajax.reload();
                alertify.notify('Se agrego el <strong>Gasto</strong> correctamente.', 'custom-black', 4, function() {})
            },
            error: function() {},
        });
    });
});

function eliminar(id) {
    $.ajax({
        url: '../Gastos/eliminar',
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
    alertify.modalmodificar($('#form_modificar')[0]);
    $.ajax({
        url: '../Gastos/mostrar_gasto',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
        },
        success: function(data) {
            var form = $('#form_modificar');
            form.find('input[name=id]').val(data[0].id);
            form.find('input[name=fecha]').val(data[0].fecha);
            form.find('select[name=impuesto]').val(data[0].impuesto);
            form.find('input[name=costo_total]').val(data[0].costo_total);
            form.find('input[name=costo]').val(data[0].costo);
            form.find('input[name=porcentaje_impuesto]').val(data[0].porcentaje_impuesto);
            form.find('input[name=descripcion]').val(data[0].descripcion);
            form.find('input[name=razon]').val(data[0].razon);
            form.find('select[name=categoria]').val(data[0].categoria);
            form.find('select[name=documento]').val(data[0].documento);
            form.find('input[name=correlativo]').val(data[0].correlativo);
            form.find('input[name=numero]').val(data[0].numero);
            form.find('select[name=proveedor]').val(data[0].proveedor);
            form.find('select[name=aprobado]').val(data[0].aprobado);
            form.find('input[name=nota]').val(data[0].nota);
            form.find('input[name=retiro]').val(data[0].retiro);
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
                alertify.notify('<strong>Gasto</strong> modificada correctamente.', 'custom-black', 3, function() {});
            },
            error: function() {},
        });
    });
});

function totales() {
    alert('hola');
    var fecha_incio = $('input[name=fecha_inicio]').val();
    var fecha_final = $('input[name=fecha_final]').val();
    $.ajax({
        url: '../Gastos/mostrar_totales',
        type: "post",
        dataType: "json",
        data: {
            'fecha_incio': fecha_incio,
            'fecha_final': fecha_final,
        },
        success: function(data) {
            console.log(data);
        }
    });
}