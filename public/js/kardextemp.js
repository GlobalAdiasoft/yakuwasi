  $(document).ready(function() {
      var table = $('.datatable').DataTable({
          "ajax": {
              "url": '../Kardex/mostrar_kardex',
              "dataSrc": ""
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
              "data": "observaciones"
          }, ],
          "language": {
              "url": "../public/fw/datatables/Spanish.json"
          },
          "lengthMenu": [
              [10, 15, 20, -1],
              [10, 15, 20, "All"]
          ]
      });
  });