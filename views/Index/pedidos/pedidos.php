<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid font_azul">
    <div class="row">
        <div class="col-12">
            <hr>
            <h4 class="font_azul"><i class="fa fa-bars" aria-hidden="true"></i> Pedidos</h4>
            <hr>
        </div>
        <div class="col-12 col-lg-5 col-xl-5">
            <form id="form_agregar_pedido" action="<?php echo URL ?>Pedidos/agregar_pedidos" method="post">
                <div class="row">
                      <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Código Pedido: </label>
                           <input class="form-control form-control-sm" type="text" readonly name="codigo_pedido">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Fecha: </label>
                            <input class="form-control form-control-sm" type="text" name="fecha" value="<?php echo fecha_mysql; ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Para la guía el formato es YYYY-MM-DD" placeholder="YYYY-MM-DD" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Documento: </label>
                            <select name="tipo_documento_sel" id="" class="form-control form-control-sm" required>
                                <option value=""  disabled>Seleccione documento</option>
                                <option value="BOL" selected>Boleta</option>
                                <option value="FAC">Factura</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-12 col-lg-4 col-xl-4">
                   <div class="form-group">
                     <label for="">Moneda: </label>
                        <select class="form-control form-control-sm" name="moneda_change" id="" required>
                <option value="" disabled >Seleccione una moneda</option>
                <option value="PEN" selected=""hidden>Soles</option>
                <option value="USD">Dólares</option>
            </select>
                   </div>
                   </div>
                    <div class="col-12 col-lg-8 col-xl-8">
                        <div class="form-group">
                            <label for="">Número de Documento :</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
                                <button id="btn_agregar" type="button" class="input-group-addon btn btn-sistema2 btn-sm  "><small><i class="fa fa-plus-circle" aria-hidden="true"></i>    </small>
                                </button>
                                <input class="form-control form-control-sm" type="text" name="cli_id" min="1" required list="datalist_rucs">
                            </div>
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

                    <div class="col-12 col-lg-6 col-xl-4">
                        <div class="form-group">
                            <label for="">Código Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus" title="Solo texto" required name="codproducto" required list="datalist_codpro" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div class="form-group">
                            <label for="">Producto :</label>
                            <input type="text" class="form-control form-control-sm input-mayus" title="Solo texto" required name="producto" readonly>
                        </div>
                    </div>
                     <div class="col-12 col-lg-6 col-xl-4">
                        <div class="form-group">
                            <label for="">Stock :</label>
                            <input type="text" class="form-control form-control-sm input-mayus" title="Solo texto" required name="stock" readonly>
                        </div>
                    </div>
                     <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Cantidad :</label>
                            <input type="number" class="form-control form-control-sm" required="" name="cantidad" min="1" value="1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Valor sin IGV:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0" required name="valor_venta_sin_igv">
                        </div>
                    </div>
                         <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Valor con IGV:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0" required name="valor_venta_con_igv">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Total:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0" required name="total" >
                        </div>
                    </div>
                     <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="">Total IGV:</label>
                            <input class="form-control form-control-sm two-decimals" type="number" step="any" min="0" required name="total_igv" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-dark">Agregar</button>
                            <button type="button" class="btn btn-sm btn-dark" onclick="limpiar()">Nuevo</button>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="pro_id" readonly>
                 <input type="hidden" name="tipo_documento" readonly>
                 <input type="hidden" name="moneda" readonly="">

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
<datalist id="datalist_rucs"></datalist>
<datalist id="datalist_codpro"></datalist>
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
<?php
require URLINC . 'footer.php';
?>

