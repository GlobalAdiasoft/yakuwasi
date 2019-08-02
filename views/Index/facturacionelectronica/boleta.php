<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid font_azul">
  <div class="row">
    <div class="col-12">
      <hr>
      <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Boleta</h4>

      <hr>
    </div>
    <div class="col-12 col-lg-5 col-xl-5">
     <!--<form id="form_agregar_factura" action="<?php echo URL ?>Pedidos/agregar_pedidos" method="post">-->
      <form id="form_agregar_factura1" action="<?php echo URL ?>Ventas/agregar" method="post">
        <div class="row">
          <div class="col-12 col-lg-3 col-xl-3">
            <div class= "form-group">
              <label for="">Fecha: </label>
              <input class="form-control form-control-sm " type="text" name="fecha" value="<?php echo fecha_mysql; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-xl-3">
            <div class="form-group">
              <label for="">Serie Boleta:</label>
              <input class="form-control form-control-sm " type="text" value="BBB1" name="serie" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-xl-3">
            <div class="form-group">
              <label for="">N° Boleta:</label>
              <input type="number" class="form-control form-control-sm " min="0" required name="numero_factura" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-xl-3">
            <div class="form-group">
              <label for="">Código Pedido: </label>
              <input class="form-control form-control-sm" type="text" readonly name="codigo_pedido">
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Moneda :</label>
              <select class="form-control form-control-sm " name="moneda_change" id="" required >
                <option value="" disabled>Seleccione Moneda</option>
                <option value="PEN" selected>SOLES</option>
                <option value="USD">DÓLARES</option>
              </select>
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Tipo de Cambio:</label>
              <input type="number" class="form-control form-control-sm  two-decimals2 " step="any" min="0" required name="tipocambio" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Sunat transacción:</label>
              <select name="sunat_transaccion" id="" class="form-control form-control-sm " required>
                <option value=""  disabled>Seleccione Transacción</option>
                <option value="1" selected>VENTA INTERNA</option>

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
                  <select name="medio_pago" id="" class="form-control form-control-sm " required>
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
              <div class="col-12">
                <div class= "form-group">
                  <label for="">Condiciones de Pago : </label>
                  <select name="condiciones_pago" id="" class="form-control form-control-sm">
                    <option value="" disabled>Seleccione condicion de pago</option>
                    <option value="C" selected>CONTADO</option>
                    <option value="7">CRÉDITO 7 DÍAS</option>
                    <option value="15">CRÉDITO 15 DÍAS</option>
                    <option value="21">CRÉDITO 21 DÍAS</option>
                    <option value="30">CRÉDITO 30 DÍAS</option>
                    <option value="45">CRÉDITO 45 DÍAS</option>
                    <option value="60">CRÉDITO 60 DÍAS</option>
                  </select>
                </div>
              </div>

              <div class="col-12">
                <div class= "form-group">
                  <label for="">N° Guia de Remitente: </label>
                  <input name="guia_serie" class="form-control form-control-sm " type="text" pattern="\d{3}[\-]\d{6}"  title="Ejemplo: 004-000001">
                </div>
              </div>
              <div class="col-12">
                <div class= "form-group">
                  <label for="">Lista de precios: </label>
                  <select  class="form-control form-control-sm"name="lista" id="">
                    <option value="1">ejemplo</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-8 col-xl-8">
            <div class="form-group">
              <label for="">Número de Documento :</label>
              <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">

                <button  id="btn_agregar"  type="button" class="input-group-addon btn btn-sistema2 btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente"><small><i class="fa fa-plus-circle" aria-hidden="true"></i>    </small>
                </button>
                <input class="form-control form-control-sm " type="text" name="cli_id"  required list="datalist_rucs" autocomplete="off">
              </div>
            </div>
            <div><small><strong>Cliente : </strong><span class="reset_datos" id="cli_nombre"></span></small></div>
            <div><small><strong>Tipo de Documento : </strong><span id="" class="reset_datos"></span></small></div>
            <div><small><strong>Número de Documento : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>

            <div><small><strong>Ubigeo : </strong><span id="cli_ubigeo" class="reset_datos"></span></small></div>
            <div><small><strong>Dirección : </strong><span id="cli_direccion" class="reset_datos"></span></small></div>
            <div><small><strong>Teléfono : </strong><span id="cli_telefono" class="reset_datos"></span></small></div>
            <div><small><strong>Celular : </strong><span id="cli_celular" class="reset_datos"></span></small></div>
            <div><small><strong>Tipo : </strong><span id="cli_tipo" class="reset_datos"></span></small></div>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class= "form-group">
                  <label for="">Comentarios : </label>
                   <textarea name="comentario" id=""  rows="2" class="form-control form-control-sm" placeholder="Describe yourself here...">
              
            </textarea>
                </div>
           
          </div>
        </div>
        <div class="row">
            <div class="col-12 ">
            <div >
              <table class="table table-sm table-bordered select_paquetes ">
                
              </table>
            </div>
          </div>
          <div class="col-12">
            <input type="hidden" name="nombre_paquete">
          </div>
          <div class="col-12 col-lg-6 col-xl-4">
            <div class="form-group">
              <label for="">Código Producto :</label>
              <input type="text" class="form-control form-control-sm  input-mayus" title="Solo texto"  name="codproducto" required list="datalist_codpro" autocomplete="off">
            </div>
          </div>
          <div class="col-12 col-lg-6 col-xl-4">
            <div class="form-group">
              <label for="">Producto :</label>
              <input type="text" class="form-control form-control-sm  input-mayus" title="Solo texto"  name="producto" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-6 col-xl-4">
            <div class="form-group">
              <label for="">Stock :</label>
              <input type="text" class="form-control form-control-sm  input-mayus" title="Solo texto"  name="stock" readonly>
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Cantidad :</label>
              <input type="number" class="form-control form-control-sm "  name="cantidad" min="1" value="1">
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Valor sin IGV:</label>
              <input class="form-control form-control-sm  two-decimals" type="number" step="any" min="0"  name="valor_venta_sin_igv">
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label for="">Total:</label>
              <input class="form-control form-control-sm  two-decimals" type="number" step="any" min="0"  name="total" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <div class="form-group">
              <button id="btn_facturar" type="button" class="btn btn-dark">Procesar Boleta</button>
              <button type="submit" class="btn btn-sm btn-dark">Agregar</button>
              <button type="button" class="btn btn-sm btn-dark" onclick="limpiar()">Nuevo</button>
            </div>
          </div>
        </div>
        <input type="text" name="pro_id" readonly>
        <input type="text" name="tipo_documento" readonly value="BOL">
        <input type="text" name="moneda" readonly>

      </form>
    </div>
    <div class="col-12 col-lg-7 col-xl-7" >
      <div class="row">
        <div class="col-12">
          <table class="datatable table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Cantidad</th>
                <th>Código Producto</th>
                <th>Producto</th>
                <th>Valor de Venta sin IGV</th>
                <th>Total</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          </table>
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
              <form id="form_agregar_caja" action="<?php echo URL ?>Caja/crear" method="post">
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
            <input type="text" name="caja_documento">
            <input type="text" name="caja_numero">
            <button type='submit' class="btn btn-sistema2 btn_caja ocultar">Agregar  </button>
          </form>
        </div>


      </div>        </div>
    </div>
  </div>

  <datalist id="datalist_rucs"></datalist>
  <datalist id="datalist_codpro"></datalist>
  <?php
