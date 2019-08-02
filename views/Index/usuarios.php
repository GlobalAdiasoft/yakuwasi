<?php
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-3">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Nuevos Usuarios</h5>
         <small><i class="far fa-edit"></i>Aquí podrá agregar nuevos usuarios</small>
         <hr>
         <form id="form_agregar_usuario" action="<?php echo URL?>User/register_user" method="post">
            <div class="form-group row">
               <label for="" class="col-4 ">Nombres :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="nombres" placeholder="Ingrese los nombres">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Apellidos :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="apellidos" placeholder="Ingrese los apellidos">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Correo :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese un correo">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Teléfono :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="telefono" placeholder="Ingrese un teléfono">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Celular :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="celular" placeholder="Ingrese un celular">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">DNI :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="dni" placeholder="Ingrese un DNI">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Usuario :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="usuario" placeholder="Ingrese un usuario">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Contraseña :</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="password" name="password" placeholder="Ingrese una contraseña" autocomplete="off">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Acceso:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="acceso" >
                     <option value="" selected>Seleccione</option>
                     <option value="1">Administrador</option>
                     <option value="2">Caja (Caja)</option>
                     <option value="3">Pedidos (Pedidos)</option>
                     <option value="4">Bloqueado</option>
                     <option value="5">Facturación</option>
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
      <div class="col-12 col-md-9">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Usuarios</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos los usuarios</small>
         <hr>
         <div class="container">
            <div class="row">
               <div class="col-12" >
                  
                                                                     <table  class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Nombres</th>
                           <th>Apellidos</th>
                           <th>Correo</th>
                           <th>Teléfono</th>
                           <th>Celular</th>
                           <th>DNI  </th>
                           <th>Fecha de alta</th>
                           <th>Usuario</th>
                           <th>Acesso</th>
                           <th>Modificar</th>
                           <th>Eliminar</th>
                           <th>Cambiar Contraseña</th>
                        </tr>
                     </thead>
                  </table>
                  
                  
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>
<form id="form_modificar_usuario" class="ocultar" action="<?php echo URL?>User/modificar_usuario" method="post">
   <input class="form-control form-control-sm" name="id" placeholder="ID" type="hidden">
   <div class="form-group row">
      <label for="" class="col-4 ">Nombres :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="text" name="nombres" placeholder="Ingrese los nombres">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">Apellidos :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="text" name="apellidos" placeholder="Ingrese los apellidos">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">Correo :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese un correo">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">Teléfono :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="number" name="telefono" placeholder="Ingrese un teléfono">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">Celular :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="number" name="celular" placeholder="Ingrese un celular">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">DNI :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="number" name="dni" placeholder="Ingrese un DNI">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 ">Usuario :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="text" name="usuario" placeholder="Ingrese un usuario">
      </div>
   </div>
   
   <div class="form-group row">
      <label for="" class="col-4 ">Acceso:</label>
      <div class="col-8">
         <select class="form-control form-control-sm" name="acceso" >
            <option value="" selected>Seleccione</option>
            <option value="1">Administrador</option>
            <option value="2">Caja (Caja)</option>
            <option value="3">Pedidos (Pedidos)</option>
            <option value="4">Bloqueado</option>
            <option value="5">Facturación</option>
         </select>
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 "></label>
      <div class="col-8">
         <button class="btn btn-dark btn-sm">Modificar   </button>
      </div>
   </div>
</form>
<form id="form_modificar_password" class="ocultar"  action="<?php echo URL?>User/modificar_password" method="post">
   <input class="form-control form-control-sm" name="id" placeholder="ID" type="hidden">
   <div class="form-group row">
      <label for="" class="col-4 ">Contraseña :</label>
      <div class="col-8">
         <input class="form-control form-control-sm" type="password" name="password" placeholder="Ingrese la nueva contraseña" autocomplete="off">
      </div>
   </div>
   <div class="form-group row">
      <label for="" class="col-4 "></label>
      <div class="col-8">
         <button class="btn btn-dark btn-sm">Modificar   </button>
      </div>
   </div>
   
</form>
</div>
<?php
require URLINC.'footer.php';
?>