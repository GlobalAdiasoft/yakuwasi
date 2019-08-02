<?php
class Notadebito_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function traer_datos_item() {
        if (isset($_GET['documento'])) {
            $documento = $_GET['documento'];
        } else {
            $documento = '';
        }
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
        } else {
            $numero = '';
        }
        if ($documento == 1) {
            $factura = Facturas::where('fac_numero_factura', $numero);
            if (empty($factura)) {
                $pedidos = array();
                echo json_encode($pedidos, JSON_PRETTY_PRINT);
            } else {
                $nropedido = $factura[0]['fact_pedido_usuario'];
                $nropedido = explode('/', $nropedido);
                $usuarios  = Usuario::getBy('usu_usuario', $nropedido[1]);
                $data      = array(
                    'ped_id_pedidos_doc' => $nropedido[0],
                    'ped_usuario' => $usuarios->getId()
                );
                $datos     = array();
                $pedidos   = Pedidos::whereV($data, 'and');
                foreach ($pedidos as $value) {
                    array_push($datos, array(
                        'id' => $value['id'],
                        'ped_cantidad' => $value['ped_cantidad'],
                        'ped_cod_pro' => $value['ped_cod_pro'],
                        'ped_nombre_pro' => $value['ped_nombre_pro'],
                        'ped_valor_venta_sin_igv' => number_format($value['ped_valor_venta_sin_igv'] * 1.18, 2, '.', ','),
                        'ped_total' => number_format($value['ped_valor_venta_sin_igv'] * 1.18 * $value['ped_cantidad'], 2, '.', ',')
                    ));
                }
                echo json_encode($datos, JSON_PRETTY_PRINT);
            }
        } else {
            $boleta = Boletas::where('bol_numero_boleta', $numero);
            if (empty($boleta)) {
                $pedidos = array();
                echo json_encode($pedidos, JSON_PRETTY_PRINT);
            } else {
                $nropedido = $boleta[0]['bol_pedido_usuario'];
                $nropedido = explode('/', $nropedido);
                $usuarios  = Usuario::getBy('usu_usuario', $nropedido[1]);
                $data      = array(
                    'ped_id_pedidos_doc' => $nropedido[0],
                    'ped_usuario' => $usuarios->getId()
                );
                $datos     = array();
                $pedidos   = Pedidos::whereV($data, 'and');
                foreach ($pedidos as $value) {
                    array_push($datos, array(
                        'id' => $value['id'],
                        'ped_cantidad' => $value['ped_cantidad'],
                        'ped_cod_pro' => $value['ped_cod_pro'],
                        'ped_nombre_pro' => $value['ped_nombre_pro'],
                        'ped_valor_venta_sin_igv' => number_format($value['ped_valor_venta_sin_igv'] * 1.18, 2, '.', ','),
                        'ped_total' => number_format($value['ped_valor_venta_sin_igv'] * 1.18 * $value['ped_cantidad'], 2, '.', ',')
                    ));
                }
                echo json_encode($datos, JSON_PRETTY_PRINT);
            }
        }
    }
    public function traer_datos_factura(){
           if (isset($_POST['documento'])) {
            $documento = $_POST['documento'];
        } else {
            $documento = '';
        }
        if (isset($_POST['numero'])) {
            $numero = $_POST['numero'];
        } else {
            $numero = '';
        }
         if ($documento == 1) {
             $factura = Facturas::where('fac_numero_factura', $numero);
             echo json_encode($factura, JSON_PRETTY_PRINT);
         }else{
              $boleta = Boletas::where('bol_numero_boleta', $numero);
             echo json_encode($boleta, JSON_PRETTY_PRINT);
         }
    }
    public function agregar(){
      
                $id=NULL;
                $nota_fecha=$_POST['fecha'];
                $nota_correlativo=$_POST['correlativo'];
                $nota_numero=$_POST['numero'];
                $nota_moneda=$_POST['moneda'];
                $nota_tipocambio=$_POST['tipocambio'];
                $nota_sunat_transaccion=$_POST['sunat_transaccion'];
                $nota_fecha_vencimiento=$_POST['fecha_venc'];
                $nota_cli_id=$_POST['cli_id'];
                $nota_documento_modificar=$_POST['documento_modi'];
                $nota_numero_modificar=$_POST['numero_modi'];
                $nota_tipo=$_POST['nota_tipo'];
                $nota_correlativo_numero=$_POST['correlativo'].'/'.$_POST['numero'];
                 $nota_envio_sunat         = 0;
        $nota_pdf                 = 'PDF';
        $nota_xml                 = 'XML';
        $nota_cdr                 = 'CDR';
                 $data_pedidos = array(
            'ped_correlativo' => $nota_correlativo,
            'ped_numero' => $nota_numero
        );
        $nota_pedidos = Pedidosnotadebito::whereV($data_pedidos, 'and');
        if(empty($nota_pedidos)){
            echo 3;
            exit;
        }
        $nota = new Notadebito($id, $nota_fecha, $nota_correlativo, $nota_numero, $nota_moneda, $nota_tipocambio, $nota_sunat_transaccion, $nota_fecha_vencimiento, $nota_cli_id, $nota_documento_modificar, $nota_numero_modificar, $nota_tipo, $nota_correlativo_numero, $nota_envio_sunat, $nota_pdf, $nota_xml, $nota_cdr);
        $nota->create();
             
        
       
     $datos_recibidos = Nubefact_controller::conexion($this->datos_json($nota_correlativo, $nota_numero));    
     if (isset($datos_recibidos['aceptada_por_sunat'])){
           if(empty($datos_recibidos['enlace_del_cdr'])){
               $data = array(
                   'nota_correlativo'=>$_POST['correlativo'],
                   'nota_numero'=>$_POST['numero'],
               );
               $nota_credito = Notadebito::getByData($data, 'and');
               $nota_credito->setNota_pdf($datos_recibidos['enlace_del_pdf']);
               $nota_credito->setNota_xml($datos_recibidos['enlace_del_xml']);
               $nota_credito->setNota_envio_sunat(1);
               $nota_credito->update();
               echo 1;
           }else{
               echo 'lleno';
               $data = array(
                   'nota_correlativo'=>$_POST['correlativo'],
                   'nota_numero'=>$_POST['numero'],
               );
               $nota_credito = Notadebito::getByData($data, 'and');
               $nota_credito->setNota_pdf($datos_recibidos['enlace_del_pdf']);
               $nota_credito->setNota_xml($datos_recibidos['enlace_del_xml']);
               $nota_credito->setNota_cdr($datos_recibidos['enlace_del_cdr']);
               $nota_credito->setNota_envio_sunat(1);
               $nota_credito->update();
               echo 1;
           }            
    }else{
        echo 0;
    }
    }
        public function llamar_cod() {
        $data        = array(
            'nota_correlativo'=>$_POST['documento'],
           
        );
        $pedidos_doc = Notadebito::whereV($data, 'and', 'nota_numero');
        if (empty($pedidos_doc)) {
            echo 1;
        } else {
            foreach ($pedidos_doc as $value) {
                $variable = $value['nota_numero'];
            }
            echo $variable + 1;
        }
         
}
public function traer_datos_item_nota() { 

     $data      = array(
                    'ped_correlativo' => $_GET['correlativo'],
                    'ped_numero' => $_GET['numero']
                );
                $datos     = array();
                $pedidos   = Pedidosnotadebito::whereV($data, 'and');
                foreach ($pedidos as $value) {
                    array_push($datos, array(
                        'id' => $value['id'],
                        'ped_cantidad' => $value['ped_cantidad'],
                        'ped_cod_pro' => $value['ped_cod_pro'],
                        'ped_nombre_pro' => $value['ped_nombre_pro'],
                        'ped_valor_venta_sin_igv' => number_format($value['ped_valor_venta_sin_igv'] * 1.18, 2, '.', ','),
                        'ped_total' => number_format($value['ped_valor_venta_sin_igv'] * 1.18 * $value['ped_cantidad'], 2, '.', ',')
                    ));
                }
                echo json_encode($datos, JSON_PRETTY_PRINT);
}
public function guardar_items(){
   
    $data = json_decode($_POST['jObject'], true);
     $articulos = Articulos::getBy('art_codigo', $data['ped_cod_pro']);
             
     $id=null;
     $ped_correlativo=$_POST['correlativo'];
     $ped_numero=$_POST['numero'];
     $ped_id_pro=0;
     $ped_cod_pro=$data['ped_cod_pro'];
     $ped_nombre_pro=$data['ped_nombre_pro'];
     $ped_cantidad=$data['ped_cantidad'];
     $ped_valor_venta_sin_igv=$articulos->getArt_precio_ventasinigv();
     $ped_total= $articulos->getArt_precio_ventasinigv()* $data['ped_cantidad']  ;
     $nota_credito_pedido = new Pedidosnotadebito($id, $ped_correlativo, $ped_numero, $ped_id_pro, $ped_cod_pro, $ped_nombre_pro, $ped_cantidad, $ped_valor_venta_sin_igv, $ped_total);
     $nota_credito_pedido->create();
     
     
}
public function datos_json($correlativo = '',$numero =''){
    $data_doc=array(
        'nota_correlativo'=>$correlativo,
        'nota_numero'=>$numero,
    );
    $data_pedidos=array(
        'ped_correlativo'=>$correlativo,
        'ped_numero'=>$numero,
    );
    $nota_doc = Notadebito::whereV($data_doc, 'and');
  
    $nota_pedidos= Pedidosnotadebito::whereV($data_pedidos, 'and');
    $cliente= Clientes::getBy('cli_ruc', $nota_doc[0]['nota_cli_id']);
   
    if(strlen($nota_doc[0]['nota_cli_id'])==8){
       $cliente_tipo_de_documento=1; 
    }else{
        $cliente_tipo_de_documento=6;
    }
    
    $ubigeo           = Ubigeo::getById($cliente->getCli_ubigeo());
    if($nota_doc[0]['nota_moneda']=='PEN'){
        $moneda = 1;
    }else{
         $moneda = 2;
    }
    if($nota_doc[0]['nota_tipocambio']=='0.00'){
        $cambio = '';
    }else{
        $cambio = $nota_doc[0]['nota_tipocambio'];
    }
    if($nota_doc[0]['nota_documento_modificar'] == 1){
        $documento_que_se_modifica_serie='FFF1';
    }else{
        $documento_que_se_modifica_serie='BBB1';
    }

    $datos_json =array (
  'operacion' => 'generar_comprobante',
  'tipo_de_comprobante' => 4,
  'serie' => $nota_doc[0]['nota_correlativo'],
  'numero' => $nota_doc[0]['nota_numero'],
  'sunat_transaction' => 1,
  'cliente_tipo_de_documento' => $cliente_tipo_de_documento,
  'cliente_numero_de_documento' => $cliente->getCli_ruc(),
  'cliente_denominacion' => $cliente->getCli_nombre(),
  'cliente_direccion' => $cliente->getCli_direccion(). ' ' . $ubigeo->getUbi_departamento() . '-' . $ubigeo->getUbi_provincia() . '-' . $ubigeo->getUbi_distrito(),
  'cliente_email' => $cliente->getCli_email(),
  'cliente_email_1' => '',
  'cliente_email_2' => '',
  'fecha_de_emision' => fecha_mysql,
  'fecha_de_vencimiento' => $nota_doc[0]['nota_fecha_vencimiento'],
  'moneda' => $moneda,
  'tipo_de_cambio' => $cambio,
  'porcentaje_de_igv' => 18.00,
  'descuento_global' => '',
  'total_descuento' => '',
  'total_anticipo' => '',
  'total_gravada' => '',
  'total_inafecta' => '',
  'total_exonerada' => '',
  'total_igv' => '',
  'total_gratuita' => '',
  'total_otros_cargos' => '',
  'total' => '',
  'percepcion_tipo' => '',
  'percepcion_base_imponible' => '',
  'total_percepcion' => '',
  'total_incluido_percepcion' => '',
  'detraccion' => 'false',
  'observaciones' => '',
  'documento_que_se_modifica_tipo' => $nota_doc[0]['nota_documento_modificar'],
  'documento_que_se_modifica_serie' => $documento_que_se_modifica_serie,
  'documento_que_se_modifica_numero' => $nota_doc[0]['nota_numero_modificar'],
  'tipo_de_nota_de_credito' => '',
  'tipo_de_nota_de_debito' => $nota_doc[0]['nota_tipo'],
  'enviar_automaticamente_a_la_sunat' =>true,
  'enviar_automaticamente_al_cliente' => true,
  'codigo_unico' => '',
  'condiciones_de_pago' => '',
  'medio_de_pago' => '',
  'placa_vehiculo' => '',
  'orden_compra_servicio' => '',
  'tabla_personalizada_codigo' => '',
  'formato_de_pdf' => '',
  'items' =>array (),
);
   
           
        
         $subtotal = 0;
         
        foreach ($nota_pedidos as $value) {
            //$articulos = Articulos::getById($value['ped_id_pro']);
             $subtotal = $subtotal + $value['ped_total'];
             $igv      = $subtotal * 0.18;
             $total    = $subtotal + $igv;
              array_push($datos_json['items'],array(
                "unidad_de_medida" => "NIU",
                "codigo" => $value['ped_cod_pro'],
                "descripcion" => $value['ped_nombre_pro'],
                "cantidad" => $value['ped_cantidad'],
                "valor_unitario" => $value['ped_valor_venta_sin_igv'],
                "precio_unitario" => $value['ped_valor_venta_sin_igv'] * 1.18,
                "descuento" => "",
                "subtotal" => $value['ped_valor_venta_sin_igv'] * $value['ped_cantidad'],
                "tipo_de_igv" => "1",
                "igv" => $value['ped_valor_venta_sin_igv'] * $value['ped_cantidad'] * 0.18,
                "total" => ($value['ped_valor_venta_sin_igv'] * $value['ped_cantidad'] * 0.18) + $value['ped_valor_venta_sin_igv'] * $value['ped_cantidad'],
                "anticipo_regularizacion" => "false",
                "anticipo_documento_serie" => "",
                "anticipo_documento_numero" => "",
            ));
          
        }
        $datos_json['total_gravada'] = $subtotal; 
        $datos_json['total_igv'] = $igv; 
        $datos_json['total'] = $total; 
        return $datos_json;
}
 public function eliminar() {
        $id        = $_POST['id'];
        $notacredito = Pedidosnotadebito::getById($id);
        $notacredito->delete();
    }
 public function guardar_items_directo($text) {
       
     
      $text = explode('|', $text);
       $idcod = $text[0];
      $idcod = explode('-', $idcod);
        $articulos               = Articulos::getBy('art_codigo',$idcod[0] );
        $id                      = null;
        $ped_correlativo         = $text[1];
        $ped_numero              = $text[2];
        $ped_id_pro              = 0;
        $ped_cod_pro             = $text[0];
        $ped_nombre_pro          = $text[3];
        $ped_cantidad            = $text[4];
        $ped_valor_venta_sin_igv = $articulos->getArt_precio_ventasinigv();
        $ped_total               = $articulos->getArt_precio_ventasinigv() * $text[4];

        $nota_credito_pedido     = new Pedidosnotadebito($id, $ped_correlativo, $ped_numero, $ped_id_pro, $ped_cod_pro, $ped_nombre_pro, $ped_cantidad, $ped_valor_venta_sin_igv, $ped_total);
        $nota_credito_pedido->create();
        echo 'agregado';
    }
}