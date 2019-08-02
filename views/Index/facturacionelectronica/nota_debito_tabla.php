<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';

?>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('.datatable').DataTable({
        "searching": false,
        "bLengthChange": false,
        "paging": false,
        "info": false,
        "ajax": {
            "url": '../Notadebito/traer_datos_item',
            "dataSrc": "",
            "data": function(data) {
                data.documento = <?php echo $_GET['documento'] ?>;
                data.numero = <?php echo $_GET['numero'] ?>;
            }
        },
        "columns": [{
            "data": "id"
        }, {
            "data": "ped_cantidad"
        }, {
            "data": "ped_cod_pro"
        }, {
            "data": "ped_nombre_pro"
        }, {
            "data": "ped_valor_venta_sin_igv"
        }, {
            "data": "ped_total"
        }, {
            "defaultContent": "<button id='btn_agregar' class='btn btn-info btn-sm'><i class='fas fa-hand-point-right'></i></button>"
        }, ],
        "language": {
            "url": "../public/fw/datatables/Spanish.json"
        },
        "lengthMenu": [
            [100, -1],
            [100, "All"]
        ]
    });

     $('.datatable tbody').on('click', '#btn_agregar', function() {

        var data = table.row($(this).parents('tr')).data();
        if (data == undefined) {
            var selected_row = $(this).parents('tr');
            if (selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
            }
            var rowData = $('.datatable_lista').DataTable().row(selected_row).data();

        //alert(rowData['id']);
            enviar_data(rowData);
            $(this).prop('disabled',true)
        } else {
          //alert(data['id']);
           enviar_data(data);
           $(this).prop('disabled',true)

        }
    })
    function enviar_data(data){


       correlativo =  window.opener.$(' select[name="correlativo"]').val();
       numero= window.opener.$('input[name="numero"]').val();
        jObject= JSON.stringify(data);
        $.ajax({
        url: '../Notadebito/guardar_items',
        type: "POST",
        dataType: "html",
        data:{
            'jObject':jObject,
            'correlativo':correlativo,
            'numero':numero
        },
        success: function(data) {
        console.log(data);
         window.opener.actualizar();

        }
    });
     }
});


</script>
<div class="container-fluid font_azul">
    <br>
    <div class="row">

         <div class="col-12" >

           <div class="row">
               <div class="col-12">
            <table class="datatable table table-striped table-bordered dt-responsive" style="width:100%">
          <thead>
              <tr>
                <th>#</th>
                 <th>Cantidad</th>
                 <th>Código Producto</th>
                 <th>Producto</th>
                 <th>Valor de Venta sin IGV</th>
                 <th>Total</th>
                 <th>Eliminar</th>
              </tr>
           </thead>


                </table>

      </div>
       <!--<div class="col-12">
       <table class="" style="width:100%">
                     <tr class="text-center">
                     <td><strong>Subtotal :</strong> <label class="label_subtotal"></label></td>

                 </tr>
                 <tr class="text-center">
                     <td><strong>IGV : </strong><label class="label_igv"></label></td>
                 </tr>
                 <tr class="text-center">
                      <td><strong>Total : </strong><label class="label_total"></label></td>
                 </tr>

                </table>
            </div>
           </div>-->

    </div>
        </div>
    </div>

<?php require URLINC . 'footer.php';?>