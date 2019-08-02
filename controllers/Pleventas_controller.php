<?php
class Pleventas_controller extends Controller {
  function crear($fecha_emision,$fecha_vencimiento,$tipo_comprobante,$serie,$numero){
   $id=NULL;
   $periodo='29';
   $correlativo_registro='';
   $final_consolidado='';
   $tipo_doc_cliente='';
   $nro_documento='';
   $razon_social='';
   $valor_exportacion='';
   $operacion_gravada='';
   $importe_total_exonerada='';
   $importe_total_inafecta='';
   $isc='';
   $igv_ipm='';
   $operacion_gravada_ivap='';
   $ivap='';
   $otros_cargos='';
   $total_comprobante='';
   $tipo_cambio='';
   $fecha_emision_modificado='';
   $tipo_doc_cliente_modificado='';
   $serie_modificado='';
   $numero_modificado='';
   $estado='';
   $ple_ventas = new Pleventas($id, $periodo, $correlativo_registro, $fecha_emision, $fecha_vencimiento, $tipo_comprobante, $serie, $numero, $final_consolidado, $tipo_doc_cliente, $nro_documento, $razon_social, $valor_exportacion, $operacion_gravada, $importe_total_exonerada, $importe_total_inafecta, $isc, $igv_ipm, $operacion_gravada_ivap, $ivap, $otros_cargos, $total_comprobante, $tipo_cambio, $fecha_emision_modificado, $tipo_doc_cliente_modificado, $serie_modificado, $numero_modificado, $estado);
   $ple_ventas->create();
  }
 
   
   function mostrar(){
          $pleventas = Pleventas::getAll();
        $data = array();
        foreach ($pleventas as $value) {
   
        array_push($data, array(

            "id"=> mb_strtoupper($value['id']),
            "periodo"=> mb_strtoupper($value['periodo']),
            "correlativo_registro"=> mb_strtoupper(str_pad($value['id'],7,'0',STR_PAD_LEFT)),
            "fecha_emision"=> mb_strtoupper($value['fecha_emision']),
            "fecha_vencimiento"=> mb_strtoupper($value['fecha_vencimiento']),
            "tipo_comprobante"=> mb_strtoupper($value['tipo_comprobante']),
            "serie"=> mb_strtoupper($value['serie']),
            "numero"=> mb_strtoupper($value['numero']),
            "final_consolidado"=> mb_strtoupper($value['final_consolidado']),
            "tipo_doc_cliente"=> mb_strtoupper($value['tipo_doc_cliente']),
            "nro_documento"=> mb_strtoupper($value['nro_documento']),
            "razon_social"=> mb_strtoupper($value['razon_social']),
            "valor_exportacion"=> mb_strtoupper($value['valor_exportacion']),
            "operacion_gravada"=> mb_strtoupper($value['operacion_gravada']),
            "importe_total_exonerada"=> mb_strtoupper($value['importe_total_exonerada']),
            "importe_total_inafecta"=> mb_strtoupper($value['importe_total_inafecta']),
            "isc"=> mb_strtoupper($value['isc']),
            "igv_ipm"=> mb_strtoupper($value['igv_ipm']),
            "operacion_gravada_ivap"=> mb_strtoupper($value['operacion_gravada_ivap']),
            "ivap"=> mb_strtoupper($value['ivap']),
            "otros_cargos"=> mb_strtoupper($value['otros_cargos']),
            "total_comprobante"=> mb_strtoupper($value['total_comprobante']),
            "tipo_cambio"=> mb_strtoupper($value['tipo_cambio']),
            "fecha_emision_modificado"=> mb_strtoupper($value['fecha_emision_modificado']),
            "tipo_doc_cliente_modificado"=> mb_strtoupper($value['tipo_doc_cliente_modificado']),
            "serie_modificado"=> mb_strtoupper($value['serie_modificado']),
            "numero_modificado"=> mb_strtoupper($value['numero_modificado']),
            "estado"=> mb_strtoupper($value['estado']), 
                   
));
        }
        echo json_encode($data);
   }
   
}
