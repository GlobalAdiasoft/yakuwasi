<?php
class Pedidos_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function codpro() {
        $productos = Articulos::where('art_codigo', trim($_POST['codart']));
        if (empty($productos)) {
            echo 0;
        } else {
            echo json_encode($productos);
        }
    }
    public function agregar_pedidos() {
        $cod_separado = explode("|", $_POST['codproducto']);
        $var_id_cliente = $_POST['cli_id'];
        $var_id_cliente = explode('|', $var_id_cliente);
        $clientes     = Clientes::getById(trim($var_id_cliente[0]));
       
        if (is_null($clientes)) {
            echo 4;
            exit;
        }
        $articulo  = Articulos::getBy('art_codigo', $cod_separado[0]);
        $articulo2 = Articulos::where('art_nombre', $cod_separado[1]);
        
       
        if (is_null($articulo)) {
            echo 3;
            exit;
        }
        if (is_null($articulo2)) {
            echo 3;
            exit;
        }
        $stock = $articulo->getArt_stock();
        if ($_POST['cantidad'] <= $stock) {
        } else {
            echo 1;
            exit;
        }
        $id               = NULL;
        $ped_cod_ped      = $_POST['codigo_pedido'];
        $ped_tipo_doc     = $_POST['tipo_documento'];
        $ped_usuario      = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $ped_fecha        = fecha_hora_mysql;
        $ped_cli_id       = $clientes->getId();
        $ped_aprobacion = 1;
        $ped_facturado = 0;
        $ped_moneda = $_POST['moneda'];
        $cambio= Cambio::getUltimo('id');
        $ped_tipocambio =$cambio[0]['cam_venta'];
        $data=array(
            'ped_cod_ped'=>$ped_cod_ped,
            'ped_usuario'=>$ped_usuario,
        );
        $pedidos_doc_veri = PedidosDoc::whereV($data, 'and');
        if (empty($pedidos_doc_veri)) {
            $pedidos_doc = new PedidosDoc($id, $ped_cod_ped, $ped_tipo_doc, $ped_usuario, $ped_fecha, $ped_cli_id, $ped_aprobacion, $ped_facturado, $ped_moneda, $ped_tipocambio);
            $pedidos_doc->create();
        }
        // moneda
         if($ped_moneda == 'PEN'){
            $articulo_moneda =Articulos::getBy('art_codigo', $cod_separado[0]);
            if($articulo_moneda->getArt_moneda()== 'PEN'){
                $valor_venta_sin_igv = $_POST['valor_venta_sin_igv'];
                $total = $_POST['total'];
            }
             if($articulo_moneda->getArt_moneda()== 'USD'){
                
                 $cambio = Cambio::getUltimo('id');
                $valor_venta_sin_igv = $_POST['valor_venta_sin_igv'] * $cambio[0]['cam_venta'];
                $total =$_POST['total']* $cambio[0]['cam_venta'];
            }
        }
        if($ped_moneda == 'USD'){
                $articulo_moneda =Articulos::getBy('art_codigo', $cod_separado[0]);
            if($articulo_moneda->getArt_moneda()== 'PEN'){
                $cambio = Cambio::getUltimo('id');
                $valor_venta_sin_igv = $_POST['valor_venta_sin_igv']/$cambio[0]['cam_venta'];
                $total = $_POST['total']/$cambio[0]['cam_venta'];
            }
             if($articulo_moneda->getArt_moneda()== 'USD'){
                
                 
                $valor_venta_sin_igv = $_POST['valor_venta_sin_igv'];
                $total =$_POST['total'];
             }
        }
        // fin moneda
        $ped_id_pedidos_doc      = $ped_cod_ped;
        $ped_id_pro              = $_POST['pro_id'];
        $ped_cod_pro             = $cod_separado[0];
        $ped_nombre_pro          = $_POST['producto'].' ['.$_POST['nombre_paquete'].']';
        $ped_cantidad            = $_POST['cantidad'];
        $ped_valor_venta_sin_igv = $valor_venta_sin_igv;
        $ped_total               = $total;
        $pedidos                 = new Pedidos($id, $ped_id_pedidos_doc, $ped_usuario, $ped_id_pro, $ped_cod_pro, $ped_nombre_pro, $ped_cantidad, $ped_valor_venta_sin_igv, $ped_total);
        print_r($pedidos);
        $pedidos->create();
        /*$resta = $articulo->getArt_stock() - $_POST['cantidad'];
        $articulo->setArt_stock($resta);
        $articulo->update();*/
        if ($articulo->getArt_stock() <= $articulo->getArt_stockminimo()) {
            echo 2;
        }
    }
    public function llamar_codigo_pedido() {
        $data        = array(
            'ped_usuario' => Session::getValue('ID_TRA' . NOMBRE_SESSION)
        );
        $pedidos_doc = PedidosDoc::whereV($data, 'and', 'ped_cod_ped');
        if (empty($pedidos_doc)) {
            echo 1;
        } else {
            foreach ($pedidos_doc as $value) {
                $variable = $value['ped_cod_ped'];
            }
            echo $variable + 1;
        }
    }
    public function tabla_itemspedido() {
        
        $data     = array(
            'ped_id_pedidos_doc' => $_GET['codigo_pedido'],
            'ped_usuario' => Session::getValue('ID_TRA' . NOMBRE_SESSION)
        );
        $datos      = array();
        $subtotal = 0;
        $pedidos = Pedidos::whereV($data, 'and');
        echo ' ';
        foreach ($pedidos as $value) {
            array_push($datos, array(
                'id'=>$value['id'],
                   'ped_cantidad'=>$value['ped_cantidad'],
                    'ped_cod_pro'=>$value['ped_cod_pro'] ,
                    'ped_nombre_pro'=>$value['ped_nombre_pro'] ,
                    'ped_valor_venta_sin_igv'=>number_format($value['ped_valor_venta_sin_igv'] * 1.18,2, '.', ','),
                    'ped_total'=>number_format($value['ped_valor_venta_sin_igv'] * 1.18 * $value['ped_cantidad'], 2, '.', ','),
               ));
            
        }
        echo json_encode($datos);
     
    }
    public function tabla_itemspedido_totales($id='' , $usuario =''){
        $datos=array();
        if(empty($id)||empty($usuario)){
             $data     = array(
            'ped_id_pedidos_doc' => $_POST['codigo_pedido'],
            'ped_usuario' => Session::getValue('ID_TRA' . NOMBRE_SESSION)
        );
        }else{
             $data     = array(
            'ped_id_pedidos_doc' => $id,
            'ped_usuario' => $usuario
        );
        }
       
          
           
        $subtotal = 0;
        $pedidos = Pedidos::whereV($data, 'and');
        
        foreach ($pedidos as $value) {
      $subtotal = $subtotal + $value['ped_valor_venta_sin_igv']*$value['ped_cantidad'] ;

        $igv      = $subtotal * 0.18;
        $total    = $subtotal + $igv;
        }
      
         array_push($datos,array(
             'subtotal'=>number_format($subtotal, 2, '.', ''),
             'igv'=>number_format($igv, 2, '.', ''),
             'total'=>number_format($total, 2, '.', ''),
             
             
         ));
            if(empty($id)||empty($usuario)){
         echo json_encode($datos);
            }else{
                return $datos;
            }
             
    }
      public function eliminar_pedido() {
        $id        = $_POST['id'];
        $pedidos = Pedidos::getById($id);
        $pedidos->delete();
    }
       public function tabla_itemspedido_totales_pedidos($id='' , $usuario =''){
        
        $datos=array();
        if(empty($id)||empty($usuario)){
             $data     = array(
            'ped_id_pedidos_doc' => $_POST['codigo_pedido'],
            'ped_usuario' => Session::getValue('ID_TRA' . NOMBRE_SESSION)
        );
        }else{
            $usuario_busqueda = Usuario::getBy('usu_usuario', $usuario);
             $data     = array(
            'ped_id_pedidos_doc' => $id,
            'ped_usuario' => $usuario_busqueda->getId(),
        );
        }
       
          
           
        $subtotal = 0;
        $pedidos = Pedidos::whereV($data, 'and');
       
        foreach ($pedidos as $value) {
      $subtotal = $subtotal + $value['ped_valor_venta_sin_igv']*$value['ped_cantidad'] ;

        $igv      = $subtotal * 0.18;
        $total    = $subtotal + $igv;
        }
      
         array_push($datos,array(
             'subtotal'=>number_format($subtotal, 2, '.', ''),
             'igv'=>number_format($igv, 2, '.', ','),
             'total'=>number_format($total, 2, '.', ''),
             
             
         ));
          echo json_encode($datos);
        
            
             
    }
    public function eliminar_item(){
        $itempedido = Pedidos::getById($_POST['id']);
        $itempedido->delete();
    }
}
