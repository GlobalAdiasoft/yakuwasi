<?php  
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
	<div class="row">
		
		<div class="col-12 col-md-4">
			  <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Configuracion Empresa</h5>
         <small><i class="far fa-edit"></i> Aquí podrá configurar datos de la empresa</small>
         <hr>
			 <form id="form_agregar" action="<?php echo URL ?>Configuracion/agregar" method="post">
			 	
                  <input  type="hidden" name="nombre" readonly>
               
            <div class="form-group row">
               <label for="" class="col-4 ">Logo :</label>
               <div class="col-8">
            <div id="file_imagen">Cargar Imagen</div>
               </div>
            </div>
            <hr>

             <div class="form-group row">
               <label for="" class="col-4 ">RUC o DNI:</label>
               <div class="col-8">
                   <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-dark btn-sm" type="button" id="btn_datos_sunat">Buscar</button>
                  </div>
               <input id="ruc" class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un ruc válido" pattern="[0-9]{8,11}" title="* El formato de <strong>RUC</strong> es de 11 dígitos" >
               </div>
               </div>
            </div>
              <div class="form-group row">
               <label for="" class="col-4">Razon Social :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="razonsocial" placeholder="Ingrese la razon social" >
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4">Dirección :</label>
               <div class="col-8">
                  <textarea class="form-control form-control-sm" name="direccion" id="" cols="30" rows="5" placeholder="Ingrese la dirección" ></textarea>
                
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">Ubigeo :</label>
               <div class="col-8">
                    <select id="single" class="form-control form-control-sm select2-single select_ubigeo" name="ubigeo" >
                   
                     
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 "></label>
               <div class="col-8">
                  <button class="btn btn-sm btn-dark">Agregar</button>
               </div>
            </div>
        </form>
		</div>

	</div>
</div>
<?php
require URLINC.'footer.php';
?>