require URLINC . 'footer.php';
?>
  <form id="form_agregar_cliente" action="<?php echo URL ?>Clientes/agregar_clientes" method="post" class="ocultar">

             <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">RUC o DNI:</label>
               <div class="col-12 col-md-8">
              <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                                <button id="btn_actualizar" type="button" class="input-group-addon btn btn-sistema2 btn-sm  "><small><i class="fas fa-sync-alt"></i></small>
                                </button>
                                <input class="form-control form-control-sm" type="text" name="ruc" placeholder="Ingrese un RUC valido" pattern="\d{8,11}"  title="El ruc contiene 11 números" required>
                            </div>
                          </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-12 col-md-4">Nombres :</label>
               <div class="col-12 col-md-8">
<input class="form-control form-control-sm" type="text" required=""  value="" name="nombres" id="names_pattern2"  placeholder="Nombres y Apellidos ó Razón Social"
 title="Solo letras mayúsculas o minúsculas " required>               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-12  col-md-4">Ubigeo :</label>
               <div class="col-12 col-md-8">
                    <select id="single" class="form-control form-control-sm select2-single" name="ubigeo" required>
                    <option></option>

                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">Dirección :</label>
               <div class="col-12 col-md-8">
                  <textarea class="form-control form-control-sm" name="direccion" id="" cols="30" rows="3" placeholder="Ingrese la dirección " required></textarea>

               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">Teléfonos :</label>
               <div class="col-12 col-md-8">
                  <textarea class="form-control form-control-sm" name="telefono" id="" cols="30" rows="3"></textarea>

               </div>
            </div>

            <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">Email :</label>
               <div class="col-12 col-md-8">
                  <input class="form-control form-control-sm" type="email" name="email" placeholder="Ingrese correo electrónico" >
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">Web :</label>
               <div class="col-12 col-md-8">
                  <input class="form-control form-control-sm" type="url" name="web" placeholder="Ingrese pagina web">
               </div>
            </div>


            <div class="form-group row">
               <label for="" class="col-12 col-md-4 ">Observación:</label>
               <div class="col-12 col-md-8">
                  <textarea  class="form-control form-control-sm" name="observacion" id="" cols="10" rows="3 "></textarea>
               </div>
            </div>
            <div class="form-group row">

               <div class="col-12 text-center">
                  <button class="btn btn-dark btn-sm">Agregar  </button>
               </div>
            </div>


         </form>

