<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
    <div class="row">
          
        <div class="col-12 col-md-12">
            <hr>
            <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Cobranzas</h5>
            <small><i class="far fa-edit"></i> Aquí podrá ver todas las listas de cobranzas.</small>
            <hr>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                     
                        <table class="datatable table table-striped table-bordered dt-responsive compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cobranza</th>
                                    <th>Fecha</th>
                                   	<th>N° de Documento</th>
                                   	<th>Condicion de Pago</th>
                                   	<th>Fecha Vencimiento</th>
                                   <th>Total Factura</th>
                                   <th>Total Pagado</th>
                                   <th>Por Pagar</th>
                                   <th>Historial</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
 <br>
    <form id="form_agregar" action="<?php echo URL?>Tablacobranzas/crear" method="post" class='ocultar'>
            
             <div class="form-group row">
               <label for="" class="col-5">Monto :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm two-decimals" type="number" name="monto" step="any" placeholder="Ingrese monto " required>
               </div>
            </div>            
            <div class="form-group row">
               <label for="" class="col-6 ">POR PAGAR : <strong><span class="total_pagar"></span></strong></label>
               <label for="" class="col-6 "> </label>
               <label for="" class="col-6 ">PAGADO HASTA LA FECHA : <strong><span class="total_pagado"></span></strong></label>
                <label for="" class="col-6 "> </label>
            </div>
           <div class="form-group row">
               <label for="" class="col-5 "></label>
               <div class="col-7">
                  <button class="btn btn-sm btn-dark">Agregar monto</button>
                  <input type="hidden" name="documento">
               </div>
            </div>
            
         </form> 
         <div id="div_historial" class="ocultar">
            <table class="datatable_historial  table table-striped table-bordered dt-responsive compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento</th>
                                    <th>Fecha y Hora</th>
                                    <th>Usuario</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                        </table>
         </div>
<?php
require URLINC . 'footer.php';
?>
