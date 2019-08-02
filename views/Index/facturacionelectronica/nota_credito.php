<?php  
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
?>
<div class="container-fluid font_azul">
    <div class="row">
        <div class="col-12">
            <hr>
            <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Nota de Crédito</h4>
          
            <hr>
        </div>
        <div class="col-12 col-lg-6 col-xl-6">
         <form id="form_agregar" action="<?php echo URL?>Notacredito/agregar" method="post">
            <div class="row">
                    <div class="col-12 col-lg-4 col-xl-4">
                    <div class= "form-group">
                        <label for="">Fecha: </label>
                        <input class="form-control form-control-sm" type="text" value="<?php echo fecha_mysql;?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly name="fecha">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Serie:</label>
                     <select class="form-control form-control-sm" name="correlativo" id="" required >
                       <option value="" disabled selected>Seleccione Serie</option>
                       <option value="BBB1">Boleta</option>
                       <option value="FFF1">Factura</option>
                     </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Número:</label>
                        <input type="number" class="form-control form-control-sm" min="0" required name="numero" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Moneda :</label>
                        <select class="form-control form-control-sm" name="moneda" id="" required >
                          <option value=""  disabled selected>Seleccione Moneda</option>
                          <option value="PEN">SOLES</option>
                          <option value="USD">DÓLARES</option>
                        </select>
                    </div>
                </div>
                  <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Tipo de Cambio:</label>
                        <input type="number" class="form-control form-control-sm two-decimals2 " step="any" min="0" name="tipocambio" readonly>
                    </div>
                </div>
                 <div class="col-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label for="">Sunat transacción:</label>
                       <select name="sunat_transaccion" id="" class="form-control form-control-sm" required>
                        <option value=""  disabled selected>Seleccione Transacción</option> 
                         <option value="1" >VENTA INTERNA</option>
                       
                       </select>
                    </div>
                </div>

            </div>
             <div class="row">
              <div class="col-12 col-lg-4 col-xl-4">
                <div class="row">
                  <div class="col-12 ">
                    <div class= "form-group">
                        <label for="">Fecha de vencimiento: </label>
                        <input class="form-control form-control-sm fecha_ui" type="text" value="<?php echo fecha_mysql;?>" required  title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" name="fecha_venc" required>
                    </div>
                </div>
                 <div class="col-12 ">
                    <div class= "form-group">
                        <label for="">Documento a modificar: </label>
                        <select class="form-control form-control-sm" name="documento_modi" id="" required>
                          <option value="1">Factura</option>
                          <option value="2">Boleta</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 ">
                    <div class= "form-group">
                        <label for="">Numero a Modificar: </label>
                        <input class="form-control form-control-sm" type="text" name="numero_modi" required>
                    </div>
                </div>
                 <div class="col-12 ">
                    <div class= "form-group">
                        <label for="">Tipo Nota de Crédito: </label>
                        <select class="form-control form-control-sm" name="nota_tipo" id="" required>
                          <option value="1">ANULACIÓN DE LA OPERACIÓN</option>
                          <option value="2">ANULACIÓN POR ERROR EN EL RUC</option>
                          <option value="3">CORRECCIÓN POR ERROR EN LA DESCRIPCIÓN</option>
                          <option value="4">DESCUENTO GLOBAL</option>
                          <option value="5">DESCUENTO POR ÍTEM</option>
                          <option value="6">DEVOLUCIÓN TOTAL</option>
                          <option value="7">DEVOLUCIÓN POR ÍTEM</option>
                          <option value="8">BONIFICACIÓN</option>
                          <option value="9">DISMINUCIÓN EN EL VALOR</option>
                        </select>
                    </div>
                </div>
                </div>
              </div>
              <div class="col-12 col-lg-8 col-xl-8">
                <div class="form-group">  
            <label for="">Número de Documento :</label>
        
                <input class="form-control form-control-sm" type="number" name="cli_id" min="1" required list="datalist_rucs" readonly>
        
            </div>
           <div><small><strong>Cliente : </strong><span class="reset_datos" id="cli_nombre"></span></small></div>
                <div><small><strong>Tipo de Documento : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>
                <div><small><strong>Número de Documento : </strong><span id="cli_ruc" class="reset_datos"></span></small></div>
                <div><small><strong>Ubigeo : </strong><span id="cli_ubigeo" class="reset_datos"></span></small></div>
                <div><small><strong>Dirección : </strong><span id="cli_direccion" class="reset_datos"></span></small></div>
                <div><small><strong>Teléfono : </strong><span id="cli_telefono" class="reset_datos"></span></small></div>
                <div><small><strong>Calular : </strong><span id="cli_celular" class="reset_datos"></span></small></div>
                <hr>
                </div>
                </div>
                  <div class="row">

                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">Código Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus" title="Solo texto"  name="codproducto"  list="datalist_codpro" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus" title="Solo texto"  name="producto" readonly>
                        </div>
                    </div>
                     <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Cantidad :</label>
                            <input type="number" class="form-control form-control-sm"  name="cantidad" min="1" value="1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Valor sin IGV:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0"  name="valor_venta_sin_igv">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Total:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0"  name="total" readonly>
                        </div>
                    </div>
                </div>
                   <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-dark">Finalizar</button>
                            <button type="button" class="btn btn-sm btn-dark" onclick="agregaritems()">Agregar Item</button>
                            <button type="button" class="btn btn-sm btn-dark" onclick="limpiar()">Nuevo</button>
                <button type="button" class="btn btn-sm btn-dark" onclick="abre_ventana()">Traer Items</button>
                        </div>
                    </div>

                </div>
             
                 
                 
</form>
            </div>
         <div class="col-12 col-lg-6 col-xl-6" >

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

      </div>
       <div class="col-12">
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
           </div>

    </div>
        </div>
    </div>
  


<datalist id="datalist_rucs"></datalist>
<datalist id="datalist_codpro"></datalist>
<?php
require URLINC.'footer.php';
?>
