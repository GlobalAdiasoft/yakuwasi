<?php  
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <hr>
         <h4 class="font_azul"><i class="fa fa-bars " aria-hidden="true"></i> Caja 2</h4>
         <small class="font_azul"><i class="far fa-edit"></i> Aquí podrá ver toda la información de caja 2</small>
         <hr>
                      <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="" >Fecha Inicio : </label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                    <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="far fa-calendar-alt fa-lg"></i>    </small>
                    </button>
                    <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_inicio" type="text">
                  </div>
                  
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="" >Fecha Final : </label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                    <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="far fa-calendar-alt fa-lg"></i>    </small>
                    </button>
                    <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_final" type="text">
                  </div>
                  
                </div>
              </div>
             
         </div>  
          <table class="datatable table table-striped table-bordered dt-responsive text-center" style="width:100%"><!--nowrap -->
               <thead>
                  <tr>
                     <th>#</th>
                     <!--<th>Usuario</th>-->
                     <th>Fecha | Hora</th>
                     <!--<th>Hora</th>-->
                     <th>Modulo</th>
                     <th>Descripcion</th>
                     <th>Tipo_pago</th>
                     <th>Visa</th>
                     <th>Ingreso</th>
                     <th>Salida</th>
                   
                  </tr>
               </thead>
            </table>
       
          
        
        
      </div>
   </div>
</div>


<?php
require URLINC.'footer.php';
?>