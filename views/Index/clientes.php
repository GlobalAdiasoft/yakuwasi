<?php  
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-3">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Nuevos Clientes</h5>
         <small><i class="far fa-edit"></i> Aquí podrá agregar nuevos clientes</small>
         <hr>
         <form id="form_agregar_cliente" action="<?php echo URL?>Clientes/agregar_clientes" method="post">

             <div class="form-group row">
               <label for="" class="col-4 ">RUC o DNI:</label>
               <div class="col-8">
                   <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-dark btn-sm" type="button" id="btn_datos_sunat">Buscar</button>
                  </div>
               <input id="ruc" class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un ruc válido" pattern="[0-9]{8,11}" title="* El formato de <strong>RUC</strong> es de 11 dígitos" required>
               </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Nombres :</label>
               <div class="col-8">
<input class="form-control form-control-sm" type="text" required=""  value="" name="nombres" id="names_pattern2"  placeholder="Nombres y Apellidos" 
 title="Solo letras mayúsculas o minúsculas " required>               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Ubigeo :</label>
               <div class="col-8">
                    <select id="single" class="form-control form-control-sm select2-single" name="ubigeo" required>
                    <option></option>
                     
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Dirección :</label>
               <div class="col-8">
                  <textarea class="form-control form-control-sm" name="direccion" id="" cols="30" rows="5" placeholder="Ingrese la dirección " required></textarea>
                 
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Teléfonos :</label>
               <div class="col-8">
                  <textarea class="form-control form-control-sm" name="telefono" id="" cols="30" rows="5"></textarea>
              
               </div>
            </div>
            
            <div class="form-group row">
               <label for="" class="col-4 ">Email :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese correo electrónico" >
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Web :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="web" placeholder="Ingrese pagina web">
               </div>
            </div>
          
           
            <div class="form-group row">
               <label for="" class="col-4 ">Observación:</label>
               <div class="col-8">
                  <textarea  class="form-control form-control-sm" name="observacion" id="" cols="10" rows="3 "></textarea>
               </div>
            </div>
                 <div class="form-group row">
               <label for="" class="col-4 ">Tipo Cliente:</label>
               <div class="col-8">
                 <select class="form-control form-control-sm" name="tipo" id="">
                    <option value="1">TIPO A</option>
                    <option value="2">TIPO B</option>
                    <option value="3">TIPO C</option>
                    <option value="4">TIPO D</option>
                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 "></label>
               <div class="col-8">
                  <button class="btn btn-dark btn-sm">Agregar  </button>
               </div>
            </div>


         </form>
      	</div>
      	<div class="col-12 col-md-9">
            <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Clientes</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos los clientes</small>
         <hr>
            <div class="container-fluid">
        <div class="row">
          <div class="col-12" >
      		<table class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%"><!--nowrap -->
               <thead>
                  <tr>
                     <th>#</th>
                     <th>RUC</th>
                     <th>DNI</th>
                     <th>Nombres</th>
                     <th>Ubigeo</th>
                     <th>Dirección</th>
                     <th>Teléfonos</th>
                    
                     <th>Email</th>
                     <th>Web</th>
                     <th>Observacíon</th>
                     <th>Editar</th>
                     <th>Eliminar</th>
                     
                  </tr>
               </thead>
            </table>
         </div></div></div>
      	</div>
      </div>
    <br>
  </div>

                 

                  <form id="form_modificar_cliente" action="<?php echo URL?>Clientes/modificar_cliente" method="post" class="ocultar">
                                   <input class="form-control" name="id" placeholder="ID" type="hidden">
    <div class="form-group row">
               <label for="" class="col-4 ">RUC o DNI:</label>
               <div class="col-8">
                   <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                     <button class="btn btn-dark btn-sm" type="button" id="btn_datos_sunat_modificar">Buscar</button>
                  </div>
               <input id="ruc" class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un ruc válido" pattern="[0-9]{11}" title="* El formato de <strong>RUC</strong> es de 11 dígitos" required>
               </div>
               </div>
            </div>
            <div class="form-group row">

               <label for="" class="col-4 ">Nombres :</label>
               <div class="col-8">
                  <input class="form-control" type="text" name="nombres" placeholder="Ingrese los nombres"  title="Solo letras mayúsculas o minúsculas" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Ubigeo :</label>
               <div class="col-8">
                    <select id="single" class="form-control form-control-sm select2-single" name="ubigeo" required>
                    <option></option>
                     
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Dirección :</label>
               <div class="col-8">
                  <textarea class="form-control" name="direccion" id="" cols="30" rows="5" placeholder="Ingrese la dirección " required></textarea>
                
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Teléfonos :</label>
               <div class="col-8">
                  <textarea class="form-control" name="telefono" id="" cols="30" rows="5" placeholder="Ingrese un teléfono"   title="El teléfono es de 6 o 7 números"></textarea>
                  
               </div>
            </div>
           
           
            <div class="form-group row">
               <label for="" class="col-4 ">Email :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese correo electrónico" >
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Web :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="web" placeholder="Ingrese pagina web">
               </div>
            </div>
          
            <div class="form-group row">
               <label for="" class="col-4 ">Observación:</label>
               <div class="col-8">
                  <textarea  class="form-control" name="observacion" id="" cols="10" rows="3 "></textarea>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Tipo Cliente:</label>
               <div class="col-8">
                 <select class="form-control form-control-sm" name="tipo" id="">
                    <option value="1">TIPO A</option>
                    <option value="2">TIPO B</option>
                    <option value="3">TIPO C</option>
                    <option value="4">TIPO D</option>
                 </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 "></label>
               <div class="col-8">
                  <button class="btn btn-sm btn-dark">Modificar  </button>
               </div>
            </div>


         </form>
    

<?php
require URLINC.'footer.php';
?>
