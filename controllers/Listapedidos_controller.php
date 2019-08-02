<?php
class Listapedidos_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function mostrar() {
        $datos = array();
        if (empty($_GET['busqueda'])) {
            $pedidosdoc = PedidosDoc::getAll();
        } else {
            $id         = $_GET['busqueda'];
            $pedidosdoc = PedidosDoc::where('ped_aprobacion', $id);
        }
        foreach ($pedidosdoc as $value) {
            switch ($value['ped_aprobacion']) {
                case 1:
             $eliminar = "<button class='btn btn-danger btn-sm' id='btn_eliminar' ><i class='far fa-trash-alt'></i></button>";

                    $aprobacion = '<div class="row">
  <div class="col-12">
   <button type="button" class="btn btn-sm btn-success" id="btn_aprobar" onclick="aprobar(' . $value['id'] . ')">Aprobar</button>
   </div>
   <div class="col-12"><br></div>
  <div class="col-12">
    <button type="button" class="btn btn-sm btn-danger" id="btn_rechazar" onclick="rechazar(' . $value['id'] . ')">Rechazar</button></div>
</div>';
                    break;
                case 2:
                    $aprobacion = '<div class="alert alert-success text-center" role="alert"><i class="fas fa-check-circle"></i> Aprobada</div>';
                                 $eliminar = "<button class='btn btn-danger btn-sm' disabled><i class='far fa-trash-alt'></i></button>";

                    break;
                case 3:
                    $aprobacion = '<div class="alert alert-danger text-center" role="alert"><i class="fas fa-times-circle"></i> Rechazada</div>';
                                 $eliminar = "<button class='btn btn-danger btn-sm' disabled><i class='far fa-trash-alt'></i></button>";

                    break;
            }
            $usuarios = Usuario::getById($value['ped_usuario']);
            if ($value['ped_tipo_doc'] == 'FAC') {
                $tipodoc = 'Factura';
                switch ($value['ped_aprobacion']) {
                    case 1:
                        $btn_documento = '';
                        break;
                    case 2:
                       if($value['ped_facturado']==1){
                       $btn_documento = "<div class='alert alert-info text-center' role='alert'>
  <strong><i class='fas fa-check-circle'></i> Facturado</strong> 
</div>";

                       }else{
                        $btn_documento = '<button id="generar_factura" class="btn btn-info btn-sm" >Generar Factura</button>';
                        }
                        break;
                    case 3:
                        $btn_documento = '';
                        break;
                }
            } else {
                $tipodoc = 'Boleta';
                switch ($value['ped_aprobacion']) {
                    case 1:
                        $btn_documento = '';

                        break;
                    case 2:
                        if($value['ped_facturado']==1){
                                       $btn_documento = "<div class='alert alert-info text-center' role='alert'>
<strong><i class='fas fa-check-circle'></i> Boleteado</strong> 
</div>";
                        }else{
                        $btn_documento = '<button id="generar_boleta" class="btn btn-info btn-sm" >Generar Boleta</button>';
                        }
                        break;
                    case 3:
                        $btn_documento = '';
                        break;
                }
            }
            $clientes = Clientes::getById($value['ped_cli_id']);
            array_push($datos, array(
                'id' => $value['id'],
                'usuario_cod' => strtoupper('<small>' . $usuarios->getUsu_usuario() . '</small>-' . str_pad($value['ped_cod_ped'], 6, 0, STR_PAD_LEFT) . '<br>') . '<a target="_blank" href="../Listapedidos/vistaprevia/' . $value['ped_cod_ped'] . '/'.$value['ped_usuario'].'"><i class="fas fa-search"></i> <small>Vista Previa</small></a>',
                'ped_cod_ped' => $value['ped_cod_ped'],
                'ped_tipo_doc' => strtoupper($tipodoc) . '<br>' . $btn_documento,
                'ped_usuario' => strtoupper($usuarios->getUsu_usuario()),
                'ped_fecha' => $value['ped_fecha'],
                'ped_cli_id' => $clientes->getCli_ruc() . ' <br><small>' . $clientes->getCli_nombre() . '</small>',
                'ped_aprobacion' => $aprobacion,
                'ped_moneda'=>$value['ped_moneda'],
                'ped_tipocambio'=>$value['ped_tipocambio'],
                'eliminar'=> $eliminar,
            ));
        }
        echo json_encode($datos);
    }
    function vistaprevia($ped_cod_ped,$ped_usuario,$salida='') {
        $data = array(
            'ped_cod_ped'=>$ped_cod_ped,
            'ped_usuario'=>$ped_usuario,
        );
        $listapedidos = PedidosDoc::getByData($data,'and');
      
        
      
        if ($listapedidos->getPed_tipo_doc() == 'BOL') {
            $ped_tipo_doc = 'BOLETA';
        } else {
            $ped_tipo_doc = 'FACTURA';
        }
        
        $clientes         = Clientes::getBy('id', $listapedidos->getPed_cli_id());
        $ubigeo           = Ubigeo::getById($clientes->getCli_ubigeo());
        $ubi_departamento = $ubigeo->getUbi_departamento();
        $ubi_provincia    = $ubigeo->getUbi_provincia();
        $ubi_distrito     = $ubigeo->getUbi_distrito();
        $ubigeo_completo  = strtoupper(utf8_decode($ubi_departamento . ' - ' . $ubi_provincia . ' - ' . $ubi_distrito));
        $datos_items      = Pedidos::where('ped_id_pedidos_doc', $ped_cod_ped);
        $resultado        = Pedidos_controller::tabla_itemspedido_totales($ped_cod_ped, $ped_usuario);
      
        //print_r($resultado);
       foreach ($resultado as $value) {
            $subtotal = $value['subtotal'];
            $igv      = $value['igv'];
            $total    = $value['total'];
        }
        if($listapedidos->getPed_moneda()=='PEN'){
            $moneda = 'SOLES';
            $simbolo = 'S/';
            $letras = utf8_decode(NumeroALetras::convertir($total, 'soles', ''));
        }else{
            $moneda = 'DÓLARES';
            $simbolo = 'US$';
            $letras = utf8_decode(NumeroALetras::convertir($total, 'dÓlares americanos', ''));
        }
        require(URLFW . 'fpdf/fpdf.php');
        //$pdf = new FPDF('P', 'mm', 'A4');
        $pdf = new FPDF($orientation='P',$unit='mm', array(88,350));
        
        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Text(5, 5, 'JP INVERSIONES COMPANY S.R.L');    
        $pdf->Text(5, 10, 'CAL.COMANDANTE CANGA NRO. 1104');
        $pdf->Text(5, 15, 'AREQUIPA - AREQUIPA - MARIANO MELGAR');
      
        
        $pdf->Text(5, 20, 'ADQUIRIENTE');
      
        $pdf->Text(5, 25, 'RUC: ' . $clientes->getCli_ruc());
        $pdf->SetXY(4, 30);
        $pdf->MultiCell(120, 2, utf8_decode($clientes->getCli_nombre()),0,'L');
        $pdf->SetXY(4, 35);
        $pdf->MultiCell(120, 2, utf8_decode($clientes->getCli_direccion()),0,'L');
        $pdf->Text(5, 42, utf8_decode($ubigeo_completo));
        
        
        $pdf->Text(5, 47, utf8_decode('FECHA EMISIÓN:'));
        $pdf->Text(5, 52, utf8_decode('FECHA DE VENC:'));
        $pdf->Text(5, 57, utf8_decode('MONEDA:'));
        $pdf->Text(5, 62, 'IGV:');
        
        $pdf->Text(166, 47, utf8_decode('(Fecha Emisión)'));
        $pdf->Text(166, 51, utf8_decode('(Fecha Vencimiento)'));
        $pdf->Text(155, 55, utf8_decode($moneda));
        $pdf->Text(146, 59, '18.00%');
        $pdf->fpdf_datos_items_lista($datos_items);
        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(80, 5, $letras, 1, 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        
        $pdf->SetX(5);
        $pdf->Cell(21, 5, 'GRAVADA', 1, 0, 'C');
        $pdf->Cell(15, 5, $simbolo, 1, 0, 'C');
        $pdf->Cell(23, 5, $subtotal, 1, 0, 'R');
        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(21, 5, 'IGV', 1, 0, 'C');
        $pdf->Cell(15, 5, $simbolo, 1, 0, 'C');
        $pdf->Cell(23, 5, $igv, 1, 0, 'R');
        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(21, 5, 'TOTAL', 1, 0, 'C');
        $pdf->Cell(15, 5, $simbolo, 1, 0, 'C');
        $pdf->Cell(23, 5, $total, 1, 0, 'R');
        $pdf->Ln();
        if(empty($salida)){
             $pdf->Output();
        }else{
           $filename=URLDOC."test.pdf";
        $pdf->Output($filename,'F');  
        }
       
        
       
    }
    function aprobar() {
        $listapedidos = PedidosDoc::getBy('id', $_POST['id']);
        $listapedidos->setPed_aprobacion(2);
        $listapedidos->update();
    }
     function aprobar2() {
        $datos_lista=array(
            'ped_cod_ped'=>$_POST['pedido'],
            'ped_tipo_doc'=>'FAC',
            'ped_usuario'=> Session::getValue('ID_TRA'.NOMBRE_SESSION),
            
        );
        $listapedidos = PedidosDoc::getByData($datos_lista, 'and');
        $listapedidos->setPed_aprobacion(2);
        $listapedidos->update();
    }
      function aprobar3() {
        $datos_lista=array(
            'ped_cod_ped'=>$_POST['pedido'],
            'ped_tipo_doc'=>'BOL',
            'ped_usuario'=> Session::getValue('ID_TRA'.NOMBRE_SESSION),
            
        );
        $listapedidos = PedidosDoc::getByData($datos_lista, 'and');
        $listapedidos->setPed_aprobacion(2);
        $listapedidos->update();
    }
    function rechazar() {
        $listapedidos = PedidosDoc::getBy('id', $_POST['id']);
        $listapedidos->setPed_aprobacion(3);
        $listapedidos->update();
    }
       function verificarnumerofactura() {
       
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
        function verificarnumeroboleta() {
       
       $data=array(
           'bol_correlativo'=>$_POST['correlativo'],
       );
        $boletas = Boletas::whereV($data, 'and', 'bol_numero_boleta');
      
        if (empty($boletas)) {
            echo 1;
        } else {
            foreach ($boletas as $value) {
                $variable = $value['bol_numero_boleta'];
            }
            echo $variable + 1;
        }
    }
    public function eliminar_pedido(){
        $usuario= Usuario::getBy('usu_usuario', $_POST['usuario']);
        $id_usuario=$usuario->getId();
        $data_pedido =array(
            'ped_id_pedidos_doc'=>$_POST['nropedido'],
            'ped_usuario'=>$id_usuario,
            );
            $pedidos= Pedidos::whereV($data_pedido, 'and');
            foreach ($pedidos as $value) {
                /*$articulo = Articulos::getById($value['ped_id_pro']);
                $stock =$articulo->getArt_stock();               
                $articulo->setArt_stock( $stock+$value['ped_cantidad']);
                $articulo->update();      */          
                $pedido_item= Pedidos::getById($value['id']);
                $pedido_item->delete();        
            };
            $data_pedidosDoc=array(
                'ped_cod_ped'=>$_POST['nropedido'],
                'ped_usuario'=>$id_usuario,
                );
            $pedidos_doc= PedidosDoc::getByData($data_pedidosDoc, 'and');
            $pedidos_doc->delete();
          
    }
}