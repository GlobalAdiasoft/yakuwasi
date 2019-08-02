<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12 col-md-3">
         <hr>
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Nuevos Gastos</h5>
         <small><i class="far fa-edit"></i>Aquí podrá agregar los gastos que se realizen</small>
         <hr>
         <form id="form_agregar" action="<?php echo URL ?>Gastos/crear" method="post">
            <div class="form-group row">
               <label for="" class="col-4 ">Fecha:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm fechas_ui" type="text" name="fecha" autocomplete="off" value="<?php echo fecha_mysql;?>" readonly required>
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">T. Impuesto:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="impuesto" required >
                     <option value="" selected>Seleccione</option>
                     <option value="Grabado">Grabado</option>
                     <option value="No Grabado">No Grabado</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">C. Total:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="costo_total" placeholder="Ingrese el costo total" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Costo:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="costo" placeholder="Ingrese el costo" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Impuesto:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="porcentaje_impuesto" placeholder="Ingrese el impuesto" value="<?php echo IGV;?>" readonly required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Descripción:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="descripcion" placeholder="Ingrese la Descripción">
               </div>
            </div>
           
            <div class="form-group row">
               <label for="" class="col-4 ">Razón:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="razon" placeholder="Ingrese una razón">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Categoría:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="categoria" required>
                     <option value="" selected>Seleccione Categoria</option>
                     <option value="Prestamos de Gerencia">Prestamos de Gerencia</option>
                     <option value="Pago de Servicios">Pago de Servicios</option>
                     <option value="Pago a Proveedores">Pago a Proveedores</option>
                     <option value="Compra de Productos">Compra de Productos</option>
                     <option value="Gastos de Colaboradores">Gastos de Colaboradores</option>
                     <option value="Gastos Varios">Gastos Varios</option>
                     <option value="Compras Varias">Compras Varias</option>
                  </select>

               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Documento:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="documento" required>
                     <option value="" selected>Seleccione</option>
                     <option value="Boleta">Boleta</option>
                     <option value="Factura">Factura</option>
                     <option value="Nota de credito">Nota de Credito</option>
                     <option value="Nota de credito">Nota de Credito</option>
                     <option value="Ticket">Ticket</option>
                     <option value="Recibo de servicios publicos">Recibo de S. P.</option>
                     <option value="Documentos Bancarios y de seguro">Documentos Bancarios y de seguro</option>
                     <option value="Recibo de Caja">Recibo de Caja</option>
                  </select>
               </div>
            </div>
  <div class="form-group row">
               <label for="" class="col-4 ">Correlativo:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="correlativo" placeholder="Ingrese un correlativo">
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">Número:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="numero" placeholder="Ingrese la serie del comprobante">
               </div>
            </div>
           
             <div class="form-group row">
               <label for="" class="col-4 ">Proveedor:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="proveedor" >

                  </select>
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">Aprobado:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="aprobado" >

                  </select>
               </div>
            </div>
              <div class="form-group row">
               <label for="" class="col-4 ">Nota:</label>
               <div class="col-8">
                  <input type="text" class="form-control form-control-sm" name="nota">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Retirar en:</label>
               <div class="col-8">
                  <input type="text" class="form-control form-control-sm" name="retiro">
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
         <h5 class=""><i class="fa fa-bars" aria-hidden="true"></i> Lista de Gastos</h5>
         <small><i class="far fa-edit"></i> Aquí podrá ver la informacion necesaria de los gastos</small>
         <hr>
         <div class="container">
            <div class="row">
               <div class="col-12" >
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
                   <table  class="datatable table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                     <thead>
                        <tr>
                      <th>#</th>
                      <th>Fecha</th>
                      <th>Impuesto</th>
                      <th>Costo Total</th>
                      <th>Costo</th>
                      <th>Impuesto</th>
                      <th>Descripción</th>
                      <th>Usuario</th>
                      <th>Razon</th>
                      <th>Categoria</th>
                      <th>Documento</th>
                      <th>Correlativo</th>
                      <th>Número</th>
                      <th>Proveedor</th>
                      <th>Aprobado</th>
                      <th>Nota</th>
                      <th>Retiro</th>
                      <th>Condicion</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                        </tr>
                     </thead>
                  </table>
                  <table>
                    <tr>
                      <td><b>Costo Total :</b></td>
                      <td class="td_costo_total"></td>
                    </tr>
                    <tr>
                      <td><b>Costo :</b></td>
                      <td class="td_costo"></td>
                    </tr>
                  </table>
               
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
</div>

