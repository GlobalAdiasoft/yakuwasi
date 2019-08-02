<?php
class Facturar_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function crear_factura2() {
        $cli_id                 = $_POST['cli_id'];
        $cli_id                 = explode('|', $cli_id);
        $usuario                = Usuario::getById(Session::getValue('ID_TRA' . NOMBRE_SESSION));
        $id                     = NULL;
        $fac_correlativo        = $_POST['serie'];
        $fac_numero_factura     = $_POST['numero_factura'];
        $fac_cli_id             = trim($cli_id[1]);
        $fact_fecha             = fecha_mysql;
        $fact_usuario           = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $fact_moneda            = $_POST['moneda'];
        $fact_tipocambio        = isset($_POST['tipocambio']) ? $_POST['tipocambio'] : '0.00';
        $fact_sunat_transaccion = $_POST['sunat_transaccion'];
        $fact_condiciones_pago  = empty($_POST['condiciones_pago']) ? 'C' : $_POST['condiciones_pago'];
        $fact_medio_pago        = $_POST['medio_pago'];
        $fact_guia_serie        = isset($_POST['guia_serie']) || empty($_POST['guia_serie']) ? '000-000000' : $_POST['guia_serie'];
        $fact_envio_sunat       = 1;
        $fact_pedido_usuario    = $_POST['codigo_pedido'] . '/' . $usuario->getUsu_usuario();
        $fact_pdf               = '';
        $fact_xml               = '';
        $fact_cdr               = '';
        $descripcion            = '';
        $estado                 = '';
        $fact_pdf_a             = URL . 'Pdfventas/pdf_ticket/factura/' . $_POST['serie'] . '/' . $_POST['numero_factura'];
        ;
        $fact_xml_a = '';
        $fact_cdr_a = '';
        Kardex_controller::traer_datos($fact_pedido_usuario, $fac_correlativo, $fac_numero_factura, 'módulo [ factura ]', 'v');
        $facturar = new Facturas($id, $fac_correlativo, $fac_numero_factura, $fac_cli_id, $fact_fecha, $fact_usuario, $fact_moneda, $fact_tipocambio, $fact_sunat_transaccion, $fact_condiciones_pago, $fact_medio_pago, $fact_guia_serie, $fact_envio_sunat, $fact_pedido_usuario, $fact_pdf, $fact_xml, $fact_cdr, $descripcion, $estado, $fact_pdf_a, $fact_xml_a, $fact_cdr_a);
        $facturar->create();
        $factura = Facturas::getBy('fac_numero_factura', $_POST['numero_factura']);
        $factura->setFact_envio_sunat(1);
        $factura->setEstado('F');
        $factura->update();
        $this->enviar_sunat_factura($_POST['numero_factura'], $fact_pedido_usuario, 'B');
        Articulos_controller::restar_art($_POST['codigo_pedido'], $usuario->getId());
         Articulos_controller::facturado($_POST['codigo_pedido'], $usuario->getId());
    }
    public function crear_factura() {
        $id                     = NULL;
        $fac_correlativo        = $_POST['serie'];
        $fac_numero_factura     = $_POST['numero_factura'];
        $fac_cli_id             = $_POST['cli_id'];
        $fact_fecha             = fecha_mysql;
        $fact_usuario           = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $fact_moneda            = $_POST['moneda'];
        $fact_tipocambio        = isset($_POST['tipocambio']) ? $_POST['tipocambio'] : '0.00';
        $fact_sunat_transaccion = $_POST['sunat_transaccion'];
        $fact_condiciones_pago  = empty($_POST['condiciones_pago']) ? 'C' : $_POST['condiciones_pago'];
        $fact_medio_pago        = $_POST['medio_pago'];
        $fact_guia_serie        = isset($_POST['guia_serie']) ? $_POST['guia_serie'] : '000-000000';
        $fact_envio_sunat       = 1;
        $fact_pedido_usuario    = $_POST['pedido_usuario'];
        $fact_pdf               = '';
        $fact_xml               = '';
        $fact_cdr               = '';
        $descripcion            = '';
        $estado                 = '';
        $fact_pdf_a             = URL . 'Pdfventas/pdf_ticket/factura/' . $_POST['serie'] . '/' . $_POST['numero_factura'];
        ;
        $fact_xml_a = '';
        $fact_cdr_a = '';
        Kardex_controller::traer_datos($fact_pedido_usuario, $fac_correlativo, $fac_numero_factura, 'módulo [ pedido factura ]', 'v');
        $facturar = new Facturas($id, $fac_correlativo, $fac_numero_factura, $fac_cli_id, $fact_fecha, $fact_usuario, $fact_moneda, $fact_tipocambio, $fact_sunat_transaccion, $fact_condiciones_pago, $fact_medio_pago, $fact_guia_serie, $fact_envio_sunat, $fact_pedido_usuario, $fact_pdf, $fact_xml, $fact_cdr, $descripcion, $estado, $fact_pdf_a, $fact_xml_a, $fact_cdr_a);
        $facturar->create();
        $factura = Facturas::getBy('fac_numero_factura', $_POST['numero_factura']);
        $factura->setFact_envio_sunat(1);
        $factura->setEstado('F');
        $factura->update();
        $this->enviar_sunat_factura($_POST['numero_factura'], $fact_pedido_usuario, 'M');
         Articulos_controller::restar_art($_POST['codigo_pedido'], Session::getValue('ID_TRA' . NOMBRE_SESSION));
          Articulos_controller::facturado($_POST['codigo_pedido'], Session::getValue('ID_TRA' . NOMBRE_SESSION));
    }
    public function enviar_sunat_factura($numero_factura, $numero_pedido, $condicion) {
        $factura          = Facturas::getBy('fac_numero_factura', $numero_factura);
        $cliente          = Clientes::getBy('cli_ruc', $factura->getFac_cli_id());
        $ubigeo           = Ubigeo::getById($cliente->getCli_ubigeo());
        $fecha_de_emision = new DateTime($factura->getFact_fecha());
        if ($factura->getFact_condiciones_pago() == 'C') {
            $condiciones_pago     = 'Contado';
            $fecha_de_vencimiento = $fecha_de_emision->format('d-m-Y');
        } else {
            $condiciones_pago     = 'Crèdito ' . $factura->getFact_condiciones_pago() . ' días';
            $fecha_de_vencimiento = $this->fecha_vencimiento($factura->getFact_condiciones_pago());
        }
        if ($factura->getFact_moneda() == 'PEN') {
            $moneda      = 1;
            $tipo_cambio = $factura->getFact_tipocambio();
        } else {
            $moneda      = 2;
            $tipo_cambio = $factura->getFact_tipocambio();
        }
        $datos_json = array(
            'operacion' => 'generar_comprobante',
            'tipo_de_comprobante' => 1,
            'serie' => $factura->getFac_correlativo(),
            'numero' => $factura->getFac_numero_factura(),
            'sunat_transaction' => $factura->getFact_sunat_transaccion(),
            'cliente_tipo_de_documento' => 6,
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
            'medio_de_pago' => $factura->getFact_medio_pago(),
            'placa_vehiculo' => '',
            'orden_compra_servicio' => '',
            'tabla_personalizada_codigo' => '',
            'formato_de_pdf' => '',
            'items' => array(),
            'guias' => array()
        );
        if ($factura->getFact_guia_serie() == '000-000000') {
        } else {
            array_push($datos_json['guias'], array(
                'guia_tipo' => 1,
                'guia_serie_numero' => $factura->getFact_guia_serie()
            ));
        }
        $datos_para_items = $factura->getFact_pedido_usuario();
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
            if ($condicion == 'B') {
                $subtotal = $subtotal + $value['ped_total'] * $value['ped_cantidad'];
            } else {
                $subtotal = $subtotal + $value['ped_total'];
            }
            //$subtotal = $subtotal + $value['ped_total'];
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
        $pdfventas                   = new Pdfventas(NULL, $datos_json['serie'], $datos_json['numero'], json_encode($datos_json));
        $pdfventas->create();
        // desde aqui // 
        /* $datos_recibidos             = Nubefact_controller::conexion($datos_json);
        
        if (isset($datos_recibidos['errors'])) {
        echo $datos_recibidos['errors'];
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
        if (isset($datos_recibidos['aceptada_por_sunat'])) {
        switch ($datos_recibidos['aceptada_por_sunat']) {
        case 1:
        $factura->setFact_envio_sunat(1);
        $factura->setFact_pdf($datos_recibidos['enlace_del_pdf']);
        $factura->setFact_xml($datos_recibidos['enlace_del_xml']);
        $factura->setFact_cdr($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        $factura->setEstado('F');
        $factura->update();
        $numero_pedido = explode('/', $numero_pedido);
        $pedidosdoc    = PedidosDoc::getById($numero_pedido[0]);
        $pedidosdoc->setPed_facturado(1);
        $pedidosdoc->update();
        echo 0;
        break;
        }
        }*/
    }
    public function fecha_vencimiento($dias) {
        $fecha = new DateTime();
        $fecha->add(new DateInterval('P' . $dias . 'D'));
        return $fecha->format('d-m-Y');
    }
    public function consultar_factura($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'consultar_comprobante',
            'tipo_de_comprobante' => '1',
            'serie' => $correlativo,
            'numero' => $numero
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Facturas::getBy('fac_numero_factura', $numero);
        $factura->setFact_envio_sunat(1);
        $factura->setFact_pdf($datos_recibidos['enlace_del_pdf']);
        $factura->setFact_xml($datos_recibidos['enlace_del_xml']);
        $factura->setFact_cdr($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        $factura->setEstado('F');
        $factura->update();
    }
    public function consultar_anulacion($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'consultar_anulacion',
            'tipo_de_comprobante' => '1',
            'serie' => $correlativo,
            'numero' => $numero
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Facturas::getBy('fac_numero_factura', $numero);
        $factura->setFact_envio_sunat(1);
        $factura->setFact_pdf_a($datos_recibidos['enlace_del_pdf']);
        $factura->setFact_xml_a($datos_recibidos['enlace_del_xml']);
        $factura->setFact_cdr_a($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        if (empty($datos_recibidos['sunat_description'])) {
            $factura->setEstado('E');
        } else {
            $factura->setEstado('A');
        }
        $factura->update();
    }
    public function anular_factura($correlativo, $numero) {
        $datos_json      = array(
            'operacion' => 'generar_anulacion',
            'tipo_de_comprobante' => '1',
            'serie' => $correlativo,
            'numero' => $numero,
            'motivo' => 'ERROR DEL SISTEMA',
            'codigo_unico' => ''
        );
        $datos_recibidos = Nubefact_controller::conexion($datos_json);
        $factura         = Facturas::getBy('fac_numero_factura', $numero);
        $factura->setFact_envio_sunat(1);
        $factura->setFact_pdf_a($datos_recibidos['enlace_del_pdf']);
        $factura->setFact_xml_a($datos_recibidos['enlace_del_xml']);
        $factura->setFact_cdr_a($datos_recibidos['enlace_del_cdr']);
        $factura->setDescripcion($datos_recibidos['sunat_description']);
        if (empty($datos_recibidos['sunat_description'])) {
            $factura->setEstado('E');
        } else {
            $factura->setEstado('A');
        }
        $factura->update();
    }
    public function actualizar_facturas() {
        $data     = array(
            'estado' => 'F',
            'fact_cdr' => ''
        );
        $facturas = Facturas::whereV($data, 'and');
        foreach ($facturas as $value) {
            $this->consultar_factura($value['fac_correlativo'], $value['fac_numero_factura']);
        }
        $data2     = array(
            'estado' => 'E',
            'fact_cdr_a' => ''
        );
        $facturas2 = Facturas::whereV($data2, 'and');
        foreach ($facturas2 as $value2) {
            $this->consultar_anulacion($value2['fac_correlativo'], $value2['fac_numero_factura']);
        }
    }
 
}
