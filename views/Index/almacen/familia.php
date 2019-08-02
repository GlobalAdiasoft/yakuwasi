<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-3">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Nuevas Familias</h5>
         <small><i class="far fa-edit"></i>Aquí podrá agregar nuevas familias</small>
         <hr>
         <form id="form_agregar" action="<?php echo URL ?>Familias/agregar" method="post">
            <div class="form-group row">
               <label for="" class="col-5">Código Interno :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="codinterno" placeholder="Ingrese el código interno" required autocomplete="off">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5 ">Nombre :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="nombre" placeholder="Ingrese nombre de familia" required autocomplete="off">
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
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Familias</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos las familias</small>
         <hr>
         <div class="container">
        <div class="row">
          <div class="col-12" >

                <table  class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Codigo Interno</th>
                     <th>Nombre</th>
                     <th>Cod Usuario</th>
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

 <form id="form_modificar" action="<?php echo URL ?>Familias/modificar" method="post" class="ocultar">
 	<input class="form-control form-control-sm" name="id" placeholder="ID" type="hidden">
            <div class="form-group row">
               <label for="" class="col-5">Código Interno :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="codinterno" placeholder="Ingrese el código interno" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-5 ">Nombre :</label>
               <div class="col-7">
                  <input class="form-control form-control-sm" type="text" name="nombre" placeholder="Ingrese nombre de familia" required>
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
require URLINC . 'footer.php';
?>
