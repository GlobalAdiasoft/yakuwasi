   $(document).ready(function() {
       var table = $('.datatable').DataTable({
           "ajax": {
               "url": '../Unidades/mostrar',
               "dataSrc": ""
           },
           "columns": [{
               "data": "id"
           }, {
               "data": "uni_nombre"
           }, {
               "data": "uni_simbolo"
           }, {
               "defaultContent": "<button id='btn_editar' class='btn btn-info btn-sm' ><i class='fas fa-pencil-alt'></i></button>"
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
               alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la unidad de medida <strong>' + rowData['uni_nombre'] + '</strong>?',
                   function() {
                       eliminar(rowData['id']);
                       alertify.notify('Se elimino la unidad de medida <strong>' + rowData['uni_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                   },
                   function() {
                       alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                   }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
           } else {
               alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar la unidad de medida <strong>' + data['uni_nombre'] + '</strong>?',
                   function() {
                       eliminar(data['id']);
                       alertify.notify('Se elimino la unidad de medida <strong>' + data['uni_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                   },
                   function() {
                       alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                   }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
           }
       })
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
       abrir_modal('modalunidad', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Unidad de medida');
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
                   if (data == 1) {
                       alertify.notify('Campo <strong>nombre</strong> vacío.', 'custom', 4, function() {});
                       $("#form_agregar input[name=nombre]").focus();
                   }
                   if (data == 2) {
                       alertify.notify('Campo <strong>simbolo</strong> vacío.', 'custom', 4, function() {});
                       $("#form_agregar input[name=simbolo]").focus();
                   }
                   if (data == 0) {
                       f[0].reset();
                       $("#form_agregar input[name=nombre]").focus();
                       table = $('.datatable').DataTable();
                       table.ajax.reload();
                       alertify.notify('Se agrego <strong>unidad de medida</strong> correctamente.', 'custom-black', 4, function() {})
                   };
               },
               error: function() {},
           });
       });
   });

   function eliminar(id) {
       $.ajax({
           url: '../Unidades/eliminar',
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
       alertify.modalunidad($('#form_modificar')[0]).set('selector', 'input[name="nombre"]');
       $.ajax({
           url: '../Unidades/mostrar_unidad',
           type: "POST",
           dataType: "json",
           data: {
               'id': id,
           },
           success: function(data) {
               var form = $('#form_modificar');
               form.find('input[name=id]').val(data[0].id);
               form.find('input[name=nombre]').val(data[0].uni_nombre);
               form.find('input[name=simbolo]').val(data[0].uni_simbolo);
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
                   alertify.modalunidad().close();
                   alertify.notify('<strong>Unidad de medida</strong> modificada correctamente.', 'custom-black', 3, function() {});
               },
               error: function() {},
           });
       });
   });