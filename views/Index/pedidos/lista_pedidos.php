
<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <hr>
            <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Pedidos</h5>
            <small><i class="far fa-edit"></i> Aquí podrá ver todas las listas de pedidos.</small>
            <hr>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                         <select class="form-control form-control-sm" name="busqueda" id="">

                          <option value="">Todos los pedidos</option>
                          <option value="1">Por revisar</option>
                          <option value="2">Aprobadas</option>
                          <option value="3">Rechazadas</option>
                      </select>
                      <br>
                        <table class="datatable_lista table table-striped table-bordered dt-responsive compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod. Pedido</th>
                                    <th>Nº Pedido</th>
                                    <th>Documento</th>
                                    <th>Usuario</th>
                                    <th>Fecha y Hora</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Moneda</th>
                                    <th>Tipo de Cambio</th>
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
 <br>
 <div id="div_form_factura" class="ocultar">

     <form id="form_factura" action="<?php echo URL ?>Facturar/crear_factura" method="post" >
      <input type="hidden" name="codigo_pedido">
             <div class="row">
                    <div class="col-12 col-lg-4 col-xl-4">
                    <div class= "form-group">
                        <label for="">Fecha: </label>
                        <input class="form-control form-control-sm" type="text" name="fecha" value="<?php echo fecha_mysql; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Serie Factura:</label>
                      <input class="form-control form-control-sm" type="text" value="FFF1" name="serie" readonly>
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
                        <select class="form-control form-control-sm" name="modena_change" id="" required >
                          <option value="" disabled>Seleccione Moneda</option>
                          <option value="PEN" selected>SOLES</option>
                          <option value="USD">DÓLARES</option>
                        </select>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Tipo de Cambio:</label>
                        <input type="number" class="form-control form-control-sm two-decimals2 " step="any" min="0" required name="tipocambio" readonly>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Sunat transacción:</label>
                       <select name="sunat_transaccion_change" id="" class="form-control form-control-sm" required>
                        <option value=""  disabled>Seleccione Transacción</option>
                         <option value="1" selected>VENTA INTERNA</option>
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
                         <select name="medio_pago_change" id="" class="form-control form-control-sm" required>
                          <option value="" disabled>Seleccione medio de pago</option>
                          <option value="EFECTIVO" selected>EFECTIVO</option>
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
                          <option value="C">CONTADO</option>
                          <option value="30">CRÉDITO 30 DÍAS</option>
                          <option value="60">CRÉDITO 60 DÍAS</option>
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
            <label for="">Número de Documento :</label>


                <input class="form-control form-control-sm" type="number" name="cli_id" min="1" required  readonly>

            </div>
            <div><small><strong>Cliente : </strong><span class="reset_datos" id="cli_nombre"></span></small></div>
                <div><small><strong>Tipo de Documento : </strong><span id="" class="reset_datos"></span></small></div>
                <div><small><strong>Número de Documento : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>

                <div><small><strong>Ubigeo : </strong><span id="cli_ubigeo" class="reset_datos"></span></small></div>
                <div><small><strong>Dirección : </strong><span id="cli_direccion" class="reset_datos"></span></small></div>
                <div><small><strong>Teléfono : </strong><span id="cli_telefono" class="reset_datos"></span></small></div>
                <div><small><strong>Calular : </strong><span id="cli_celular" class="reset_datos"></span></small></div>
                <hr>
                </div>
                </div>
                    <div class="row">
                   <table class="" style="width:100%">
                     <tr class="text-center">
                     <td><strong>Subtotal :</strong> <label class="label_subtotal"></label></td>

                 </tr>
                 <tr class="text-center">
                     <td><strong>IGV : </strong><label class="label_igv"></label></td>
                 </tr>
                 <tr class="text-center">
                      <td><strong>Total : </strong><label class="label_total"></label></td>
                 </tr>

                </table>

                </div>
<div class="row ">
  <div class="col-12 text-center">
                  <button class="btn btn-dark btn-sm">Factura</button>
                  </div>
            </div>
<input type="hidden" name="moneda" readonly>
<input type="hidden" name="sunat_transaccion" readonly>
<input type="hidden" name="condiciones_pago" readonly>
<input type="hidden" name="medio_pago" readonly>
<input type="hidden" name="pedido_usuario" readonly>
</form>
<br>
    <form id="form_agregar_caja_factura" action="<?php echo URL?>Caja/crear" method="post">
            <table id="tabla_caja" class="table table-striped table-bordered table-sm">
                  <tr>
                    <th>Total : </th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_caja" readonly autocomplete="off"> </th>
                  </tr>
                  <tr>
                    <th>Pago : </th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_pago" autocomplete="off"> </th>
                  </tr>
                  <tr>
                    <th>Vuelto :</th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_vuelto" readonly autocomplete="off"> </th>
                  </tr>
            </table>
            <input type="hidden" name="caja_documento">
            <input type="hidden" name="caja_numero">
            <button type='submit' class="btn btn-sistema2 btn_caja_factura ocultar">Agregar</button>
          </form>
