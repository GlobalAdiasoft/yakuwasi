<?php
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			 <hr>
      <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Compras</h5>
      <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todas las compras</small>
      <hr>
		</div>
		<div class="col-12">
			 <table  class="datatable table table-striped table-bordered dt-responsive  text-center nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Factura</th>
<th>Proveedor</th>
<th>Moneda</th>
<th>Subtotal</th>
<th>IGV</th>
<th>Total</th>
<th>Fecha</th>
<th>Usuario</th>
<th>Detalles</th>
<th>Eliminar</th>
                  
                </tr>
              </thead>
            </table>
		</div>
	</div>
</div>
<?php
require URLINC.'footer.php';
?>
<div id="detalles" class="ocultar">
<input type="hidden" name="cod_factura">
<table  class="datatable1 table table-striped table-bordered dt-responsive  text-center nowrap" style="width:100%">
              <thead>
                <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>P. con IGV</th>
                <th>P. sin IGV</th>
                <th>Total</th>
                <th>Eliminar</th>
                  
                </tr>
              </thead>
            </table>
            </div>