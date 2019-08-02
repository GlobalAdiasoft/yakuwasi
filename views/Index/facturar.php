<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid font_azul">
    <div class="row">
        <div class="col-12">
            <hr>
            <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Facturar</h4>

            <hr>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
         <form id="form_agregar_factura" action="<?php echo URL ?>Facturas/agregar_facturas" method="post">
            <div class="row">
                    <div class="col-12 col-lg-4 col-xl-4">
                    <div class= "form-group">
                        <label for="">Fecha: </label>
                        <input class="form-control form-control-sm" type="text" name="fecha" value="<?php echo fecha_mysql; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Correlativo de Factura:</label>
                       <select class="form-control form-control-sm" name="correlativo" id="" required>
                          <option value="FFF1">Factura (F001)</option>
                          <option value="BBB1" selected>Boleta (B001)</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Numero de Factura:</label>
                        <input type="number" class="form-control form-control-sm" min="0" required name="numero_factura" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Moneda :</label>
                        <select class="form-control form-control-sm" name="moneda" id="" required >
                          <option value="" selected disabled>Seleccione Moneda</option>
                          <option value="1">SOLES</option>
                          <option value="2">DÓLARES</option>
                        </select>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Tipo de Cambio: <a href="http://e-consulta.sunat.gob.pe/cl-at-ittipcam/tcS01Alias" target="_blank">Cambio Sunat</a></label>
                        <input type="number" class="form-control form-control-sm two-decimals2 " step="any" min="0" required name="tipocambio" readonly>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Sunat transacción:</label>
                       <select name="sunat_transaccion" id="" class="form-control form-control-sm" required>
                        <option value="" selected disabled>Seleccione Transacción</option>
                         <option value="1">VENTA INTERNA</option>
                         <option value="10">FACTURA - GUÍA REMITENTE</option>
                       </select>
                    </div>
                </div>

            </div>
             <div class="row">
              <div class="col-12 col-lg-4 col-xl-4">
                <div class="row">
                 <div class="col-12">
                     <div class= "form-group">
                        <label for="">Medio de pago: </label>
                         <select name="medio_pago" id="" class="form-control form-control-sm" required>
                          <option value="" disabled selected>Seleccione medio de pago</option>
                          <option value="EFECTIVO">EFECTIVO</option>
                          <option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
                          <option value="CUENTA AHORROS">CUENTA AHORROS</option>
                        </select>
                    </div>
                  </div>
                   <div class="col-12">
                     <div class= "form-group">
                        <label for="">Condiciones de Pago : </label>
                        <select name="condiciones_pago" id="" class="form-control form-control-sm" disabled>
                          <option value="" disabled selected>Seleccione condicion de pago</option>
                          <option value="CONTADO">CONTADO</option>
                          <option value="CRÉDITO 30 DÍAS">CRÉDITO 30 DÍAS</option>
                          <option value="CRÉDITO 60 DÍAS">CRÉDITO 60 DÍAS</option>
                        </select>
                    </div>
                  </div>

                   <div class="col-12">
                     <div class= "form-group">
                        <label for="">N° Guia de Remitente: </label>
                        <input name="guia_serie" class="form-control form-control-sm" type="text" pattern="\d{3}[\-]\d{6}" disabled title="Ejemplo: 004-000001">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-8 col-xl-8">
                <div class="form-group">
            <label for="">COD_Cliente:</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">

                <button  id="btn_editar_modal"  type="button" class="input-group-addon btn btn-sistema2 btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="fa fa-plus-circle" aria-hidden="true"></i>    </small>
                </button>
                <input class="form-control form-control-sm" type="number" name="cli_id" min="1" required list="datalist_rucs">
            </div>
            </div>
            <div><small><strong>Cliente : </strong><span class="reset_datos" id="cli_nombre"></span></div>
               </small>
                <div><small><strong>Ruc : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>
                <div><small><strong>Ubigeo : </strong><span id="cli_ubigeo" class="reset_datos"></span></small></div>
                <div><small><strong>Dirección : </strong><span id="cli_direccion" class="reset_datos"></span></small></div>
                <div><small><strong>Teléfono : </strong><span id="cli_telefono" class="reset_datos"></span></small></div>
                <div><small><strong>Calular : </strong><span id="cli_celular" class="reset_datos"></span></small></div>
                <hr>
                </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Cantidad :</label>
                            <input type="number" class="form-control form-control-sm" min="0" required="" name="cantidad">
                        </div>
                    </div>
                      <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Código Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus"  title="Solo texto" required name="codproducto" required list="datalist_codpro">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus"  title="Solo texto" required name="producto">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Precio Unitario:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any"  min="0" required name="preciounitario">
                        </div>
                    </div>
                     <div class="col-6">
                        <div class="form-group">
                            <label for="">Total:</label>
                           <input class="form-control form-control-sm two-decimals" type="number" step="any"  min="0" required name="total" readonly>

                        </div>
                    </div>
                </div>
                   <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                           <button type="button" class="btn btn-sistema2" onclick="location.reload()"><i class="fab fa-wpforms"></i> Facturar</button>
                           <button type="submit" class="btn btn-sistema2"><i class="far fa-plus-square"></i> Agregar</button>
                        </div>



                    </div>

                 </div>
                 <input type="text" name="moneda" readonly>
                 <input type="text" name="sunat_transaccion" readonly>
                 <input type="text" name="condiciones_pago" readonly>
                <input type="text" name="medio_pago" readonly>


