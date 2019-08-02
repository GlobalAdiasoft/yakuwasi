<?php  
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-3">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Nuevos Proveedores</h5>
         <small><i class="far fa-edit"></i>Aquí podrá agregar nuevos proveedores</small>	
         <hr>
         <form id="form_agregar" action="<?php echo URL?>Proveedores/agregar" method="post">
              <div class="form-group row">
               <label for="" class="col-5 ">RUC o DNI:</label>
               <div class="col-7">
                   <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-dark btn-sm" type="button" id="btn_datos_sunat">Buscar</button>
                  </div>
               <input id="ruc" class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un ruc válido" pattern="[0-9]{11}" title="* El formato de <strong>RUC</strong> es de 11 dígitos" required>
               </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Razon Social :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="razonsocial" placeholder="Ingrese la razon social" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Sector Comercial :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="sectorcomercial" placeholder="Ingrese el sector comercial">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Ubigeo :</label>
               <div class="col-7">
<select class="form-control form-control-sm" name="ubigeo" required>
                     <option value="" selected>Seleccione Ubigeo</option>
                  </select>               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Dirección :</label>
               <div class="col-7">
               	<textarea class="form-control form-control-sm" name="direccion" id="" cols="30" rows="5" placeholder="Ingrese la dirección" required></textarea>
                
               </div>
            </div>
           
            <div class="form-group row">
               <label for="" class="col-5">Teléfonos :</label>
               <div class="col-7">
               	<textarea class="form-control form-control-sm" name="telefono" id="" cols="30" rows="5" placeholder="Ingrese el teléfono"></textarea>
                 
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Email :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese el email">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Cta. Soles :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="ctasoles" placeholder="Ingrese la cuenta en soles">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Cta. Dólares :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="ctadolares" placeholder="Ingrese la cuenta en dólares">
               </div>
            </div>
           <div class="form-group row">
               <label for="" class="col-5 "></label>
               <div class="col-7">
                  <button class="btn btn-sm btn-dark">Agregar</button>
               </div>
            </div>
            
         </form>
      </div>
      <div class="col-12 col-md-9">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de los Proveedores</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos los proveedores</small>
         <hr>
         <div class="container">
        <div class="row">
          <div class="col-12" >
          
                <table  class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>RUC</th>
                     <th>Razon Social</th>
                     <th>Sector Comercial</th>

                     <th>Ubigeo</th>
                     <th>Dirección</th>
                     <th>Télefonos</th>
                     <th>Email</th>
						<th>Cta. Soles</th>
                     <th>Cta. Dólares</th>
                     <th>Editar</th>
                     <th>Eliminar</th>
                    
                  </tr>
               </thead>
            </table>
            
          
          </div>
        </div>
           </div> 
        
      </div>
   </div>
</div>
<form id="form_modificar" action="<?php echo URL?>Proveedores/modificar" method="post" class="ocultar">
	    <input class="form-control form-control-sm" name="id" placeholder="ID" type="hidden">

            <div class="form-group row">
               <label for="" class="col-5 ">RUC o DNI:</label>
               <div class="col-7">
                   <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-dark btn-sm" type="button" id="btn_datos_sunat_modificar">Buscar</button>
                  </div>
               <input id="ruc" class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un ruc válido" pattern="[0-9]{11}" title="* El formato de <strong>RUC</strong> es de 11 dígitos" required>
               </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Razon Social :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="razonsocial" placeholder="Ingrese la razon social" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Sector Comercial :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="sectorcomercial" placeholder="Ingrese el sector comercial">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Ubigeo :</label>
               <div class="col-7">
<select class="form-control form-control-sm" name="ubigeo" required>
                     <option value="" selected>Seleccione Ubigeo</option>
                  </select>               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Dirección :</label>
               <div class="col-7">
               	<textarea class="form-control form-control-sm" name="direccion" id="" cols="30" rows="5" placeholder="Ingrese la dirección" required></textarea>
                
               </div>
            </div>
           
            <div class="form-group row">
               <label for="" class="col-5">Teléfonos :</label>
               <div class="col-7">
               	<textarea class="form-control form-control-sm" name="telefono" id="" cols="30" rows="5" placeholder="Ingrese el teléfono"></textarea>
                 
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Email :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese el email">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Cta. Soles :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="ctasoles" placeholder="Ingrese la cuenta en soles">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5">Cta. Dólares :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="ctadolares" placeholder="Ingrese la cuenta en dólares">
               </div>
            </div>
           <div class="form-group row">
               <label for="" class="col-5 "></label>
               <div class="col-7">
                  <button class="btn btn-sm btn-dark">Modificar</button>
               </div>
            </div>
            
         </form>
<?php
require URLINC.'footer.php';
?>
