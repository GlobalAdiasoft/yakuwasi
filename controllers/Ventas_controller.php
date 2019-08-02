<?php
class Ventas_controller extends Controller {
   public function __construct() {
      parent::__construct();
   }
   public function agregar() {
      $data =array(
          'num_boleta'=>$_POST['numero_factura'],
          'serie'=>$_POST['serie'],
      );
      $id_doc = Ventas::whereV($data, 'and');
      if(empty($id_doc)){
      $id_venta      = NULL;
      $token         = fecha_mysql . hora_mysql . Session::getValue('ID_TRA' . NOMBRE_SESSION);
      $fecha         = fecha_mysql;
      $hora          = hora_mysql;
      $mesa          = ""; //verificar este [blanco]
      $estado        = ""; //verificar este [blanco]
      $total_boleta  = ""; //verificar este [actulizar]----->programar despues de terminar
      $id_client     = $_POST['cli_id'];
      $vendedor      = Session::getValue('ID_TRA' . NOMBRE_SESSION);
      $cond_pago     = $_POST['condiciones_pago'];
      $guia_remision = $_POST['guia_serie'];
      $num_control   = ""; //verificar este [blanco]
      $moneda        = $_POST['moneda'];
      $total_bruto   = ""; //verificar este [blanco]----->programar despues de terminar
      $total_dscto   = ""; //verificar este [blanco]----->programar despues de terminar
      $valor_venta   = ""; //verificar este [blanco]----->programar despues de terminar
      $igv           = ""; //verificar este [blanco]----->programar despues de terminar
      $total_letras  = ""; //verificar este [blanco]----->programar despues de terminar
      $hecho_por     = Session::getValue('ID_TRA' . NOMBRE_SESSION);
      $fecha_pagado  = ""; //verificar este [blanco]
      $comentario    = $_POST['comentario'];
      $num_boleta    = $_POST['numero_factura'];
      $serie         = $_POST['serie'];
      $dniruc        = ""; //verificar este [blanco]
      $referencia    = ""; //verificar este [blanco]
      $estado_pago   = $_POST['medio_pago'];
      $codo          = ""; //verificar este [blanco]
      $deuda         = ""; //verificar este [blanco]
      $pagad         = ""; //verificar este [blanco]
      $tokenv        = ""; //verificar este [blanco]
      $mpago = ""; //verificar este [monto pagado]->programar despues de terminar
      $mvuelto = ""; //verificar este [monto pagado]uelto->programar despues de terminar
      $ventas  = new Ventas($id_venta, $token, $fecha, $hora, $mesa, $estado, $total_boleta, $id_client, $vendedor, $cond_pago, $guia_remision, $num_control, $moneda, $total_bruto, $total_dscto, $valor_venta, $igv, $total_letras, $hecho_por, $fecha_pagado, $comentario, $num_boleta, $serie, $dniruc, $referencia, $estado_pago, $codo, $deuda, $pagad, $tokenv, $mpago, $mvuelto);
      $ventas->create('Id_venta');
      }
      //////
      $data =array(
          'num_boleta'=>$_POST['numero_factura'],
          'serie'=>$_POST['serie'],
      );
      $id_doc = Ventas::whereV($data, 'and');
     
      $producto =$_POST['codproducto'];
    $producto= explode('|', $producto);
   
      $id = NULL;
      $id_venta=$id_doc[0]['id_venta'];//
      $llevar="";//blanco
      $num="";//blanco
      $codigo=$producto[0];
      $descripcion=$_POST['producto'];
      $precio_unitario=$_POST['valor_venta_sin_igv']*1.18;
      $cantidad=$_POST['cantidad'];
      $dscto="";//blanco
      $importe_neto=$precio_unitario*$cantidad;
      
      $estado_e="";//blanco
      $desc = new Desc_e($id, $id_venta, $llevar, $num, $codigo, $descripcion, $precio_unitario, $cantidad, $dscto, $importe_neto, $estado_e);
      $desc->create('Id_venta');
   }
   
