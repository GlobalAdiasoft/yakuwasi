 $(document).ready(function() {

     var table = $('.datatable').DataTable({
         "ajax": {
             "url": '../Ubicacion/mostrar',
             "dataSrc": ""
         },
         "columns": [{
             "data": "id"
         }, {
             "data": "nombre"
         }, {
             "defaultContent": "<button id='btn_eliminar' class='btn btn-danger btn-sm'><i class='far fa-trash-alt'></i></button>"
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
             alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la ubicacion <strong>' + rowData['nombre'] + '</strong>?',
                 function() {
                     eliminar(rowData['id']);
                     alertify.notify('Se elimino la ubicacion <strong>' + rowData['nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                 },
                 function() {
                     alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                 }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
         } else {
             alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la ubicacion <strong>' + data['nombre'] + '</strong>?',
                 function() {
                     eliminar(data['id']);
                     alertify.notify('Se elimino la ubicacion <strong>' + data['nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                 },
                 function() {
                     alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                 }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
         }
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

                 f[0].reset();
                 $("#form_agregar input[name=nombre]").focus();
                 table = $('.datatable').DataTable();
                 table.ajax.reload();
                 alertify.notify('Se agrego <strong>Ubicacion</strong> correctamente.', 'custom-black', 4, function() {})

             },
             error: function() {},
         });
     });
 });

 function eliminar(id) {
     $.ajax({
         url: '../Ubicacion/eliminar',
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