 $(document).ready(function() {
     //convertir_decimales();
     verificarnumerofactura();
     $(".two-decimals").change(function() {
         if ($(this).val() == "") {
             $(this).val(0.00);
         }
         this.value = parseFloat(this.value).toFixed(2);
     });
     $(".two-decimals2").change(function() {
         if ($(this).val() == "") {
             $(this).val(0.00);
         }
         this.value = parseFloat(this.value).toFixed(3);
     });
     $("input[name=preciounitario],input[name=cantidad]").change(function() {
         var cantidad = $('input[name=cantidad]').val();
         var preciounitario = $('input[name=preciounitario]').val();
         var total = cantidad * preciounitario;
         $('input[name=total]').val(parseFloat(total).toFixed(2));
     });

     $('input[name=cli_id]').change(function() {
         llamar_cliente();
     });
     $('select[name=moneda]').change(function() {
         tipodecambio(this);
     });
     $('select[name=condiciones_pago]').change(function() {
         condicionesdepago(this);
     });
     $('select[name=medio_pago]').change(function() {
         mediosdepago(this);
     });
     $('select[name=sunat_transaccion]').change(function() {
         verificar_sunat_transaccion(this);
     });
     /* $('input[name=fecha]').datepicker({
          dateFormat: "yy-mm-dd",
      });*/
     $('.modal_agregar_cliente').hm_modal('init', {
         backgroundcolorhead: '#1B3156',
         colorhead: 'white',
         colorfooter: 'rgba(0,0,0,0.4)',
         padding: 5,
         sombra: true,
         width: 'auto',
         nivelfade: 9,
     });
     mostrar_ubigeo();
     llamar_rucs();
     llamar_codpro();
     $('#form_agregar_factura select[name=correlativo]').change(function() {
         verificarnumerofactura();
     });
     $('input[name=codproducto]').change(function() {
         cod_producto($(this).val());
     });
 });

 function convertir_decimales() {
     $(".two-decimals").val(0);
     $(".two-decimals").val(parseFloat($(".two-decimals").val()).toFixed(2));
 }

 function llamar_cliente() {
     var id = $('input[name=cli_id]').val();
     $.ajax({
         url: '../Clientes/llamar_cliente',
         type: "POST",
         dataType: "html",
         data: {
             'id': id,
         },
         success: function(data) {
             if (data == 'vacio') {
                 $('#cli_nombre').text('NO SE ENCONTRARON RESULTADOS').css({
                     'color': 'red',
                 });
                 $('#cli_ruc').text(' ');
                 $('#cli_ubigeo').text(' ');
                 $('#cli_direccion').text(' ');
                 $('#cli_telefono').text(' ');
                 $('#cli_celular').text(' ');
             } else {
                 var obj = JSON.parse(data);
                 $('#cli_nombre').css({
                     'color': '#1B3156',
                 });
                 $('#cli_nombre').text(obj[0].cli_nombre);
                 $('#cli_ruc').text(obj[0].cli_ruc);
                 $('#cli_ubigeo').text(obj[0].cli_ubigeo);
                 $('#cli_direccion').text(obj[0].cli_direccion);
                 $('#cli_telefono').text(obj[0].cli_telefono);
                 $('#cli_celular').text(obj[0].cli_celular);
             }
         }
     })
 }
 $(function() {
     $("#form_agregar_factura").on("submit", function(e) {
         e.preventDefault();
         var f = $(this);
         var metodo = f.attr("method");
         var url = f.attr("action");
         var formData = new FormData(this);
         formData.append("dato", "valor");
         $("select[name=moneda]").prop('disabled', 'disabled');
         $("input[name=tipocambio]").prop("readonly", true);
         $("input[name=guia_serie]").prop("readonly", true);
         $('select[name=sunat_transaccion]').prop("disabled", true);
         $("select[name=medio_pago]").prop("disabled", true);
         $("select[name=condiciones_pago]").prop("disabled", true);
         if ($('#cli_nombre').text() == 'NO SE ENCONTRARON RESULTADOS') {
             $('input[name=cli_id]').focus();
             return;
         } else {
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

                     if (response == 1) {
                         var producto = $('#form_agregar_factura input[name=codproducto]').val();
                         alertify.notify('No cuenta con stock suficiente del producto <strong>' + producto + '</strong>', 'custom', 5, function() {});
                         $('#form_agregar_factura input[name=cantidad]').focus()
                     } else {
                         $("input[name=numero_factura]").prop("readonly", true);
                         $("input[name=cli_id]").prop("readonly", true);
                         $("input[name=cantidad]").val('');
                         $("input[name=codproducto]").val('');
                         $("input[name=producto]").val('');
                         $("input[name=preciounitario]").val('');
                         $("input[name=total]").val('');
                         $("select[name=moneda]").prop("readonly", true);
                         $("input[name=cantidad]").focus();

                         tabla_itemsfactura();
                     }
                     if (response == 2) {
                         var producto = $('#form_agregar_factura input[name=codproducto]').val();
                         alertify.notify('Stock mínimo del producto <strong>' + producto + '</strong>', 'custom', 5, function() {});

                     }

                 },
                 error: function() {},
             });
         };
     });
 });

 function tabla_itemsfactura() {
     var correlativo = $('select[name=correlativo]').val();
     var numero_factura = $('input[name=numero_factura]').val();
     $.ajax({
         url: '../Facturas/tabla_itemsfactura',
         type: "POST",
         dataType: "html",
         data: {
             'correlativo': correlativo,
             'numero_factura': numero_factura
         },
         success: function(data) {
             $('#tabla_itemsfactura').html(data);
             $('.eliminaritem').click(function() {
                 eliminar_itemfactura($(this).val());
             });
         }

     })
 }

 function eliminar_itemfactura(id) {
     $.ajax({
         url: '../Facturas/eliminar_itemfactura',
         type: "POST",
         dataType: "html",
         data: {
             'id': id,
         },
         success: function(data) {
             tabla_itemsfactura();
         }
     });
 }

 function mostrar_ubigeo() {
     $.ajax({
         url: '../Clientes/mostrar_ubigeo2',
         type: "POST",
         dataType: "html",
         success: function(data) {
             $('select[name = ubigeo]').append(data);


         }
     });
 }

 $(function() {
     $("#form_agregar_cliente").on("submit", function(e) {
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
                 $('.modal_agregar_cliente').hm_modal('hide', {
                     backgroundcolorhead: '#1B3156',
                     colorhead: 'white',
                     colorfooter: 'rgba(0,0,0,0.4)',
                     padding: 5,
                     sombra: true,
                     width: 'auto',
                     nivelfade: 9,
                 });
                 llamar_rucs();
                 f[0].reset();
             },
             error: function() {},
         });
     });
 });

 function llamar_rucs() {
     $.ajax({
         url: '../Clientes/llamar_rucs',
         type: "POST",
         dataType: "html",
         success: function(data) {
             $('#datalist_rucs').html(data);


         }
     });
 }

 function llamar_codpro() {
     $.ajax({
         url: '../Articulos/llamar_codpro',
         type: "POST",
         dataType: "html",
         success: function(data) {
             $('#datalist_codpro').html(data);


         }
     });
 }

 function tipodecambio(t) {
     $('input[name=moneda]').val($(t).val());


     var tipodecambio = $('input[name=moneda]').val();

     if (tipodecambio == 2) {
         $('input[name=tipocambio]').attr('readonly', false);
         $('input[name=tipocambio]').attr("required", true);
     }
     if (tipodecambio == 1) {
         $('input[name=tipocambio]').attr('readonly', true);
         $('input[name=tipocambio]').attr("required", false);

     }
 }

 function verificarnumerofactura() {
     var correlativo = $('#form_agregar_factura select[name=correlativo]').val();
     $.ajax({
         url: '../Facturas/verificarnumerofactura',
         type: "POST",
         dataType: "html",
         data: {
             'correlativo': correlativo
         },
         success: function(data) {
             $('input[name=numero_factura]').val(data);


         }
     });
 }

 function verificar_sunat_transaccion(t) {


     $('input[name=sunat_transaccion]').val($(t).val());

     var value = $('input[name=sunat_transaccion]').val();
     if (value == 1) {
         $("select[name=condiciones_pago]").prop("disabled", true);
         $("input[name=guia_serie]").prop("disabled", true);
         $("select[name=condiciones_pago]").attr("required", false);
         $("input[name=guia_serie]").attr("required", false);
     }
     if (value == 10) {
         $("select[name=condiciones_pago]").prop("disabled", false);
         $("input[name=guia_serie]").prop("disabled", false);
         $("select[name=condiciones_pago]").attr("required", true);
         $("input[name=guia_serie]").attr("required", true);
     }
 };

 function condicionesdepago(t) {
     $('input[name=condiciones_pago]').val($(t).val());

 }

 function mediosdepago(t) {
     $('input[name=medio_pago]').val($(t).val());

 }

 function cod_producto(codart) {
     var str = codart;
     var res = str.split("-");
     var codart = res[0];
     console.log(res[0]);
     $.ajax({
         url: '../Facturas/codpro',
         type: "POST",
         dataType: "JSON",
         data: {
             'codart': codart,
         },
         success: function(data) {
             if (data == 0) {
                 $('input[name=producto]').val('');
                 $('input[name=preciounitario]').val('');
                 $('input[name=total]').val('');
             } else {
                 $('input[name=producto]').val(data[0].art_nombre);
                 $('input[name=preciounitario]').val(data[0].art_preciotienda);

                 var cantidad = $('input[name=cantidad]').val();
                 var preciounitario = $('input[name=preciounitario]').val();
                 var total = cantidad * preciounitario;
                 $('input[name=total]').val(parseFloat(total).toFixed(2));
             }
         }
     });
 }