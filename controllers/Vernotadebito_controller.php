<?php

class Vernotadebito_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function mostrar(){
       $notacredito = Notadebito::getAll();
       $data=array();
       foreach ($notacredito as $value) {
          if(empty($value['nota_pdf'])) {
              $nota_pdf='';
          }else{
              $nota_pdf='<a target="_blank" href="'.$value['nota_pdf'].'"><img class="img_icons" src="'.URL.URLIMG.'pdf.svg" alt=""></a>';
          }
            if(empty($value['nota_xml'])) {
              $nota_xml='';
          }else{
              $nota_xml='<a target="_blank" href="'.$value['nota_xml'].'"><img class="img_icons" src="'.URL.URLIMG.'xml.svg" alt=""></a>';
          }
           if($value['nota_cdr']=='CDR') {
              $nota_cdr='';
          }else{
              $nota_cdr='<a target="_blank" href="'.$value['nota_cdr'].'"><img class="img_icons" src="'.URL.URLIMG.'xml_1.svg" alt=""></a>';
          }
          if($value['nota_envio_sunat']==1) {
             $nota_envio_sunat='<img class="img_icons" src="'.URL.URLIMG.'list.svg" alt="">';
          }else{
              $nota_envio_sunat='';
          }
          if($value['nota_documento_modificar']==1) {
             $nota_documento_modificar='FFF1';
          }else{
             $nota_documento_modificar='BBB1';
          }
          array_push($data, array(
              "id" => strtoupper($value['id']),
              "nota_fecha" => strtoupper($value['nota_fecha']),
              "nota_correlativo" => strtoupper($value['nota_correlativo']),
              "nota_numero" => strtoupper($value['nota_numero']),
              "nota_moneda" => strtoupper($value['nota_moneda']),
              "nota_tipocambio" => strtoupper($value['nota_tipocambio']),
              "nota_sunat_transaccion" => strtoupper($value['nota_sunat_transaccion']),
              "nota_fecha_vencimiento" => strtoupper($value['nota_fecha_vencimiento']),
              "nota_cli_id" => strtoupper($value['nota_cli_id']),
              "nota_documento_modificar" => strtoupper($nota_documento_modificar),
              "nota_numero_modificar" => strtoupper($value['nota_numero_modificar']),
              "nota_tipo" => strtoupper($value['nota_tipo']),
              "nota_correlativo_numero" => strtoupper($value['nota_envio_sunat']),
              "nota_envio_sunat" =>$nota_envio_sunat,
              "nota_pdf" => $nota_pdf,
              "nota_xml" => $nota_xml,
              "nota_cdr" => $nota_cdr,
            ));
        }
        echo json_encode($data);
    }
}