</div>

 <div id="div_form_boleta" class="ocultar">
<form id="form_boleta" action="<?php echo URL ?>Boletear/crear_boleta" method="post">
  <input type="hidden" name="codigo_pedido">
             <div class="row">
                    <div class="col-12 col-lg-4 col-xl-4">
                    <div class= "form-group">
                        <label for="">Fecha: </label>
                        <input class="form-control form-control-sm" type="text" name="fecha" value="<?php echo fecha_mysql; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Serie Factura:</label>
                      <input class="form-control form-control-sm" type="text" value="BBB1" name="serie" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Numero de Factura:</label>
                        <input type="number" class="form-control form-control-sm" min="0" required name="numero_boleta" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Moneda :</label>
                        <select class="form-control form-control-sm" name="modena_change" id="" required >
                          <option value="" disabled>Seleccione Moneda</option>
                          <option value="PEN" selected>SOLES</option>
                          <option value="USD">DÓLARES</option>
                        </select>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Tipo de Cambio:</label>
                        <input type="number" class="form-control form-control-sm two-decimals2 " step="any" min="0" required name="tipocambio" readonly>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Sunat transacción:</label>
                       <select name="sunat_transaccion_change" id="" class="form-control form-control-sm" required>
                        <option value=""  disabled>Seleccione Transacción</option>
                         <option value="1" selected>VENTA INTERNA</option>
                         <!--<option value="10">FACTURA - GUÍA REMITENTE</option>-->
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
                         <select name="medio_pago_change" id="" class="form-control form-control-sm" required>
                          <option value="" disabled>Seleccione medio de pago</option>
                <option value="EFECTIVO" selected>EFECTIVO</option>
                    <option value="CUENTA CORRIENTE">CUENTA CORRIENTE</option>
                    <option value="CUENTA AHORROS">CUENTA AHORROS</option>
                    <option value="PAGO CON CHEQUE">PAGO CON CHEQUE</option>
                    <option value="VISA">VISA</option>
                    <option value="MASTERCARD">MASTERCARD</option>
                        </select>
                    </div>
                  </div>


                </div>
              </div>
              <div class="col-12 col-lg-8 col-xl-8">
                <div class="form-group">
            <label for="">Número de Documento :</label>


                <input class="form-control form-control-sm" type="number" name="cli_id" min="1" required  readonly>

            </div>
            <div><small><strong>Cliente : </strong><span class="reset_datos" id="cli_nombre"></span></small></div>
                <div><small><strong>Tipo de Documento : </strong><span id="" class="reset_datos"></span></small></div>
                <div><small><strong>Número de Documento : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>

                <div><small><strong>Ubigeo : </strong><span id="cli_ubigeo" class="reset_datos"></span></small></div>
                <div><small><strong>Dirección : </strong><span id="cli_direccion" class="reset_datos"></span></small></div>
                <div><small><strong>Teléfono : </strong><span id="cli_telefono" class="reset_datos"></span></small></div>
                <div><small><strong>Calular : </strong><span id="cli_celular" class="reset_datos"></span></small></div>
                <hr>
                </div>
                </div>
                <div class="row">
                   <table class="" style="width:100%">
                     <tr class="text-center">
                     <td><strong>Subtotal :</strong> <label class="label_subtotal"></label></td>

                 </tr>
                 <tr class="text-center">
                     <td><strong>IGV : </strong><label class="label_igv"></label></td>
                 </tr>
                 <tr class="text-center">
                      <td><strong>Total : </strong><label class="label_total"></label></td>
                 </tr>

                </table>
                </div>
<div class="row ">
  <div class="col-12 text-center">
                  <button class="btn btn-dark btn-sm">Boleta</button>
                  </div>
            </div>
<input type="hidden" name="moneda" readonly>
<input type="hidden" name="sunat_transaccion" readonly>
<input type="hidden" name="condiciones_pago" readonly>
<input type="hidden" name="medio_pago" readonly>
<input type="hidden" name="pedido_usuario" readonly>
</form>
<br>
 <form id="form_agregar_caja_boleta" action="<?php echo URL?>Caja/crear" method="post">
            <table id="tabla_caja" class="table table-striped table-bordered table-sm">
                  <tr>
                    <th>Total : </th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_caja" readonly autocomplete="off"> </th>
                  </tr>
                  <tr>
                    <th>Pago : </th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_pago" autocomplete="off"> </th>
                  </tr>
                  <tr>
                    <th>Vuelto :</th>
                    <th><input class="form-control form-control-sm two-decimals" type="text" step="any" name="total_vuelto" readonly autocomplete="off"> </th>
                  </tr>
            </table>
            <input type="hidden" name="caja_documento">
            <input type="hidden" name="caja_numero">
            <button type='submit' class="btn btn-sistema2 btn_caja_boleta ocultar">Agregar</button>
          </form>
</div>
<?php
require URLINC . 'footer.php';
?>



