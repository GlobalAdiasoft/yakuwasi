<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-5">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Tipo Cambio</h5>
         <small><i class="far fa-edit"></i>Aquí podrá agregar nuevo tipo de cambio</small>
         <hr>
         <form id="form_agregar" action="<?php echo URL ?>Tipocambio/agregar" method="post">
            <div class="form-group row">
               <label for="" class="col-5">Compra :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="number" name="compra" placeholder="" required autocomplete="off" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5 ">Venta :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="number" name="venta" placeholder="" required autocomplete="off" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5 "></label>
               <div class="col-7">
                  <button class="btn btn-sm btn-dark">Agregar</button>
               </div>
            </div>
         </form>
         <object data="http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias"  type="text/html" style="width: 100%; height: 400px; border :1px solid rgba(0,0,0,.1); padding: 5px;">

</object>
      </div>
      <div class="col-12 col-md-7">
         <hr>
         <h4 class="font_azul"><i class="fa fa-bars " aria-hidden="true"></i> Tipo Cambio</h4>
         <small class="font_azul"><i class="far fa-edit"></i> Aquí podrá ver tipo de cambio</small>
         <hr>
         <table class="datatable table table-striped table-bordered dt-responsive text-center" style="width:100%"><!--nowrap -->
         <thead>
            <tr>
               <th>#</th>
              <th>Fecha</th>
              <th>Compra</th>
              <th>Venta</th>
            </tr>
         </thead>
      </table>
   </div>
</div>
</div>
<?php
require URLINC . 'footer.php';
?>