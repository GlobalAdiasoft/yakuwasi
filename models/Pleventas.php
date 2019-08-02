<?php
class Pleventas extends Model {
   protected static $table = "t_pleventas";
   private $id;
   private $periodo;
   private $correlativo_registro;
   private $fecha_emision;
   private $fecha_vencimiento;
   private $tipo_comprobante;
   private $serie;
   private $numero;
   private $final_consolidado;
   private $tipo_doc_cliente;
   private $nro_documento;
   private $razon_social;
   private $valor_exportacion;
   private $operacion_gravada;
   private $importe_total_exonerada;
   private $importe_total_inafecta;
   private $isc;
   private $igv_ipm;
   private $operacion_gravada_ivap;
   private $ivap;
   private $otros_cargos;
   private $total_comprobante;
   private $tipo_cambio;
   private $fecha_emision_modificado;
   private $tipo_doc_cliente_modificado;
   private $serie_modificado;
   private $numero_modificado;
   private $estado;
   function __construct($id, $periodo, $correlativo_registro, $fecha_emision, $fecha_vencimiento, $tipo_comprobante, $serie, $numero, $final_consolidado, $tipo_doc_cliente, $nro_documento, $razon_social, $valor_exportacion, $operacion_gravada, $importe_total_exonerada, $importe_total_inafecta, $isc, $igv_ipm, $operacion_gravada_ivap, $ivap, $otros_cargos, $total_comprobante, $tipo_cambio, $fecha_emision_modificado, $tipo_doc_cliente_modificado, $serie_modificado, $numero_modificado, $estado) {
       $this->id = $id;
       $this->periodo = $periodo;
       $this->correlativo_registro = $correlativo_registro;
       $this->fecha_emision = $fecha_emision;
       $this->fecha_vencimiento = $fecha_vencimiento;
       $this->tipo_comprobante = $tipo_comprobante;
       $this->serie = $serie;
       $this->numero = $numero;
       $this->final_consolidado = $final_consolidado;
       $this->tipo_doc_cliente = $tipo_doc_cliente;
       $this->nro_documento = $nro_documento;
       $this->razon_social = $razon_social;
       $this->valor_exportacion = $valor_exportacion;
       $this->operacion_gravada = $operacion_gravada;
       $this->importe_total_exonerada = $importe_total_exonerada;
       $this->importe_total_inafecta = $importe_total_inafecta;
       $this->isc = $isc;
       $this->igv_ipm = $igv_ipm;
       $this->operacion_gravada_ivap = $operacion_gravada_ivap;
       $this->ivap = $ivap;
       $this->otros_cargos = $otros_cargos;
       $this->total_comprobante = $total_comprobante;
       $this->tipo_cambio = $tipo_cambio;
       $this->fecha_emision_modificado = $fecha_emision_modificado;
       $this->tipo_doc_cliente_modificado = $tipo_doc_cliente_modificado;
       $this->serie_modificado = $serie_modificado;
       $this->numero_modificado = $numero_modificado;
       $this->estado = $estado;
   }

   function getId() {
       return $this->id;
   }

   function getPeriodo() {
       return $this->periodo;
   }

   function getCorrelativo_registro() {
       return $this->correlativo_registro;
   }

   function getFecha_emision() {
       return $this->fecha_emision;
   }

   function getFecha_vencimiento() {
       return $this->fecha_vencimiento;
   }

   function getTipo_comprobante() {
       return $this->tipo_comprobante;
   }

   function getSerie() {
       return $this->serie;
   }

   function getNumero() {
       return $this->numero;
   }

   function getFinal_consolidado() {
       return $this->final_consolidado;
   }

   function getTipo_doc_cliente() {
       return $this->tipo_doc_cliente;
   }

   function getNro_documento() {
       return $this->nro_documento;
   }

   function getRazon_social() {
       return $this->razon_social;
   }

   function getValor_exportacion() {
       return $this->valor_exportacion;
   }

   function getOperacion_gravada() {
       return $this->operacion_gravada;
   }

   function getImporte_total_exonerada() {
       return $this->importe_total_exonerada;
   }

