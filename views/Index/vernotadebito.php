<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid font_azul">
    <div class="row">
        <div class="col-12">
            <hr>
            <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Ver Notas de Débito</h4>
            <span class="font_azul"><i class="far fa-edit"></i> Aqui podra ver notas de débito</span>
            <hr>
        </div>
        <div class="col-12">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">
  <table class="datatable table table-striped table-bordered dt-responsive compact" style="width:100%">               <thead>
                  <tr>
                   <th>#</th>
                  <th>Fecha</th>
                  <th>Correlativo</th>
                  <th>Número</th>
                  <th>Correlativo a modificar</th>
                  <th>Número a modificar</th>
                  <th>Envio sunat</th>
                  <th>PDF</th>
                  <th>XML</th>
                  <th>CDR</th>


                     </tr>
               </thead>

            </table>
        </div>
               </div>
           </div>
        </div>
    </div>
</div>
<?php
require URLINC . 'footer.php';
?>
<img src="" alt="">
