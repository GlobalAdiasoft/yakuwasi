$(document).ready(function() {
    $(".fechas_ui").datepicker({ dateFormat: 'yy-mm-dd' });
    $(".fechas_ui").change(function() {
        table.ajax.reload();
        totales_caja();
    })
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Caja2/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.fecha_inicio = $('input[name=fecha_inicio]').val();
                d.fecha_final = $('input[name=fecha_final').val();
            },
        },
        "columns": [{
                "data": "id"
            },
            /* {
                        "data": "usuario"
                    }, */
            {
                "data": "fecha"
            }, {
                "data": "modulo"
            }, {
                "data": "descripcion"
            }, {
                "data": "tipo_pago"
            }, {
                "data": "visa"
            }, {
                "data": "ingreso"
            }, {
                "data": "salida"
            },
        ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ]
    });
    totales_caja();
});

function totales_caja() {
    fechainicio = $('input[name=fecha_inicio]').val();
    fechafinal = $('input[name=fecha_final').val();
    table = $('.datatable').DataTable();
    $.ajax({
        url: '../Caja2/mostrar_totales',
        type: "GET",
        data: {
            'fecha_inicio': fechainicio,
            'fecha_final': fechafinal,
        },
        dataType: "json",
        success: function(data) {
            table.row.add({
                "id": "[]",
                "fecha": "<strong>INGRESO :</strong>",
                "modulo": "<strong>" + data.ingreso + "</strong>",
                "descripcion": "",
                "tipo_pago": "",
                "visa": "",
                "ingreso": "",
                "salida": "",
            }).draw();
            table.row.add({
                "id": "[]",
                "fecha": "<strong>VISA :</strong>",
                "modulo": "<strong>" + data.visa + "</strong>",
                "descripcion": "",
                "tipo_pago": "",
                "visa": "",
                "ingreso": "",
                "salida": "",
            }).draw();
            table.row.add({
                "id": "[]",
                "fecha": "<strong>SALIDA :</strong>",
                "modulo": "<strong>" + data.salida + "</strong>",
                "descripcion": "",
                "tipo_pago": "",
                "visa": "",
                "ingreso": "",
                "salida": "",
            }).draw();
            table.row.add({
                "id": "[]",
                "fecha": "<strong>SALDO :</strong>",
                "modulo": "<strong>" + data.saldo + "</strong>",
                "descripcion": "",
                "tipo_pago": "",
                "visa": "",
                "ingreso": "",
                "salida": "",
            }).draw();
        }
    });
}