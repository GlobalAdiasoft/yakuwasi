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
      
        <div class="row">
          <div class="col-12" >
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
            <br>
            <table  class="datatable1 table table-striped table-bordered dt-responsive  text-center" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>N° de Factura</th>
                  <th>Proveedor</th>
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Moneda</th>
                  <th>Precio Compra con IGV</th>
                  <th>Precio Compra sin IGV</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                  
                </tr>
              </thead>
            </table>
            
            
          </div>
        </div>
      
      
    </div>
  </div>
</div>
<?php
require URLINC.'footer.php';
?>
<form id="form_modificar" action="<?php echo URL?>Compras/modificar" method="post" class="ocultar">
  <input type="hidden" name="id">
  <div class="form-group row">
    <label for="" class="col-5">N° de Factura:</label>
    <div class="col-7">
      <input class="form-control form-control-sm" type="text" name="numero_factura">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Proveedor:</label>
    <div class="col-7">
      <select class="form-control form-control-sm select2-single" name="proveedor" required>
        <option value="" disabled selected>Seleccione un proveedor</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Artículo:</label>
    <div class="col-7">
      <select class="form-control form-control-sm select2-single" name="articulo" required>
        <option value="" disabled selected>Seleccione un artículo</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Cantidad:</label>
    <div class="col-7">
      <input class="form-control form-control-sm" type="number" name="cantidad">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Moneda: </label>
    <div class="col-7">
      <select class="form-control form-control-sm" name="moneda" id="" required>
        <option value="" disabled selected="">Seleccione una moneda</option>
        <option value="PEN">Soles</option>
        <!--<option value="USD">Dólares</option>-->
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Precio Compra con IGV:</label>
    <div class="col-7">
      <input class="form-control form-control-sm moneda" type="number" name="produ_precio_ventaconigv" step="any">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-5">Precio Compra sin IGV:</label>
    <div class="col-7">
      <input class="form-control form-control-sm moneda" type="number" name="produ_precio_ventasinigv" step="any">
    </div>
  </div>
  
  
  <div class="form-group row">
    <label for="" class="col-5 "></label>
    <div class="col-7">
      <button class="btn btn-sm btn-dark">Agregar</button>
    </div>
  </div>
  
</form>


<datalist id="datalist_pro_busqueda"></datalist>
