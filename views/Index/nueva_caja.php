<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid container-fluid-corregido">
<div class="row">
	<div class="col-12 col-lg-5">
		   <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Caja Aperturar y Cerrar</h5>
         <small><i class="far fa-edit"></i> Aquí podrá abrir y cerrar caja</small>
         <hr>
         <form id="form_abrir_caja" action="<?php echo URL ?>CajaNueva/abrir_caja" method="post" class="ocultar">
         	<div class="form-group row">
				<label for="" class="col-4">Monto Inicial:</label>
				<div class="col-8">
					<input class="form-control form-control-sm" type="number" min="0.00" max="100000.00" step="0.01" required name="monto_inicial" autocomplete="off">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4"></div>
				<div class="col-8">
					<button class="btn btn-pagina btn-sm" type="submit">Aperturar Caja</button>
				</div>
			</div>
         </form>

            <form id="form_cerrar_caja" action="<?php echo URL ?>CajaNueva/cerrar_caja" method="post" class="ocultar">
         	<div class="form-group row">
				<label for="" class="col-4">Monto Final:</label>
				<div class="col-8">
					<input class="form-control form-control-sm" type="number" min="0.00" max="100000.00" step="0.01" required name="monto_final" autocomplete="off">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4"></div>
				<div class="col-8">
					<button class="btn btn-pagina btn-sm" type="submit">Cerrar Caja	</button>
				</div>
			</div>
         </form>
     </div>
 </div>
</div>

<?php
require URLINC . 'footer.php';
?>