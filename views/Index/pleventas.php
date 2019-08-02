<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      
      <div class="col-12">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Ple Ventas</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de ple ventas</small>
         <hr>
        

                <table  class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
               <thead>
                  <tr>
                    <th>id</th>
                    <th>periodo</th>
                    <th>correlativo_registro</th>
                    <th>fecha_emision</th>
                    <th>fecha_vencimiento</th>
                    <th>tipo_comprobante</th>
                    <th>serie</th>
                    <th>numero</th>
                    <th>final_consolidado</th>
                    <th>tipo_doc_cliente</th>
                    <th>nro_documento</th>
                    <th>razon_social</th>
                    <th>valor_exportacion</th>
                    <th>operacion_gravada</th>
                    <th>importe_total_exonerada</th>
                    <th>importe_total_inafecta</th>
                    <th>isc</th>
                    <th>igv_ipm</th>
                    <th>operacion_gravada_ivap</th>
                    <th>operacion_gravada_ivap</th>
                    <th>otros_cargos</th>
                    <th>total_comprobante</th>
                    <th>tipo_cambio</th>
                    <th>fecha_emision_modificado</th>
                    <th>tipo_doc_cliente_modificado</th>
                    <th>serie_modificado</th>
                    <th>numero_modificado</th>
                    <th>estado</th>

                  </tr>
               </thead>
            </table>



      </div>
   </div>
</div>

<?php
require URLINC . 'footer.php';
?>