<?php
require URLINC . 'footer.php';
?>

         <form id="form_modificar" action="<?php echo URL ?>Gastos/modificar" method="post" class="ocultar">
            <input type="hidden" name="id">
            <div class="form-group row">
               <label for="" class="col-4 ">Fecha:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm fechas_ui" type="text" name="fecha" autocomplete="off" value="<?php echo fecha_mysql;?>" readonly required>
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">T. Impuesto:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="impuesto" required >
                     <option value="" selected>Seleccione</option>
                     <option value="Grabado">Grabado</option>
                     <option value="No Grabado">No Grabado</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">C. Total:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="costo_total" placeholder="Ingrese la costo total" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Costo:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="costo" placeholder="Ingrese el costo" step="any">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Impuesto:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="porcentaje_impuesto" placeholder="Ingrese el impuesto" value="<?php echo IGV;?>" readonly required>
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Descripción:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="descripcion" placeholder="Ingrese la Descripción">
               </div>
            </div>
           
            <div class="form-group row">
               <label for="" class="col-4 ">Razón:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="razon" placeholder="Ingrese una razón">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Categoría:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="categoria" required>
                     <option value="" selected>Seleccione Categoria</option>
                     <option value="Prestamos de Gerencia">Prestamos de Gerencia</option>
                     <option value="Pago de Servicios">Pago de Servicios</option>
                     <option value="Pago a Proveedores">Pago a Proveedores</option>
                     <option value="Compra de Productos">Compra de Productos</option>
                     <option value="Gastos de Colaboradores">Gastos de Colaboradores</option>
                     <option value="Gastos Varios">Gastos Varios</option>
                     <option value="Compras Varias">Compras Varias</option>
                  </select>

               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Documento:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="documento" required>
                     <option value="" selected>Seleccione</option>
                     <option value="Boleta">Boleta</option>
                     <option value="Factura">Factura</option>
                     <option value="Nota de credito">Nota de Credito</option>
                     <option value="Nota de credito">Nota de Credito</option>
                     <option value="Ticket">Ticket</option>
                     <option value="Recibo de servicios publicos">Recibo de S. P.</option>
                     <option value="Documentos Bancarios y de seguro">Documentos Bancarios y de seguro</option>
                     <option value="Recibo de Caja">Recibo de Caja</option>
                  </select>
               </div>
            </div>
  <div class="form-group row">
               <label for="" class="col-4 ">Correlativo:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="text" name="correlativo" placeholder="Ingrese un correlativo">
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">Número:</label>
               <div class="col-8">
                  <input class="form-control form-control-sm" type="number" name="numero" placeholder="Ingrese la serie del comprobante">
               </div>
            </div>
           
             <div class="form-group row">
               <label for="" class="col-4 ">Proveedor:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="proveedor" >

                  </select>
               </div>
            </div>
             <div class="form-group row">
               <label for="" class="col-4 ">Aprobado:</label>
               <div class="col-8">
                  <select class="form-control form-control-sm" name="aprobado" >

                  </select>
               </div>
            </div>
              <div class="form-group row">
               <label for="" class="col-4 ">Nota:</label>
               <div class="col-8">
                  <input type="text" class="form-control form-control-sm" name="nota">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 ">Retirar en:</label>
               <div class="col-8">
                  <input type="text" class="form-control form-control-sm" name="retiro">
               </div>
            </div>
            <div class="form-group row">
               <label for="" class="col-4 "></label>
               <div class="col-8">
                  <button class="btn btn-sm btn-dark">Modificar</button>
               </div>
            </div>
         </form>