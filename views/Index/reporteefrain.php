<?php
require URLINC . 'check_session.php';
require URLINC . 'head.php';
require URLINC . 'nav_dash.php';
?>
<div class="container-fluid">
  <div class="row">
   
    <div class="col-12">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Seleccione una fecha
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá seleccionar las fechas de reporte
      </small>
      <hr>
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="">Fecha Inicio : </label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
              <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente">
              <small>
              <i class="far fa-calendar-alt fa-lg"></i>
              </small>
              </button>
              <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_inicio" type="text">
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="">Fecha Final : </label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0" style="z-index: 0;">
              <button id="btn_editar_modal" type="button" class="input-group-addon btn btn-dark btn-sm  modal_agregar_cliente" data-hm-modal="m_agregar_cliente">
              <small>
              <i class="far fa-calendar-alt fa-lg"></i>
              </small>
              </button>
              <input autocomplete="off" class="form-control form-control-sm fechas_ui" name="fecha_final" type="text">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Contado
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
      <table id="table_contado" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VALOR TOTAL</th>
             <th>HECHO POR</th>
             <th>NUM BOLETA</th>
          </tr>
        </thead>
      </table>
      <table>
        <tr>
          <td>
            <b>Total :</b>
          </td>
          <td class="total_contado"></td>
          <td><input type="hidden" name="total_contado"></td>
        </tr>

      </table>
    </div>
    <div class="col-12 col-md-6">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte General
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
      <table id="table_all" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VALOR TOTAL</th>
            <th>HECHO POR</th>
            <th>NUM BOLETA</th>
          </tr>
        </thead>
      </table>
      <table>
        <tr>
          <td>
            <b>Total :</b>
          </td>
          <td class="total_all"></td>
          <td><input type="hidden" name="total_all"></td>
        </tr>
      </table>
    </div>
    <div class="col-12 col-md-6">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Débito
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
      <table id="table_debit" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VALOR TOTAL</th>
            <th>HECHO POR</th>
            <th>NUM BOLETA</th>
          </tr>
        </thead>
      </table>
      <table>
        <tr>
          <td>
            <b>Total :</b>
          </td>
          <td class="total_debit"></td>
        </tr>
      </table>
    </div>
    <div class="col-12 col-md-6">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Crédito
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
      <table id="table_credi" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VALOR TOTAL</th>
            <th>HECHO POR</th>
            <th>NUM BOLETA</th>
          </tr>
        </thead>
      </table>
      <table>
        <tr>
          <td>
            <b>Total :</b>
          </td>
          <td class="total_credi"></td>
        </tr>
      </table>
    </div>
     <div class="col-12 col-md-6">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Gastos
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
      <table id="table_gastos" class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VALOR TOTAL</th>
          </tr>
        </thead>
      </table>
      <table>
        <tr>
          <td>
            <b>Total :</b>
          </td>
          <td class="total_gastos"></td>
          <td><input type="hidden" name="total_gastos"></td>
        </tr>
      </table>
    </div>
       <div class="col-12 col-md-6">
          <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Utilidad
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
        <table class="table table-bordered">
        <thead>
          <tr>           
            <th>DESCRIPCION</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><b>Total Ingresos :</b></td>
            <td class="reporte_total_ingreso"></td>
          </tr>
          <tr>
            <td><b>Total Egresos :</b></td>
            <td class="reporte_total_egreso"></td>
          </tr>
          <tr>
            <td><b>Total Utilidad :</b></td>
            <td class="reporte_total_utilidad"></td>
          </tr>
        </tbody>
      </table>
       </div>
           <div class="col-12 col-md-6">
          <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Utilidad 2
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
        <table class="table table-bordered">
        <thead>
          <tr>           
            <th>DESCRIPCION</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><b>Total Contado :</b></td>
            <td class="reporte2_total_contado"></td>
          </tr>
          <tr>
            <td><b>Total Egresos :</b></td>
            <td class="reporte2_total_egreso"></td>
          </tr>
          <tr>
            <td><b>Total Utilidad :</b></td>
            <td class="reporte2_total_utilidad"></td>
          </tr>
        </tbody>
      </table>
       </div>
     <div class="col-12">
      <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte en grafico 
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte en graficas
      </small>
      <hr>
       <div id="container" >
         
       </div>

    </div>
  </div>
  <br>
</div>    
<?php
require URLINC . 'footer.php';
?>