</form>
            </div>
        <div class="col-6" >
         <div class="table-responsive">
            <table id="tabla_itemsfactura" class="table table-striped table-bordered table-sm">

            </table>
         </div>
        </div>
        </div>
    </div>


<div class="modal_agregar_cliente" id="m_agregar_cliente">
    <div class="hm-modal-content">
        <div class="hm-modal-head">
            <h4><i class="fa fa-bars" aria-hidden="true"></i> Modicar Clientes</h4>
         <span ><i class="far fa-edit"></i> Aquí podrá modificar los datos del cliente seleccionado</span>
        </div>
        <div class="hm-modal-body">
                 <form id="form_agregar_cliente" action="<?php echo URL ?>Clientes/agregar_clientes" method="post">
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Nombres :</label>
               <div class="col-8">
<input class="form-control" type="text" required=""  value="" name="nombres" id="names_pattern2" list="names_pattern2_datalist" placeholder="Nombres y Apellidos"
pattern="([a-zA-ZÁÉÍÓÚñáéíóú]{1,}[\s]*)+" title="Solo letras mayúsculas o minúsculas ">               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Ubigeo :</label>
               <div class="col-8">
                    <select id="single" class="form-control select2-single" name="ubigeo" required>
                    <option></option>

                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Dirección :</label>
               <div class="col-8">
                  <input class="form-control" type="text" name="direccion" placeholder="Ingrese la dirección " required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Teléfono :</label>
               <div class="col-8">
                  <input class="form-control" type="text" name="telefono" placeholder="Ingrese un teléfono" pattern="\d{6,7}"  title="El teléfono es de 6 o 7 números" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Celular :</label>
               <div class="col-8">
                  <input class="form-control" type="text" name="celular" placeholder="Ingrese un celular" pattern="\d{9}"  title="El celular son de 9 números" required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">RUC :</label>
               <div class="col-8">
                  <input class="form-control" type="text" name="ruc" placeholder="Ingrese un RUC valido" pattern="\d{11}"  title="El ruc contiene 11 números" required>
               </div>
            </div>

            <div class="form-group row">
               <label for="" class="col-4 font_azul">Credito :</label>
               <div class="col-8">
                     <select class="form-control" name="credito" required>
                     <option value="" selected>Seleccione si tiene credito</option>
                     <option value="1">Si</option>
                     <option value="2">No</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul">Observación:</label>
               <div class="col-8">
                  <textarea  class="form-control" name="observacion" id="" cols="10" rows="3 "></textarea>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 font_azul"></label>
               <div class="col-8">
                  <button class="btn btn-sistema2">Agregar  </button>
               </div>
            </div>
 <div class="form-group row">
               <label for="" class="col-4 font_azul"></label>
               <div class="col-8">
<img class="loading" src="<?php echo URL . URLIMG ?>spinner-of-dots.svg" alt=""><small id="emailHelp" class="form-text"></small>
              </div>
            </div>

         </form>
        </div>

    </div>
</div>
<datalist id="datalist_rucs"></datalist>
<datalist id="datalist_codpro"></datalist>
<?php
require URLINC . 'footer.php';
?>
<div id="marco">
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius reiciendis asperiores, dolor nihil id sed consectetur minima molestiae quia magnam architecto unde similique quibusdam quos, quae fugiat ab praesentium saepe.
</div>