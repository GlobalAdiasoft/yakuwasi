<?php
class ComprasNuevo_controller extends Controller {
   function mostrar() {
      $compras      = Compras::getAllDistAll('factura');
      $data_compras = array();
      foreach ($compras as $value) {
          $simbolo = $value['moneda'];
         switch ($simbolo) {
            case 'PEN':
               $simbolo = 'S/ ';
               break;
            case 'USD':
               $simbolo = 'USD ';
               break;
         }
         $proveedor = Proveedores::getById($value['proveedor']);
         $usuarios  = Usuario::getById($value['usuario']);
         $subtotal  = $this->subtotal_compras($value['factura']);
         $igv       = $subtotal * 0.18;
         $total     = $subtotal + $igv;
         array_push($data_compras, array(
            'factura' => $value['factura'],
            'proveedor' => $proveedor->getPro_ruc() . ' - ' . $proveedor->getPro_razonsocial(),
            'moneda' => $value['moneda'],
            'subtotal' => $simbolo . ' ' . number_format((float) $subtotal, 2, '.', ','),
            'igv' => $simbolo . ' ' . number_format((float) $igv, 2, '.', ','),
            'total' => $simbolo . ' ' . number_format((float) $total, 2, '.', ','),
            'fecha_hora' => $value['fecha_hora'],
            'usuario' => mb_strtoupper($usuarios->getUsu_usuario())
         ));
      }
      echo json_encode($data_compras, JSON_PRETTY_PRINT);
   }
   function eliminar() {
      $compras = Compras::where('factura', $_POST['factura']);
      foreach ($compras as $value) {
         $compras_ = Compras::getById($value['id']);
         $compras_->delete();
      }
   }
   function subtotal_compras($factura) {
      $compras = Compras::where('factura', $factura);
      $total   = 0;
      foreach ($compras as $value) {
         $total   = $total + $value['precio_total'];
         
      }
      return $total;
   }
   function subtotal_compras($factura) {
      $compras = Compras::where('factura', $factura);
      $total   = 0;
      foreach ($compras as $value) {
         $total   = $total + $value['precio_total'];
         
      }
      return $total;
   }
   function subtotal_compras_general() {
      $compras = Compras::getAll();
      $total   = 0;
      foreach ($compras as $value) {
         $total   = $total + $value['precio_total'];
         
      }
      return $total;
   }
   function detalles() {
      $compras = Compras::where('factura', $_GET['factura']);
      $data    = array();
      foreach ($compras as $value) {
         $articulo = Articulos::getById($value['producto']);
         $simbolo  = $value['moneda'];
         switch ($simbolo) {
            case 'PEN':
               $simbolo = 'S/ ';
               break;
            case 'USD':
               $simbolo = 'USD ';
               break;
         }
         array_push($data, array(
            'id' => $value['id'],
            'producto' => mb_strtoupper($articulo->getArt_nombre() . ' - ' . $articulo->getArt_codigo()),
            'cantidad' => $value['cantidad'],
            'precio_compra_conigv' => $simbolo . ' ' . number_format((float) $value['precio_compra_conigv'], 2, '.', ','),
            'precio_compra_sinigv' => $simbolo . ' ' . number_format((float) $value['precio_compra_sinigv'], 2, '.', ','),
            'precio_total' => $simbolo . ' ' . number_format((float) $value['precio_total'], 2, '.', ',')
         ));
      }
      echo json_encode($data, JSON_PRETTY_PRINT);
   }
}
