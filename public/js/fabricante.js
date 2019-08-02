 $(document).ready(function() {
     $("#form_agregar input[name=nombre]").focus();
     $("#form_agregar input[name=nombre]").keyup(function() {
         var letras = $(this).val().substring(0, 4);
         var numeros = $(this).val().length;
         $("#form_agregar input[name=codinterno]").val(letras + numeros + '_fabri');
     });

     var table = $('.datatable').DataTable({
         "ajax": {
             "url": '../Fabricantes/mostrar',
             "dataSrc": ""
         },
         "columns": [{
             "data": "id"
         }, {
             "data": "fabri_codinterno"
         }, {
             "data": "fabri_nombre"
         }, {
             "data": "fabri_codusuario"
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
             alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el fabricante <strong>' + rowData['fabri_nombre'] + '</strong>?',
                 function() {
                     eliminar(rowData['id']);
                     alertify.notify('Se elimino el fabricante <strong>' + rowData['fabri_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
                 },
                 function() {
                     alertify.notify('Se cancelo la <strong>eliminación</strong>.', 'custom-black', 4, function() {});
                 }).set('labels', { ok: 'Eliminar', cancel: 'Cancelar' });
         } else {
             alertify.confirm('<i class="fa fa-bars" aria-hidden="true"></i> Eliminar', '¿Desea eliminar el fabricante <strong>' + data['fabri_nombre'] + '</strong>?',
                 function() {
                     eliminar(data['id']);
                     alertify.notify('Se elimino el fabricante <strong>' + data['fabri_nombre'] + '</strong> correctamente.', 'custom-black', 4, function() {});
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
             editar(rowData['id']);
         } else {
             editar(data['id']);
         }
     });
     abrir_modal('modalfabricante', '<i class="fa fa-bars" aria-hidden="true"></i> Modificar Fabricante');
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
                     alertify.notify('Campo <strong>código interno</strong> vacío.', 'custom', 4, function() {});
                     $("#form_agregar input[name=codinterno]").focus();
                 }
                 if (data == 2) {
                     alertify.notify('Campo <strong>nombre</strong> vacío.', 'custom', 4, function() {});
                     $("#form_agregar input[name=nombre]").focus();
                 }
                 if (data == 0) {
                     f[0].reset();
                     $("#form_agregar input[name=nombre]").focus();
                     table = $('.datatable').DataTable();
                     table.ajax.reload();
                     alertify.notify('Se agrego <strong>marca</strong> correctamente.', 'custom-black', 4, function() {})
                 };
             },
             error: function() {},
         });
     });
 });

 function eliminar(id) {
     $.ajax({
         url: '../Fabricantes/eliminar',
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
     alertify.modalfabricante($('#form_modificar')[0]).set('selector', 'input[name="codinterno"]');
     $.ajax({
         url: '../Fabricantes/mostrar_fabricante',
         type: "POST",
         dataType: "json",
         data: {
             'id': id,
         },
         success: function(data) {
             var form = $('#form_modificar');
             form.find('input[name=id]').val(data[0].id);
             form.find('input[name=codinterno]').val(data[0].fabri_codinterno);
             form.find('input[name=nombre]').val(data[0].fabri_nombre);
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
                 alertify.modalfabricante().close();
                 alertify.notify('<strong>Fabricante</strong> modificado correctamente.', 'custom-black', 3, function() {});
             },
             error: function() {},
         });
     });
 });