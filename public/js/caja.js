$(document).ready(function() {
    $(".fechas_ui").datepicker({ dateFormat: 'yy-mm-dd' });
    $(".fechas_ui").change(function() {

        table.ajax.reload();
        totales_caja();

    })
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Caja/mostrar',
            "dataSrc": "",
            "data": function(d) {
                d.fecha_inicio = $('input[name=fecha_inicio]').val();
                d.fecha_final = $('input[name=fecha_final').val();


            },
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "total"
        }, {
            "data": "pago"
        }, {
            "data": "vuelto"
        }, {
            "data": "usuario"
        }, {
            "data": "fecha"
        }, {
            "data": "documento"
        }, {
            "data": "numero"
        }, ],
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
        url: '../Caja/mostrar_totales',
        type: "GET",
        data: {
            'fecha_inicio': fechainicio,
            'fecha_final': fechafinal,
        },
        dataType: "json",

        success: function(data) {

            table.row.add({
                "id": "[]",
                "total": "<strong>TOTAL :</strong>",
                "pago": "<strong>" + data.total + "</strong>",
                "vuelto": "",
                "usuario": "",
                "fecha": "",
                "documento": "",
                "numero": "",

            }).draw();
            table.row.add({
                "id": "[]",
                "total": "<strong>RECIBIDO :</strong>",
                "pago": "<strong>" + data.pago + "</strong>",
                "vuelto": "",
                "usuario": "",
                "fecha": "",
                "documento": "",
                "numero": "",

            }).draw();
            table.row.add({
                "id": "[]",
                "total": "<strong>VUELTO :</strong>",
                "pago": "<strong>" + data.vuelto + "</strong>",
                "vuelto": "",
                "usuario": "",
                "fecha": "",
                "documento": "",
                "numero": "",

            }).draw();

        }
    });
}