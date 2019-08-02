<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <hr>
            <h4 class="font_azul"><i class="fa fa-bars " aria-hidden="true"></i> Kardex</h4>
         <small class="font_azul"><i class="far fa-edit"></i> Aquí podrá ver todo la información de kardex</small>
         <hr>


        <table class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Articulo</th>
                                    <th>Código Articulo</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Ingreso</th>
                                    <th>Salida</th>
                                    <th>Saldo</th>
                                    <th>Usuario</th>
                                    <th>Documento</th>
                                    <th>Correlativo</th>
                                    <th>Proveedor</th>
                                    <th>Observaciones</th>


                            </thead>
                        </table>



      </div>
   </div>
</div>


<?php
require URLINC . 'footer.php';
?>