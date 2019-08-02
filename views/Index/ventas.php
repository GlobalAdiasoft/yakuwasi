<?php
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid">
  <div class="row">

    <div class="col-12 col-md-12">
      <hr>
      <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Ventas</h5>
      <small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todas las ventas</small>
      <hr>
      <div class="row">
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="" >Fecha Inicio : </label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                    <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="far fa-calendar-alt fa-lg"></i>    </small>
                    </button>
                    <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_incio" type="text">
                  </div>
                  
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="" >Fecha Final : </label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                    <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="far fa-calendar-alt fa-lg"></i>    </small>
                    </button>
                    <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_final" type="text">
                  </div>
                  
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="" >Producto : </label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                    <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="fab fa-product-hunt fa-lg"></i>    </small>
                    </button>
                    <input autocomplete="off" class="form-control form-control-sm " name="pro_busqueda" type="text" list="datalist_pro_busqueda">
                  </div>
                  
                </div>
              </div>
         </div>
              
            </div>
            <br>

    <div class="col-12 col-md-12">
            <table  class="datatable table table-striped table-bordered dt-responsive  text-center" style="width:100%">
              <thead>
                <tr>
                	<th>Fecha</th>
                  <th>Nombre Producto</th>
                <th>Usuario</th>
                <th>Código Producto</th>
                <th>Cantidad</th>
                <th>Precio con IGV</th>
                <th>Documento</th>
                <th>N° de Documento</th>
                <th>Total</th>
                  
                </tr>
              </thead>
            </table>
            </div>
            
          </div>
        </div>
     
<?php
require URLINC.'footer.php';
?>
<datalist id="datalist_pro_busqueda"></datalist>