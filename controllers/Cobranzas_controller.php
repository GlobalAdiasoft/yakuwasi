<?php

class Cobranzas_controller extends Controller{
    public function __construct() {
        parent::__construct();
    }    
    public function llamar_factura(){
        $factura= Facturas::getAll();
        foreach ($factura as $value) {
            echo '<option value="'.$value['id'].'">'.$value['fac_correlativo'].'-'.$value['fac_numero_factura'].'-'.$value['fac_cli_id'].'</option>';
        }
    }
    public function mostrar_facturas(){
        $factura= Facturas::getAll();
        $datos= array();
        
        foreach ($factura as $value) {
            
             if(empty($factura)){
            echo json_encode($datos);
            exit;
        }else{
            /*if($value['fact_condiciones_pago']=='C'){
                echo json_encode($datos,JSON_PRETTY_PRINT);
                exit;
            }*/
            $pedidos=$value['fact_pedido_usuario'];
            $pedidos = explode('/',$pedidos);
            $usuario = Usuario::getBy('usu_usuario', $pedidos[1]);
            $datos_recibidos=$this->tabla_itemspedido_totales($pedidos[0], $usuario->getId());
           
        }
           if($value['fact_condiciones_pago']=='C'){
               $fact_condiciones_pago='Contado';
               $fecha_vencimiento = '';
           }else{
               $fact_condiciones_pago = 'Crédito '.$value['fact_condiciones_pago'].' días';
               $fecha_vencimiento = $this->fecha_vencimiento($value['fact_condiciones_pago']);
           }
           if($value['fact_moneda']=='PEN'){
               $simbolo = 'S/ ';
           }else{
               $simbolo = 'US$ ';
           }
           $data_cobranza=array(
               'cobra_documento'=> strtoupper($value['fac_correlativo'].'-'.$value['fac_numero_factura']),
               );
           $cobranzas = Cobranzas::whereV($data_cobranza, 'and');
           if(empty($cobranzas)){
               $total_pagado = 0.00;
           }else{
               $total_pagado = 0;
               foreach ($cobranzas as $value_c) {
                   $total_pagado=$total_pagado + $value_c['cobra_monto'];
               }
             
           }
           
           if($datos_recibidos[0]['total'] <= $total_pagado || $fact_condiciones_pago == 'Contado' ){
               $btn_cobranza='<div class="alert alert-success text-center" role="alert"><i class="fas fa-check-circle"></i> Cobrado Totalmente</div>';
           }else{
             $btn_cobranza="<button id='btn_cobranza' class='btn btn-success btn-sm' ><i class='far fa-money-bill-alt fa-sm'></i> Cobranza</button>";
           }
           
           $por_pagar= $datos_recibidos[0]['total'] - $total_pagado;
          
           array_push($datos, array(
                "id" => strtoupper($value['id']),
               "btn_cobranza"=>$btn_cobranza,
               "fac_correlativo" => strtoupper($value['fac_correlativo'].'-'.$value['fac_numero_factura']),
               "fact_condiciones_pago" => strtoupper($fact_condiciones_pago),
               "fact_fecha"=>$value['fact_fecha'],
               "fact_fecha_vencimiento"=>$fecha_vencimiento,
               "total_factura"=>'<strong>'.$simbolo.$datos_recibidos[0]['total'].'</strong>',
               "total_pagado"=>$simbolo.number_format((float) $total_pagado, 2, '.', ','),
                "total_por_pagar"=>$simbolo.number_format((float) $por_pagar, 2, '.', ','),
            ));
              }
           echo json_encode($datos,JSON_PRETTY_PRINT);
    }
    public function fecha_vencimiento($dias) {
        
        $fecha = new DateTime();
        $fecha->add(new DateInterval('P' . $dias . 'D'));
        return $fecha->format('Y-m-d');
       
    }
        public function tabla_itemspedido_totales($id, $usuario ){
        $datos=array();
     
             $data     = array(
            'ped_id_pedidos_doc' => $id,
            'ped_usuario' => $usuario
        );
        
       
          
           
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
         return $datos;
            
             
    }
    function ejemplo(){
        $data_cobranza=array(
               'cobra_documento'=> 'FFF1-1',
               );
          if(empty($cobranzas)){
               $total_pagado = 0.00;
           }else{
               $total_pagado = 0;
               foreach ($cobranzas as $value_c) {
                   $total_pagado=$total_pagado + $value_c['cobra_monto'];
               }
               
           }
           echo $total_pagado;
        }
}
