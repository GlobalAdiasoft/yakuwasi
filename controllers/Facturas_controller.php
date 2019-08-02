<?php
class Facturas_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    function verificarnumerofactura() {
       
        /*$facturas = Facturas::getAllDistAll('fac_numero_factura');*/
       $data=array(
           'fac_correlativo'=>$_POST['correlativo'],
       );
        $facturas = Facturas::whereV($data, 'and', 'fac_numero_factura');
        if (empty($facturas)) {
            echo 1;
        } else {
            foreach ($facturas as $value) {
                $variable = $value['fac_numero_factura'];
            }
            echo $variable + 1;
        }
    }
    public function agregar_facturas() {
        
            
        $cod_separado = explode("-", $_POST['codproducto']);
        
        $articulo= Articulos::getBy('art_codigo', $cod_separado[0]);
        $stock=$articulo->getArt_stock();
        if($_POST['cantidad']<=$stock){
            
        }else{
            echo 1;
            exit;
        }
        $resta= $articulo->getArt_stock() - $_POST['cantidad'];
        $articulo->setArt_stock($resta);
        $articulo->update();
        
        $id                     = null;
        $fac_correlativo        = $_POST['correlativo'];
        $fac_numero_factura     = $_POST['numero_factura'];
        $fac_cli_id             = $_POST['cli_id'];
        $fact_cantidad          = $_POST['cantidad'];
        $fact_codproducto       = mb_strtoupper($cod_separado[0]);
        $fact_producto          = mb_strtoupper($_POST['producto']);
        $fact_preciounitario    = $_POST['preciounitario'];
        $fact_total             = $_POST['total'];
        $fact_fecha             = $_POST['fecha'];
        $fact_usuario           = Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $fact_moneda            = $_POST['moneda'];
        $fact_tipocambio        = (empty($_POST['tipocambio']))?"0.00":$_POST['tipocambio'];
        $fact_sunat_transaccion = $_POST['sunat_transaccion'];
        $fact_medio_pago        = $_POST['medio_pago'];
        $fact_fecha_guia        ='0000-00-00';
        $fact_envio_sunat= '0';
        if ($fact_sunat_transaccion == 1) {
            $fact_fecha_vencimiento = 0;
            $fact_condiciones_pago  = "";
            $fact_guia_tipo         = "";
            $fact_guia_serie        = "";
        }
        if ($fact_sunat_transaccion == 10) {
            $fact_condiciones_pago = $_POST['condiciones_pago'];
            if ($fact_condiciones_pago == "CONTADO") {
                $fact_fecha_vencimiento = 0;
            }
            if ($fact_condiciones_pago == "CRÉDITO 30 DÍAS") {
                $fact_fecha_vencimiento = 30;
            }
            if ($fact_condiciones_pago == "CRÉDITO 60 DÍAS") {
                $fact_fecha_vencimiento = 60;
            }
            $fact_guia_tipo  = 1;
            $fact_guia_serie = $_POST['guia_serie'];
        }
        $factura = new Facturas($id, $fac_correlativo, $fac_numero_factura, $fac_cli_id, $fact_cantidad, $fact_codproducto, $fact_producto, $fact_preciounitario, $fact_total, $fact_fecha, $fact_usuario, $fact_moneda, $fact_tipocambio, $fact_sunat_transaccion, $fact_fecha_vencimiento, $fact_condiciones_pago, $fact_medio_pago, $fact_guia_tipo, $fact_guia_serie, $fact_fecha_guia, $fact_envio_sunat);
        $factura->create();
        if($articulo->getArt_stockminimo()<= $articulo->getArt_stockminimo()){
            echo 2;
        }
      
       
    }
    public function tabla_itemsfactura() {
        $data     = array(
            'fac_correlativo' => $_POST['correlativo'],
            'fac_numero_factura' => $_POST['numero_factura']
        );
        $subtotal = 0;
        $facturas = Facturas::whereV($data, 'and');
        echo ' <thead>
              <tr class="table-azul">
                 <td><strong>Cantidad</strong></td>
                 <td><strong>Código Producto</strong></td>
                 <td><strong>Producto</strong></td>
                 <td><strong>Precio Unitario</strong></td>
                 <td><strong>Total</strong></td>
                 <td><strong>Eliminar</strong></td>
              </tr>
           </thead>';
        foreach ($facturas as $value) {
            echo ' <tr class="table-white"> 
                  <td>' . $value['fact_cantidad'] . '</td>
                      <td>' . $value['fact_codproducto'] . '</td>
                  <td>' . ucfirst($value['fact_producto']) . '</td>
                      <td>' . number_format((float) $value['fact_preciounitario'] * 1.18, 2, '.', ',') . '</td>
                  <td>' . number_format((float) $value['fact_total'] * 1.18, 2, '.', ',') . '</td>
                 <td><button type="button" class="btn btn-danger btn-sm eliminaritem" value="'.$value['id'].'"><i class="far fa-trash-alt" ></i></button></td>
               </tr>';
            $subtotal = $subtotal + $value['fact_total'];
            $igv      = $subtotal * 0.18;
            $total    = $subtotal + $igv;
        }
        $subtotal = number_format((float) $subtotal, 2, '.', ',');
        $igv      = number_format((float) $igv, 2, '.', ',');
        $total    = number_format((float) $total, 2, '.', ',');
        echo '  <tr class="table-white">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="2"><strong>SUB TOTAL</strong> : <strong>' . $subtotal . '</strong></td>
                   <td></td>   
                            
                </tr>';
        echo '  <tr class="table-white">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="2"><strong>IGV</strong> : <strong>' . $igv . '</strong></td>
                      <td></td>      
                </tr>';
        echo '  <tr class="table-white">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="2"><strong>TOTAL</strong> : <strong>' . $total . '</strong></td>
                     <td></td>        
                </tr>';
        /* $letras = NumeroALetras::convertir($total, 'nuevos soles', 'centimos');
        echo '  <tr class="table-white">
        <td colspan="5">' . $letras . '</td>
        
        </tr>';*/
    }
    function imprimirfactura() {
        $data     = array(
            'fac_correlativo' => $_GET['fac_correlativo'],
            'fac_numero_factura' => $_GET['fac_numero_factura']
        );
        $factura  = Facturas::whereV($data, 'and');
        $subtotal = 0;
        foreach ($factura as $value) {
            $ruc_cliente        = $value['fac_cli_id'];
            $fac_correlativo    = $value['fac_correlativo'];
            $fac_numero_factura = $value['fac_numero_factura'];
            $fact_fecha         = $value['fact_fecha'];
            $fact_moneda        = $value['fact_moneda'];
            $subtotal           = $subtotal + $value['fact_total'];
            $igv                = $subtotal * 0.18;
            $total              = $subtotal + $igv;
        }
        if ($fact_moneda == 1) {
            $simbolodemoneda = "S/.";
        } else {
            $simbolodemoneda = "US$";
        }
         $total2           = number_format(floatval($total), 2, '.', '');
        $subtotal         = number_format(floatval($subtotal), 2, '.', ',');
        $igv              = number_format(floatval($igv), 2, '.', ',');
        
        $cliente          = Clientes::getBy('cli_ruc', $ruc_cliente);
        $cli_ubigeo       = $cliente->getCli_ubigeo();
        $ubigeo           = Ubigeo::getById($cli_ubigeo);
        $ubi_departamento = $ubigeo->getUbi_departamento();
        $ubi_provincia    = $ubigeo->getUbi_provincia();
        $ubi_distrito     = $ubigeo->getUbi_distrito();
        $cli_nombre       = strtoupper($cliente->getCli_nombre());
        $cli_direccion    = utf8_decode(strtoupper($cliente->getCli_direccion()));
        $ubigeo_completo = strtoupper(utf8_decode($ubi_departamento . ' - ' . $ubi_provincia . ' - ' . $ubi_distrito));
        $cli_ruc          = strtoupper($cliente->getCli_ruc());
        $misDatos         = $factura;
        if ($fact_moneda == 1) {
            $letras = utf8_decode(NumeroALetras::convertir($total, 'nuevos soles', ''));
           
        } else {
           $letras = utf8_decode(NumeroALetras::convertir($total, 'dÓlares americanos', ''));
             
            
        }
        $date         = date_create($fact_fecha);
    
        $fecha_emision    = date_format($date, 'd/m/Y');
 
        require(URLFW . 'fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        //$pdf->Image(URLIMG . 'img001.jpg', 0, 0, 210);
        
        $pdf->Image(URLIMG.NOMBRE_LOGO,10,10,55);
        $pdf->SetFont('Arial', 'B', 9);
      
       
        $pdf->Text(10, 25, 'JP INVERSIONES COMPANY S.R.L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Text(10, 29, 'CAL.COMANDANTE CANGA NRO. 1104');
        $pdf->Text(10, 33, 'AREQUIPA - AREQUIPA - MARIANO MELGAR');
        $pdf->SetDrawColor(160,160,160);
        
       
       
       $pdf->Rect(136, 10, 60,30);
       $pdf->SetFont('Arial', 'B', 13);
       $pdf->Text(147, 20, 'RUC 20600436679');
       $pdf->Text(155, 25, utf8_decode('FACTURA '));
       $pdf->Text(149, 30, utf8_decode('ELECTRÓNICA'));
       $pdf->Text(156, 35, $_GET['fac_correlativo']. ' - '.$_GET['fac_numero_factura']);
        
        $pdf->Rect(10, 43, 125, 25);
        $pdf->SetFont('Arial', 'B', 9);        
        $pdf->Text(12, 47, 'ADQUIRIENTE'); 
        $pdf->SetFont('Arial', '', 9);
        $pdf->Text(12, 51, 'RUC: '.$cli_ruc);
        $pdf->Text(12, 55, $cli_nombre);
        $pdf->Text(12, 59, $cli_direccion);
        $pdf->Text(12, 63, $ubigeo_completo);
         
        $pdf->Rect(136, 43, 60, 25); 
        $pdf->SetFont('Arial', 'B', 9);          
        $pdf->Text(138, 47, utf8_decode('FECHA EMISIÓN:'));
        $pdf->Text(138, 51, utf8_decode('FECHA DE VENC:'));
        $pdf->Text(138, 55, utf8_decode('MONEDA:'));
        $pdf->Text(138, 59, 'IGV:');
        $pdf->SetFont('Arial', '', 9);
               
     
        $pdf->Text(166, 47, $fecha_emision);
        $pdf->Text(166, 51, $fecha_emision);
        $pdf->Text(155, 55, 'SOLES');
        $pdf->Text(146, 59, '18.00%');
        
        $pdf->tablaHorizontal($misDatos);
        $pdf->Ln();
        $pdf->Cell(150,5, 'MPORTE EN LETRAS:'.$letras,1, 0 , 'C' );
        $pdf->Ln();
         $pdf->Ln();
          $pdf->SetFont('Arial', 'B', 9);
         $pdf->SetX(132);
         $pdf->Cell(21,5,'GRAVADA',1, 0 , 'R' );
        $pdf->Cell(20,5,$simbolodemoneda,1, 0 , 'C' );
        $pdf->Cell(23,5, $subtotal,1, 0 , 'R' );
        $pdf->Ln(); 
        
          $pdf->SetX(132);
         $pdf->Cell(21,5,'IGV',1, 0 , 'R' );
        $pdf->Cell(20,5, $simbolodemoneda,1, 0 , 'C' );
        $pdf->Cell(23,5, $igv,1, 0 , 'R' );
        $pdf->Ln(); 
        
          $pdf->SetX(132);
         $pdf->Cell(21,5,'TOTAL',1, 0 , 'R' );
        $pdf->Cell(20,5, $simbolodemoneda,1, 0 , 'C' );
        $pdf->Cell(23,5, $total,1, 0 , 'R' );
        $pdf->Ln(); 
         
        $pdf->Output();
    }
    function pruebas($correlativo, $numerofactura) {
        $fac_correlativo    = $correlativo;
        $fac_numero_factura = $numerofactura;
        $data2              = array(
            'fac_correlativo' => $fac_correlativo,
            'fac_numero_factura' => $fac_numero_factura
        );
        $subtotal           = 0;
        $facturas           = Facturas::whereV($data2, 'and');
        foreach ($facturas as $value) {
            $ruc_cliente            = $value['fac_cli_id'];
            $fac_numero_factura     = $value['fac_numero_factura'];
            $fact_fecha             = $value['fact_fecha'];
            $fact_moneda            = $value['fact_moneda'];
            $subtotal               = $subtotal + $value['fact_total'];
            $igv                    = $subtotal * 0.18;
            $total                  = $subtotal + $igv;
            $fact_tipocambio        = $value['fact_tipocambio'];
            $fact_sunat_transaccion = $value['fact_sunat_transaccion'];
            $fact_fecha_vencimiento = $value['fact_fecha_vencimiento'];
            $fact_condiciones_pago  = $value['fact_condiciones_pago'];
            $fact_medio_pago        = $value['fact_medio_pago'];
        }
        $fact_fecha_vencimiento = $this->fecha_vencimiento($fact_fecha_vencimiento);
        $cliente                = Clientes::getBy('cli_ruc', $ruc_cliente);
        $cli_ubigeo             = $cliente->getCli_ubigeo();
        $ubigeo                 = Ubigeo::getById($cli_ubigeo);
        $ubi_departamento       = $ubigeo->getUbi_departamento();
        $ubi_provincia          = $ubigeo->getUbi_provincia();
        $ubi_distrito           = $ubigeo->getUbi_distrito();
        $cli_nombre             = strtoupper($cliente->getCli_nombre());
        $cli_direccion          = strtoupper(utf8_decode(strtoupper($cliente->getCli_direccion()) . ' ' . $ubi_departamento . ' ' . $ubi_provincia . ' ' . $ubi_distrito));
        $cli_ruc                = strtoupper($cliente->getCli_ruc());
        $subtotal               = number_format((float) $subtotal, 2, '.', '');
        $igv                    = number_format((float) $igv, 2, '.', '');
        $total                  = number_format((float) $total, 2, '.', '');
        $ruta                   = ruta_nubefact;
        $token                  = token_nubefact;
        if ($fact_moneda == 1) {
            $tipodecambio = "";
        }
        if ($fact_moneda == 2) {
            $tipodecambio = $fact_tipocambio;
        }
        $data = array(
            "operacion" => "generar_comprobante",
            "tipo_de_comprobante" => "1",
            "serie" => "F001",
            "numero" => $fac_numero_factura,
            "sunat_transaction" => $fact_sunat_transaccion,
            "cliente_tipo_de_documento" => "6",
            "cliente_numero_de_documento" => $cli_ruc,
            "cliente_denominacion" => $cli_nombre,
            "cliente_direccion" => $cli_direccion,
            "cliente_email" => "",
            "cliente_email_1" => "",
            "cliente_email_2" => "",
            "fecha_de_emision" => date('d-m-Y'),
            "fecha_de_vencimiento" => $fact_fecha_vencimiento,
            "moneda" => $fact_moneda,
            "tipo_de_cambio" => $tipodecambio,
            "porcentaje_de_igv" => "18.00",
            "descuento_global" => "",
            "descuento_global" => "",
            "total_descuento" => "",
            "total_anticipo" => "",
            "total_gravada" => $subtotal,
            "total_inafecta" => "",
            "total_exonerada" => "",
            "total_igv" => $igv,
            "total_gratuita" => "",
            "total_otros_cargos" => "",
            "total" => $total,
            "percepcion_tipo" => "",
            "percepcion_base_imponible" => "",
            "total_percepcion" => "",
            "total_incluido_percepcion" => "",
            "detraccion" => "false",
            "observaciones" => "",
            "documento_que_se_modifica_tipo" => "",
            "documento_que_se_modifica_serie" => "",
            "documento_que_se_modifica_numero" => "",
            "tipo_de_nota_de_credito" => "",
            "tipo_de_nota_de_debito" => "",
            "enviar_automaticamente_a_la_sunat" => "true",
            "enviar_automaticamente_al_cliente" => "false",
            "codigo_unico" => "",
            "condiciones_de_pago" => $fact_condiciones_pago,
            "medio_de_pago" => $fact_medio_pago,
            "placa_vehiculo" => "",
            "orden_compra_servicio" => "",
            "tabla_personalizada_codigo" => "",
            "formato_de_pdf" => "",
            "items" => array(),
            "guias" => array()
        );
        foreach ($facturas as $value) {
            $preciounitario = $value['fact_preciounitario'];
            $preciounitario = number_format((float) $preciounitario, 2, '.', '');
            array_push($data['items'], array(
                "unidad_de_medida" => "NIU",
                "codigo" => $value['fact_codproducto'],
                "descripcion" => $value['fact_producto'],
                "cantidad" => $value['fact_cantidad'],
                "valor_unitario" => $preciounitario,
                "precio_unitario" => $preciounitario * 1.18,
                "descuento" => "",
                "subtotal" => $preciounitario * $value['fact_cantidad'],
                "tipo_de_igv" => "1",
                "igv" => $preciounitario * $value['fact_cantidad'] * 0.18,
                "total" => ($preciounitario * $value['fact_cantidad'] * 0.18) + $preciounitario * $value['fact_cantidad'],
                "anticipo_regularizacion" => "false",
                "anticipo_documento_serie" => "",
                "anticipo_documento_numero" => ""
            ));
        }
        foreach ($facturas as $value) {
            $fact_guia_tipo  = $value['fact_guia_tipo'];
            $fact_guia_serie = $value['fact_guia_serie'];
        }
        if (empty($value['fact_guia_tipo'])) {
        } else {
            array_push($data['guias'], array(
                "guia_tipo" => $fact_guia_tipo,
                "guia_serie_numero" => $fact_guia_serie
            ));
        }
        ;
        $data_json = json_encode($data);
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Token token="' . $token . '"',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);
        curl_close($ch);
        $leer_respuesta = json_decode($respuesta, true);
        if (isset($leer_respuesta['errors'])) {
            //Mostramos los errores si los hay
            echo $leer_respuesta['errors'];
        } else {
            //Mostramos la respuesta     
            $respuesta = $leer_respuesta['enlace'];
            header('Location:' . $respuesta);
        }
    }
    public function fecha_vencimiento($dias) {
        $fecha = new DateTime();
        $fecha->add(new DateInterval('P' . $dias . 'D'));
        return $fecha->format('d-m-Y');
    }
    public function consultar_comprobante($correlativo, $numerofactura){
 $ruta= ruta_nubefact;
 $token= token_nubefact;
  $data = array(
            "operacion" => "consultar_comprobante",
            "tipo_de_comprobante" =>1,
            "serie" =>$correlativo,
            "numero" => $numerofactura,
            
        );
$data_json = json_encode($data);
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Token token="' . $token . '"',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);
        curl_close($ch);
        $leer_respuesta = json_decode($respuesta, true);
        $respuesta = $leer_respuesta['enlace'];
            header('Location:' . $respuesta);
    }
        function imprimirguia() {
      
       /* $meses        = array(
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        );
        $date_dia     = date_format($date, 'd');
        $date_mes     = date_format($date, 'm');
        $date_mes2    = $meses[$date_mes - 1];
        $date_ano     = date_format($date, 'Y');*/
     
        require(URLFW . 'fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image(URLIMG . 'pdf.jpg', 0, 0, 210);
        $pdf->SetFont('Arial', '', 14);
        //$pdf->Text(135, 41, $_GET['fac_correlativo'] . ' - ');
        //$pdf->Text(165, 41, $_GET['fac_numero_factura']);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Text(30, 32, '$cli_nombre');
        $pdf->Text(30, 34.6, '$cli_direccion');
        $pdf->Text(30, 37.6, '$cli_ruc');
        $pdf->SetFont('Arial', 'B', 8);
        //$pdf->Text(180, 238, $simbolodemoneda .' '. $subtotal);
        //$pdf->Text(180, 242.5, $simbolodemoneda .' '. $igv);
        //$pdf->Text(180, 247, $simbolodemoneda .' '. $total);
        $pdf->SetFont('Arial', '', 7);
        //$pdf->Text(60, 245, $letras);
         $pdf->SetFont('Arial', 'B', 8);
	$pdf->Text(144, 32, '$date_dia');
        $pdf->Text(159, 32, '$date_mes2');
         $pdf->Text(201, 32, 'substr($date_ano, -1)');
        //$pdf->tablaHorizontal1($misDatos);
        $pdf->Output();
    }
     function eliminar_itemfactura() {
        $id       = $_POST['id'];
        $usuarios = Facturas::getById($id);
        $usuarios->delete();       
    }
    public function cambiar_envio_sunat(){
         $data=array(
                'fac_correlativo'=>$_POST['fac_correlativo'],
                'fac_numero_factura'=>$_POST['fac_numero_factura']
            );
            $guia= Facturas::whereV($data, 'and');
            
            foreach ($guia as $value) {
                   $guia2 = Facturas::getById($value['id']);
            if( $guia2->getFact_envio_sunat()==0){
                $guia2->setFact_envio_sunat(1);
                $guia2->update();
            }
            }
            
    }
     public function codpro(){
              $productos = Articulos::where('art_codigo', $_POST['codart']);
         if(empty($productos)){
             echo 0;
         }else{
             echo json_encode($productos);
         }
    }
}