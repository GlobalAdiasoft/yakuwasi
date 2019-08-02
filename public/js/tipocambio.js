 $(document).ready(function() {
     var table = $('.datatable').DataTable({
         "ajax": {
             "url": '../Tipocambio/mostrar',
             "dataSrc": ""
         },
         "columns": [{
             "data": "id"
         }, {
             "data": "cam_fecha"
         }, {
             "data": "cam_compra"
         }, {
             "data": "cam_venta"
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

                 alertify.notify('Se agrego <strong>tipo de cambio</strong> correctamente.', 'custom-black', 4, function() {})
                 table = $('.datatable').DataTable();
                 table.ajax.reload();

             },
             error: function() {},
         });
     });
 });