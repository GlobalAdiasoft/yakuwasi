<?php
class Boletear_controller extends Controller {
    public function crear_boleta2() {
        $cli_id                = $_POST['cli_id'];
        $cli_id                = explode('|', $cli_id);
        $usuario               = Usuario::getById(Session::getValue('ID_TRA' . NOMBRE_SESSION));
        $id                    = null;
        $bol_correlativo       = $_POST['serie'];
        $bol_numero_boleta     = $_POST['numero_factura'];
        $bol_cli_id            = trim($cli_id[1]);
        $bol_fecha             = fecha_mysql;
        $bol_usuario           = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $bol_moneda            = $_POST['moneda'];
        $bol_tipocambio        = isset($_POST['tipocambio']) ? $_POST['tipocambio'] : '0.00';
        $bol_sunat_transaccion = $_POST['sunat_transaccion'];
        $bol_condiciones_pago  = empty($_POST['condiciones_pago']) ? 'C' : $_POST['condiciones_pago'];
        $bol_medio_pago        = $_POST['medio_pago'];
        $bol_envio_sunat       = 1;
        $bol_pedido_usuario    = $_POST['codigo_pedido'] . '/' . $usuario->getUsu_usuario();
        $bol_pdf               = '';
        $bol_xml               = '';
        $bol_cdr               = '';
        $descripcion           = '';
        $estado                = '';
$bol_pdf_a             = URL . 'Pdfventas/pdf_ticket/boleta/' . $_POST['serie'] . '/' . $_POST['numero_factura']; 
$bol_xml_a             = '';
        $bol_cdr_a             = '';
        Kardex_controller::traer_datos($bol_pedido_usuario, $bol_correlativo, $bol_numero_boleta, 'emitido de módulo [ boleta ]', 'v');
        $boletear = new Boletas($id, $bol_correlativo, $bol_numero_boleta, $bol_cli_id, $bol_fecha, $bol_usuario, $bol_moneda, $bol_tipocambio, $bol_sunat_transaccion, $bol_condiciones_pago, $bol_medio_pago, $bol_envio_sunat, $bol_pedido_usuario, $bol_pdf, $bol_xml, $bol_cdr, $descripcion, $estado, $bol_pdf_a, $bol_xml_a, $bol_cdr_a);
        $boletear->create();
        $boletas = boletas::getBy('bol_numero_boleta', $_POST['numero_factura']);
        $boletas->setBol_envio_sunat(1);
        $boletas->setEstado('F');
        $boletas->update();
        $this->enviar_sunat_boleta($_POST['numero_factura'], $bol_pedido_usuario, 'D');
                Articulos_controller::restar_art($_POST['codigo_pedido'], $usuario->getId());
                Articulos_controller::facturado($_POST['codigo_pedido'], $usuario->getId());

    }
    public function crear_boleta() {
        $id                    = null;
        $bol_correlativo       = $_POST['serie'];
        $bol_numero_boleta     = $_POST['numero_boleta'];
        $bol_cli_id            = $_POST['cli_id'];
        $bol_fecha             = fecha_mysql;
        $bol_usuario           = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $bol_moneda            = $_POST['moneda'];
        $bol_tipocambio        = isset($_POST['tipocambio']) ? $_POST['tipocambio'] : '0.00';
        $bol_sunat_transaccion = $_POST['sunat_transaccion'];
        $bol_condiciones_pago  = empty($_POST['condiciones_pago']) ? 'C' : $_POST['condiciones_pago'];
        $bol_medio_pago        = $_POST['medio_pago'];
        $bol_envio_sunat       = 1;
        $bol_pedido_usuario    = $_POST['pedido_usuario'];
        $bol_pdf               = '';
        $bol_xml               = '';
        $bol_cdr               = '';
        $descripcion           = '';
        $estado                = '';
        $bol_pdf_a             = URL . 'Pdfventas/pdf_ticket/boleta/' . $_POST['serie'] . '/' . $_POST['numero_boleta'];
        $bol_xml_a             = '';
        $bol_cdr_a             = '';
        Kardex_controller::traer_datos($bol_pedido_usuario, $bol_correlativo, $bol_numero_boleta, 'emitido de módulo [ pedido boleta ]', 'v');
        $boletear = new Boletas($id, $bol_correlativo, $bol_numero_boleta, $bol_cli_id, $bol_fecha, $bol_usuario, $bol_moneda, $bol_tipocambio, $bol_sunat_transaccion, $bol_condiciones_pago, $bol_medio_pago, $bol_envio_sunat, $bol_pedido_usuario, $bol_pdf, $bol_xml, $bol_cdr, $descripcion, $estado, $bol_pdf_a, $bol_xml_a, $bol_cdr_a);
        $boletear->create();
        $boletas = boletas::getBy('bol_numero_boleta', $_POST['numero_boleta']);
        $boletas->setBol_envio_sunat(1);
        $boletas->setEstado('F');
        $boletas->update();
        $this->enviar_sunat_boleta($_POST['numero_boleta'], $bol_pedido_usuario, 'P');
         Articulos_controller::restar_art($_POST['codigo_pedido'], Session::getValue('ID_TRA' . NOMBRE_SESSION));
         Articulos_controller::facturado($_POST['codigo_pedido'], Session::getValue('ID_TRA' . NOMBRE_SESSION));
    }
    public function enviar_sunat_boleta($numero_factura, $numero_pedido, $condicion) {
        $boletas          = boletas::getBy('bol_numero_boleta', $numero_factura);
        $cliente          = Clientes::getBy('cli_ruc', $boletas->getBol_cli_id());
        $ubigeo           = Ubigeo::getById($cliente->getCli_ubigeo());
        $fecha_de_emision = new DateTime($boletas->getBol_fecha());
        if ($boletas->getBol_condiciones_pago() == 'C') {
            $condiciones_pago     = 'Contado';
            $fecha_de_vencimiento = $fecha_de_emision->format('d-m-Y');
        } else {
            $condiciones_pago     = 'Crèdito ' . $boletas->getBol_condiciones_pago() . ' días';
            $fecha_de_vencimiento = $this->fecha_vencimiento($boletas->getBol_condiciones_pago());
        }
        if ($boletas->getBol_moneda() == 'PEN') {
            $moneda      = 1;
            $tipo_cambio = $boletas->getBol_tipocambio();
        } else {
            $moneda      = 2;
            $tipo_cambio = $boletas->getBol_tipocambio();
        }
        switch (strlen($cliente->getCli_ruc())) {
            case 8:
                $cliente_tipo_de_documento = 1;
                break;
            case 11:
                $cliente_tipo_de_documento = 6;
                break;
            default:
                break;
        }
        $datos_json       = array(
            'operacion' => 'generar_comprobante',
            'tipo_de_comprobante' => 2,
            'serie' => $boletas->getBol_correlativo(),
            'numero' => $boletas->getBol_numero_boleta(),
            'sunat_transaction' => $boletas->getBol_sunat_transaccion(),
            'cliente_tipo_de_documento' => $cliente_tipo_de_documento,
            'cliente_numero_de_documento' => $cliente->getCli_ruc(),
            'cliente_denominacion' => $cliente->getCli_nombre(),
            'cliente_direccion' => $cliente->getCli_direccion() . ' ' . $ubigeo->getUbi_departamento() . '-' . $ubigeo->getUbi_provincia() . '-' . $ubigeo->getUbi_distrito(),
            'cliente_email' => $cliente->getCli_email(),
            'cliente_email_1' => '',
            'cliente_email_2' => '',
            'fecha_de_emision' => $fecha_de_emision->format('d-m-Y'),
            'fecha_de_vencimiento' => $fecha_de_vencimiento,
            'moneda' => $moneda,
            'tipo_de_cambio' => $tipo_cambio,
            'porcentaje_de_igv' => 18.00,
            'descuento_global' => '',
            'total_descuento' => '',
            'total_anticipo' => '',
            'total_gravada' => '', //SUBTOTAL
            'total_inafecta' => '',
            'total_exonerada' => '',
            'total_igv' => '', //IGV
            'total_gratuita' => '',
            'total_otros_cargos' => '',
            'total' => '', //TOTAL
            'percepcion_tipo' => '',
            'percepcion_base_imponible' => '',
            'total_percepcion' => '',
            'total_incluido_percepcion' => '',
            'detraccion' => false,
            'observaciones' => '',
            'documento_que_se_modifica_tipo' => '',
            'documento_que_se_modifica_serie' => '',
            'documento_que_se_modifica_numero' => '',
            'tipo_de_nota_de_credito' => '',
            'tipo_de_nota_de_debito' => '',
            'enviar_automaticamente_a_la_sunat' => true,
            'enviar_automaticamente_al_cliente' => true,
            'codigo_unico' => '',
            'condiciones_de_pago' => strtoupper($condiciones_pago),
            'medio_de_pago' => $boletas->getBol_medio_pago(),
            'placa_vehiculo' => '',
            'orden_compra_servicio' => '',
            'tabla_personalizada_codigo' => '',
            'formato_de_pdf' => '',
            'items' => array()
        );
        $datos_para_items = $boletas->getBol_pedido_usuario();
        $datos_para_items = explode("/", $datos_para_items);
        $usuario          = Usuario::getBy('usu_usuario', $datos_para_items[1]);
        $data             = array(
            'ped_id_pedidos_doc' => $datos_para_items[0],
            'ped_usuario' => $usuario->getId()
        );
        $datos_item       = Pedidos::whereV($data, 'and');
        $subtotal         = 0;
        foreach ($datos_item as $value) {
            $articulos = Articulos::getById($value['ped_id_pro']);
            if ($condicion == 'P') {
                $subtotal = $subtotal + ($value['ped_total']);
            } else {
                $subtotal = $subtotal + ($value['ped_total'] * $value['ped_cantidad']);
            }
            $igv   = $subtotal * 0.18;
            $total = $subtotal + $igv;
            array_push($datos_json['items'], array(
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
                "anticipo_documento_numero" => ""
            ));
        }
        $datos_json['total_gravada'] = $subtotal;
        $datos_json['total_igv']     = $igv;
        $datos_json['total']         = $total;
        $pdfventas = new Pdfventas(NULL, $datos_json['serie'], $datos_json['numero'], json_encode($datos_json));
        $pdfventas->create();
        if ($condicion == 'P') {
            Caja2_controller::crear('Ventas - [ Boleta - Pedido ]', $datos_json['serie'] . ' - ' . $datos_json['numero'], $boletas->getBol_medio_pago(), $datos_json['total'], 0);
        } else {
            Caja2_controller::crear('Ventas - [ Boleta ]', $datos_json['serie'] . ' - ' . $datos_json['numero'], $boletas->getBol_medio_pago(), $datos_json['total'], 0);
        }
        $pleventas_fecha_emision=$fecha_de_emision->format('Y-m-d');
        Pleventas_controller::crear($pleventas_fecha_emision,$pleventas_fecha_emision,3,$boletas->getBol_correlativo(),$boletas->getBol_numero_boleta());
        // desde aqui // 
        /* $datos_recibidos = Nubefact_controller::conexion($datos_json);
        
        if(isset($datos_recibidos['errors'])){
        
        switch ($datos_recibidos['codigo']) {
        case 10:
        
        break;
        case 11:
        
        break;
        case 12:
        
        break;            
        case 20:
        
        break;
        case 21:
        echo $datos_recibidos['errors'];
        break;
        case 22:
        
        break;
        case 23:
        
        break;
        case 24:
        
        break;            
        case 40:
        
        break;
        case 50:
        
        break;   
        case 51:
        
        break;             
        }
        }
        
        if(isset($datos_recibidos['aceptada_por_sunat'])){
        
        switch ($datos_recibidos['aceptada_por_sunat']) {
        
        case 1:
        
        $boletas->setBol_envio_sunat(1);
        $boletas->setBol_pdf($datos_recibidos['enlace_del_pdf']);
        $boletas->setBol_xml($datos_recibidos['enlace_del_xml']);
        $boletas->setBol_cdr($datos_recibidos['enlace_del_cdr']);
        $boletas->setDescripcion($datos_recibidos['sunat_description']);
        $boletas->setEstado('F');
        $boletas->update();
        
        $numero_pedido = explode('/', $numero_pedido);
        $pedidosdoc= PedidosDoc::getById($numero_pedido[0]);
        $pedidosdoc->setPed_facturado(1);
        $pedidosdoc->update();
        echo 0;
        break;
        default :
        $boletas->setBol_envio_sunat(1);
        $boletas->setBol_pdf($datos_recibidos['enlace_del_pdf']);
        $boletas->setBol_xml($datos_recibidos['enlace_del_xml']);
        $boletas->setBol_cdr($datos_recibidos['enlace_del_cdr']);
        $boletas->setDescripcion($datos_recibidos['sunat_description']);
        $boletas->setEstado('F');
        $boletas->update();
        
        $numero_pedido = explode('/', $numero_pedido);
        $pedidosdoc= PedidosDoc::getById($numero_pedido[0]);
        $pedidosdoc->setPed_facturado(1);
        $pedidosdoc->update();
        break;
        
        }
        
        }
        // hasta aqui // */
    }
    public function fecha_vencimiento($dias) {
        $fecha = new DateTime();
        $fecha->add(new DateInterval('P' . $dias . 'D'));
        return $fecha->format('d-m-Y');
    }
    public function consultar_boleta($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'consultar_comprobante',
            'tipo_de_comprobante' => '2',
            'serie' => $correlativo,
            'numero' => $numero
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Boletas::getBy('bol_numero_boleta', $numero);
        $factura->setBol_envio_sunat(1);
        $factura->setBol_pdf($datos_recibidos['enlace_del_pdf']);
        $factura->setBol_xml($datos_recibidos['enlace_del_xml']);
        $factura->setBol_cdr($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        $factura->setEstado('F');
        $factura->update();
    }
    public function consultar_anulacion($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'consultar_anulacion',
            'tipo_de_comprobante' => '2',
            'serie' => $correlativo,
            'numero' => $numero
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Boletas::getBy('bol_numero_boleta', $numero);
        $factura->setBol_envio_sunat(1);
        $factura->setBol_pdf_a($datos_recibidos['enlace_del_pdf']);
        $factura->setBol_xml_a($datos_recibidos['enlace_del_xml']);
        $factura->setBol_cdr_a($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        if (empty($datos_recibidos['sunat_description'])) {
            $factura->setEstado('E');
        } else {
            $factura->setEstado('A');
        }
        $factura->update();
    }
    public function anular_boleta($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'generar_anulacion',
            'tipo_de_comprobante' => '2',
            'serie' => $correlativo,
            'numero' => $numero,
            'motivo' => 'ERROR DEL SISTEMA',
            'codigo_unico' => ''
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Boletas::getBy('bol_numero_boleta', $numero);
        $factura->setBol_envio_sunat(1);
        $factura->setBol_pdf_a($datos_recibidos['enlace_del_pdf']);
        $factura->setBol_xml_a($datos_recibidos['enlace_del_xml']);
        $factura->setBol_cdr_a($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        if (empty($datos_recibidos['sunat_description'])) {
            $factura->setEstado('E');
        } else {
            $factura->setEstado('A');
        }
        $factura->update();
    }
    public function actualizar_boletas() {
        $data     = array(
            'estado' => 'F',
            'bol_cdr' => ''
        );
        $facturas = Boletas::whereV($data, 'and');
        foreach ($facturas as $value) {
            $this->consultar_factura($value['fac_correlativo'], $value['fac_numero_factura']);
        }
        $data2     = array(
            'estado' => 'E',
            'bol_cdr_a' => ''
        );
        $facturas2 = Boletas::whereV($data2, 'and');
        foreach ($facturas2 as $value2) {
            $this->consultar_anulacion($value2['bol_correlativo'], $value2['bol_numero_boleta']);
        }
    }
}