   function getImporte_total_inafecta() {
       return $this->importe_total_inafecta;
   }

   function getIsc() {
       return $this->isc;
   }

   function getIgv_ipm() {
       return $this->igv_ipm;
   }

   function getOperacion_gravada_ivap() {
       return $this->operacion_gravada_ivap;
   }

   function getIvap() {
       return $this->ivap;
   }

   function getOtros_cargos() {
       return $this->otros_cargos;
   }

   function getTotal_comprobante() {
       return $this->total_comprobante;
   }

   function getTipo_cambio() {
       return $this->tipo_cambio;
   }

   function getFecha_emision_modificado() {
       return $this->fecha_emision_modificado;
   }

   function getTipo_doc_cliente_modificado() {
       return $this->tipo_doc_cliente_modificado;
   }

   function getSerie_modificado() {
       return $this->serie_modificado;
   }

   function getNumero_modificado() {
       return $this->numero_modificado;
   }

   function getEstado() {
       return $this->estado;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setPeriodo($periodo) {
       $this->periodo = $periodo;
   }

   function setCorrelativo_registro($correlativo_registro) {
       $this->correlativo_registro = $correlativo_registro;
   }

   function setFecha_emision($fecha_emision) {
       $this->fecha_emision = $fecha_emision;
   }

   function setFecha_vencimiento($fecha_vencimiento) {
       $this->fecha_vencimiento = $fecha_vencimiento;
   }

   function setTipo_comprobante($tipo_comprobante) {
       $this->tipo_comprobante = $tipo_comprobante;
   }

   function setSerie($serie) {
       $this->serie = $serie;
   }

   function setNumero($numero) {
       $this->numero = $numero;
   }

   function setFinal_consolidado($final_consolidado) {
       $this->final_consolidado = $final_consolidado;
   }

   function setTipo_doc_cliente($tipo_doc_cliente) {
       $this->tipo_doc_cliente = $tipo_doc_cliente;
   }

   function setNro_documento($nro_documento) {
       $this->nro_documento = $nro_documento;
   }

   function setRazon_social($razon_social) {
       $this->razon_social = $razon_social;
   }

   function setValor_exportacion($valor_exportacion) {
       $this->valor_exportacion = $valor_exportacion;
   }

   function setOperacion_gravada($operacion_gravada) {
       $this->operacion_gravada = $operacion_gravada;
   }

   function setImporte_total_exonerada($importe_total_exonerada) {
       $this->importe_total_exonerada = $importe_total_exonerada;
   }

   function setImporte_total_inafecta($importe_total_inafecta) {
       $this->importe_total_inafecta = $importe_total_inafecta;
   }

   function setIsc($isc) {
       $this->isc = $isc;
   }

   function setIgv_ipm($igv_ipm) {
       $this->igv_ipm = $igv_ipm;
   }

   function setOperacion_gravada_ivap($operacion_gravada_ivap) {
       $this->operacion_gravada_ivap = $operacion_gravada_ivap;
   }

   function setIvap($ivap) {
       $this->ivap = $ivap;
   }

   function setOtros_cargos($otros_cargos) {
       $this->otros_cargos = $otros_cargos;
   }

   function setTotal_comprobante($total_comprobante) {
       $this->total_comprobante = $total_comprobante;
   }

   function setTipo_cambio($tipo_cambio) {
       $this->tipo_cambio = $tipo_cambio;
   }

   function setFecha_emision_modificado($fecha_emision_modificado) {
       $this->fecha_emision_modificado = $fecha_emision_modificado;
   }

   function setTipo_doc_cliente_modificado($tipo_doc_cliente_modificado) {
       $this->tipo_doc_cliente_modificado = $tipo_doc_cliente_modificado;
   }

   function setSerie_modificado($serie_modificado) {
       $this->serie_modificado = $serie_modificado;
   }

   function setNumero_modificado($numero_modificado) {
       $this->numero_modificado = $numero_modificado;
   }

   function setEstado($estado) {
       $this->estado = $estado;
   }

 public function getMyVars() {
        return get_object_vars($this);
    }
}