   function verificarnumeroboleta() {
      $data   = array(
         'serie' => $_POST['correlativo']
      );
      $ventas = Ventas::whereV($data, 'and', 'num_boleta');
      if (empty($ventas)) {
         echo 1;
      } else {
         foreach ($ventas as $value) {
            $variable = $value['num_boleta'];
         }
         echo $variable + 1;
      }
   }
   public function mostrar() {
      if (empty($_GET['fechainicio']) && empty($_GET['fechafinal'])) {
         $facturas = Facturas::getAll();
         //echo 'estan vacias';
      } else {
         if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal'])) {
            $facturas = Facturas::getAll();
            //echo 'fecha final vacia';
         }
         if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal'])) {
            $facturas = Facturas::getAll();
            //echo 'fecha inicial vacia';
         }
         if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal'])) {
            $facturas = Facturas::whereBetween('fact_fecha', $_GET['fechainicio'], $_GET['fechafinal']);
            //echo 'fechas llenas';
         }
      }
      $data_general = array();
      foreach ($facturas as $value) {
         $pedidos       = $value['fact_pedido_usuario'];
         $pedidos       = explode('/', $pedidos);
         $usuarios      = Usuario::getBy('usu_usuario', $pedidos[1]);
         $datos_pedidos = array(
            'ped_id_pedidos_doc' => $pedidos[0],
            'ped_usuario' => $usuarios->getId()
         );
         $pedidos       = Pedidos::whereV($datos_pedidos, 'and');
         foreach ($pedidos as $value_pedidos) {
            if (empty($_GET['pro_busqueda'])) {
               $usuario = Usuario::getById($value_pedidos['ped_usuario']);
               array_push($data_general, array(
                  "fecha" => mb_strtoupper($value['fact_fecha']),
                  "nombre_producto" => mb_strtoupper($value_pedidos['ped_nombre_pro']),
                  "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                  "codigo_producto" => mb_strtoupper($value_pedidos['ped_cod_pro']),
                  "cantidad" => mb_strtoupper($value_pedidos['ped_cantidad']),
                  "valor_sin_igv" => mb_strtoupper(number_format((float) $value_pedidos['ped_valor_venta_sin_igv'] * 1.18, 2, '.', ',')),
                  "correlativo" => mb_strtoupper($value['fac_correlativo']),
                  "numero_factura" => mb_strtoupper($value['fac_numero_factura']),
                  "total" => mb_strtoupper(number_format((float) ($value_pedidos['ped_valor_venta_sin_igv'] * 1.18) * $value_pedidos['ped_cantidad'], 2, '.', ','))
               ));
            } else {
               if ($_GET['pro_busqueda'] == $value_pedidos['ped_cod_pro']) {
                  $usuario = Usuario::getById($value_pedidos['ped_usuario']);
                  array_push($data_general, array(
                     "fecha" => mb_strtoupper($value['fact_fecha']),
                     "nombre_producto" => mb_strtoupper($value_pedidos['ped_nombre_pro']),
                     "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                     "codigo_producto" => mb_strtoupper($value_pedidos['ped_cod_pro']),
                     "cantidad" => mb_strtoupper($value_pedidos['ped_cantidad']),
                     "valor_sin_igv" => mb_strtoupper(number_format((float) $value_pedidos['ped_valor_venta_sin_igv'] * 1.18, 2, '.', ',')),
                     "correlativo" => mb_strtoupper($value['fac_correlativo']),
                     "numero_factura" => mb_strtoupper($value['fac_numero_factura']),
                     "total" => mb_strtoupper(number_format((float) ($value_pedidos['ped_valor_venta_sin_igv'] * 1.18) * $value_pedidos['ped_cantidad'], 2, '.', ','))
                  ));
               }
            }
         }
      }
      echo json_encode($data_general, JSON_PRETTY_PRINT);
   }
   public function productos_busqueda() {
      $articulos = Articulos::getAll();
      $i         = 0;
      foreach ($articulos as $value) {
         $i++;
         echo '<option value="' . $value['art_codigo'] . '">' . $value['art_codigo'] . ' - ' . $value['art_nombre'] . '</option>';
      }
   }
   public function item_valorizado() {
      if (empty($_GET['fechainicio']) && empty($_GET['fechafinal'])) {
         $facturas = Facturas::getAll();
         //echo 'estan vacias';
      } else {
         if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal'])) {
            $facturas = Facturas::getAll();
            //echo 'fecha final vacia';
         }
         if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal'])) {
            $facturas = Facturas::getAll();
            //echo 'fecha inicial vacia';
         }
         if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal'])) {
            $facturas = Facturas::whereBetween('fact_fecha', $_GET['fechainicio'], $_GET['fechafinal']);
            //echo 'fechas llenas';
         }
      }
      $data_general = array();
      $total        = 0;
      foreach ($facturas as $value) {
         $pedidos       = $value['fact_pedido_usuario'];
         $pedidos       = explode('/', $pedidos);
         $usuarios      = Usuario::getBy('usu_usuario', $pedidos[1]);
         $datos_pedidos = array(
            'ped_id_pedidos_doc' => $pedidos[0],
            'ped_usuario' => $usuarios->getId()
         );
         $pedidos       = Pedidos::whereV($datos_pedidos, 'and');
         foreach ($pedidos as $value_pedidos) {
            if (empty($_GET['pro_busqueda'])) {
               $total_item = ($value_pedidos['ped_valor_venta_sin_igv'] * 1.18) * $value_pedidos['ped_cantidad'];
               $total      = $total + $total_item;
            } else {
               if ($_GET['pro_busqueda'] == $value_pedidos['ped_cod_pro']) {
                  $total_item = ($value_pedidos['ped_valor_venta_sin_igv'] * 1.18) * $value_pedidos['ped_cantidad'];
                  $total      = $total + $total_item;
               }
            }
         }
      }
      $total                    = $total;
      $subtotal                 = $total / 1.18;
      $igv                      = $total - $subtotal;
      $data_general['total']    = number_format((float) $total, 2, '.', ',');
      $data_general['subtotal'] = number_format((float) $subtotal, 2, '.', ',');
      $data_general['igv']      = number_format((float) $igv, 2, '.', ',');
      echo json_encode($data_general, JSON_PRETTY_PRINT);
   }
}