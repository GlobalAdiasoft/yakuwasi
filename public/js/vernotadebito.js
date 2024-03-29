$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "ajax": {
            "url": '../Vernotadebito/mostrar',
            "dataSrc": ""
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "nota_fecha"
        }, {
            "data": "nota_correlativo"
        }, {
            "data": "nota_numero"
        }, {
            "data": "nota_documento_modificar"
        }, {
            "data": "nota_numero_modificar"
        }, {
            "data": "nota_envio_sunat"
        }, {
            "data": "nota_pdf"
        }, {
            "data": "nota_xml"
        }, {
            "data": "nota_cdr"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
        ],
        "order": [
            [2, "desc"]
        ]
    });
});