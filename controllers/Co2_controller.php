<?php
class Co2_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    function agregar(){
        $id                   = null;
        $factura              = $_POST['numero_factura'];
        $proveedor            = $_POST['proveedor'];
        $producto             = $_POST['articulo'];
        $cantidad             = $_POST['cantidad'];
        $moneda               = $_POST['moneda'];
        $precio_compra_conigv = $_POST['produ_precio_ventaconigv'];
        $precio_compra_sinigv = $_POST['produ_precio_ventasinigv'];
        $fecha_hora           = fecha_mysql;
        $usuario              = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $compras = new Compras($id, $factura, $proveedor, $producto, $cantidad, $moneda, $precio_compra_conigv, $precio_compra_sinigv, $fecha_hora, $usuario);
    }
       function mostrar(){
          
        $compras = Compras::where('factura', empty($_GET['factura'])?'':$_GET['factura']);
        $data=array();
         foreach ($compras as $value) {
             $articulo = Articulos::getById($value['producto']);
             if ($value['moneda']=='PEN'){
                 $simbolo = 'S/ ';
             }
              if ($value['moneda']=='USD'){
                 $simbolo = 'USD ';
             }
              array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "factura" => mb_strtoupper($value['factura']),
                "proveedor" => mb_strtoupper($value['proveedor']),
                "producto" => mb_strtoupper($articulo->getArt_nombre()),
                "cantidad" => mb_strtoupper($value['cantidad']),
                "moneda" => mb_strtoupper($value['moneda']),
                "precio_compra_conigv" => mb_strtoupper($simbolo.number_format($value['precio_compra_conigv'], 2, '.', ',')),
                "precio_compra_sinigv" => mb_strtoupper($value['precio_compra_sinigv']),
                "precio_total"=>mb_strtoupper($simbolo.number_format($value['precio_total'], 2, '.', ',')),
                "fecha_hora" => mb_strtoupper($value['fecha_hora']),
                "usuario" => mb_strtoupper($value['usuario']),               
            ));
         }
         echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function calcular(){
          $compras = Compras::where('factura', empty($_POST['factura'])?'':$_POST['factura']);
           //$compras = Compras::where('factura', 'F-233');
           $subtotal = 0;
           $data = array();
           foreach ($compras as $value) {
               $subtotal = $subtotal + $value['precio_total'];
           }
           $igv = $subtotal *0.18;
           $total=$subtotal + $igv;
           array_push($data, array(
               'subtotal' => 'S/ '.number_format($subtotal, 2, '.', ','),
               'igv' => 'S/ '.number_format($igv, 2, '.', ','),
               'total' => 'S/ '.number_format($total, 2, '.', ','),
           ));
            echo json_encode($data, JSON_PRETTY_PRINT);
    }
     function eliminar() {
                $compras   = Compras::getById($_POST['id']);
                $compras->delete();

    }
}
