<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid font_azul">
  <div class="row">
    <div class="col-12">
      <hr>
      <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Ver facturas</h4>
      <span class="font_azul"><i class="far fa-edit"></i> Aqui podra ver las factura para imprimir</span>
      <hr>
    </div>
    <div class="col-12">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <table class="datatable table table-striped table-bordered dt-responsive compact text-center" style="width:100%">               <thead>
              <tr>
                <th>N° ID</th>
                <th>Correlativo</th>
                <th>N° Factura</th>
                <th>Aceptado</th>
                <th>PDF / A</th>
                <th>XML / A</th>
                <th>CDR / A</th>
                <th>Descripción</th>
                <th>Actualizar - Anular - Guía</th>
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

