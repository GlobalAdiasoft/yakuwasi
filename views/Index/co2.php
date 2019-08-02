<?php
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>



<div class="container-fluid">
      <form id="form_agregar" action="<?php echo URL?>Compras/agregar" method="post" class="row">
    <div class="col-12 col-md-4">
      <hr>
      <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Compras</h5>
      <small><i class="far fa-edit"></i>Aquí podrá agregar nuevas compras</small>
      <hr>
        <div class="form-group row">
          <label for="" class="col-5">N° de Factura:</label>
          <div class="col-7">
            <input class="form-control form-control-sm" type="text" name="numero_factura" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-5">Proveedor:</label>
          <div class="col-7">
            <select class="form-control form-control-sm select2-single" name="proveedor" required>
              <option value="" disabled selected>Seleccione un proveedor</option>
            </select>
            <input type="hidden" name="proveedor">
          </div>
        </div>
         <div class="form-group row">
          <label for="" class="col-5">Moneda: </label>
          <div class="col-7">
            <select class="form-control form-control-sm" name="moneda" id="" required>
              <option value="" disabled selected="">Seleccione una moneda</option>
              <option value="PEN">Soles</option>
              <option value="USD">Dólares</option>
            </select>
            <input type="hidden" name="moneda">
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-5"></label>
          <div class="col-7">
            <button class="btn btn-sm btn-dark form-control form-control-sm" type="button">Nuevo</button>
          </div>
        </div>
        
        
       
     
    </div>
     <div class="col-12 col-md-8">
     	<hr>
      <!--<h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Compras</h5>
      <small><i class="far fa-edit"></i>Aquí podrá agregar nuevas compras</small>
      <hr>-->
      <div class="row">
      <div class="form-group col-12 col-md-4">
          <label for="">Artículo:</label>
          
            <select class="form-control form-control-sm select2-single" name="articulo" required>
              
            </select>
          
        </div>
        <div class="form-group col-12 col-md-4">
          <label for="">Cantidad:</label>
          
            <input class="form-control form-control-sm" type="number" name="cantidad" required>
         
        </div>
       
        <div class="form-group col-12 col-md-4">
          <label for="">P. con IGV:</label>
          
            <input class="form-control form-control-sm moneda" type="number" name="produ_precio_ventaconigv" step="any" required>
         
        </div>
        <div class="form-group col-12 col-md-4">
          <label for="">P. sin IGV:</label>
          
            <input class="form-control form-control-sm moneda" type="number" name="produ_precio_ventasinigv" step="any" required>
          
        </div>
         <div class="form-group col-12 col-md-4">
          <label for="">P. Total:</label>
          
            <input class="form-control form-control-sm moneda" type="number" name="precio_total" step="any" required>
          
        </div>
         <div class="form-group col-12 col-md-4">
          <label for="" ></label>
       
            <button class="btn btn-sm btn-dark form-control form-control-sm" type="submit">Agregar</button>
          
        </div>
        </div>
     	<table  class="datatable table table-striped table-bordered dt-responsive  text-center" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  
                  
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Moneda</th>
                  <th>Precio Unitario</th>
                 <th>Precio Total</th>
                  <th>Eliminar</th>
                  
                </tr>
              </thead>
            </table>
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
</form>
<?php
require URLINC.'footer.php';
?>
