<?php
class Facturas extends Model {
    protected static $table = "t_facturas";
private $id;
private $fac_correlativo;
private $fac_numero_factura;
private $fac_cli_id;
private $fact_fecha;
private $fact_usuario;
private $fact_moneda;
private $fact_tipocambio;
private $fact_sunat_transaccion;
private $fact_condiciones_pago;
private $fact_medio_pago;
private $fact_guia_serie;
private $fact_envio_sunat;
private $fact_pedido_usuario;
private $fact_pdf;
private $fact_xml;
private $fact_cdr;
private $descripcion;
private $estado;
private $fact_pdf_a;
private $fact_xml_a;
private $fact_cdr_a;

function __construct($id, $fac_correlativo, $fac_numero_factura, $fac_cli_id, $fact_fecha, $fact_usuario, $fact_moneda, $fact_tipocambio, $fact_sunat_transaccion, $fact_condiciones_pago, $fact_medio_pago, $fact_guia_serie, $fact_envio_sunat, $fact_pedido_usuario, $fact_pdf, $fact_xml, $fact_cdr, $descripcion, $estado, $fact_pdf_a, $fact_xml_a, $fact_cdr_a) {
    $this->id = $id;
    $this->fac_correlativo = $fac_correlativo;
    $this->fac_numero_factura = $fac_numero_factura;
    $this->fac_cli_id = $fac_cli_id;
    $this->fact_fecha = $fact_fecha;
    $this->fact_usuario = $fact_usuario;
    $this->fact_moneda = $fact_moneda;
    $this->fact_tipocambio = $fact_tipocambio;
    $this->fact_sunat_transaccion = $fact_sunat_transaccion;
    $this->fact_condiciones_pago = $fact_condiciones_pago;
    $this->fact_medio_pago = $fact_medio_pago;
    $this->fact_guia_serie = $fact_guia_serie;
    $this->fact_envio_sunat = $fact_envio_sunat;
    $this->fact_pedido_usuario = $fact_pedido_usuario;
    $this->fact_pdf = $fact_pdf;
    $this->fact_xml = $fact_xml;
    $this->fact_cdr = $fact_cdr;
    $this->descripcion = $descripcion;
    $this->estado = $estado;
    $this->fact_pdf_a = $fact_pdf_a;
    $this->fact_xml_a = $fact_xml_a;
    $this->fact_cdr_a = $fact_cdr_a;
}
function getId() {
    return $this->id;
}

function getFac_correlativo() {
    return $this->fac_correlativo;
}

function getFac_numero_factura() {
    return $this->fac_numero_factura;
}

function getFac_cli_id() {
    return $this->fac_cli_id;
}

function getFact_fecha() {
    return $this->fact_fecha;
}

function getFact_usuario() {
    return $this->fact_usuario;
}

function getFact_moneda() {
    return $this->fact_moneda;
}

function getFact_tipocambio() {
    return $this->fact_tipocambio;
}

function getFact_sunat_transaccion() {
    return $this->fact_sunat_transaccion;
}

function getFact_condiciones_pago() {
    return $this->fact_condiciones_pago;
}

function getFact_medio_pago() {
    return $this->fact_medio_pago;
}

function getFact_guia_serie() {
    return $this->fact_guia_serie;
}

function getFact_envio_sunat() {
    return $this->fact_envio_sunat;
}

function getFact_pedido_usuario() {
    return $this->fact_pedido_usuario;
}

function getFact_pdf() {
    return $this->fact_pdf;
}

function getFact_xml() {
    return $this->fact_xml;
}

function getFact_cdr() {
    return $this->fact_cdr;
}

function getDescripcion() {
    return $this->descripcion;
}

function getEstado() {
    return $this->estado;
}

function getFact_pdf_a() {
    return $this->fact_pdf_a;
}

function getFact_xml_a() {
    return $this->fact_xml_a;
}

function getFact_cdr_a() {
    return $this->fact_cdr_a;
}

function setId($id) {
    $this->id = $id;
}

function setFac_correlativo($fac_correlativo) {
    $this->fac_correlativo = $fac_correlativo;
}

function setFac_numero_factura($fac_numero_factura) {
    $this->fac_numero_factura = $fac_numero_factura;
}

function setFac_cli_id($fac_cli_id) {
    $this->fac_cli_id = $fac_cli_id;
}

function setFact_fecha($fact_fecha) {
    $this->fact_fecha = $fact_fecha;
}

function setFact_usuario($fact_usuario) {
    $this->fact_usuario = $fact_usuario;
}

function setFact_moneda($fact_moneda) {
    $this->fact_moneda = $fact_moneda;
}

function setFact_tipocambio($fact_tipocambio) {
    $this->fact_tipocambio = $fact_tipocambio;
}

function setFact_sunat_transaccion($fact_sunat_transaccion) {
    $this->fact_sunat_transaccion = $fact_sunat_transaccion;
}

function setFact_condiciones_pago($fact_condiciones_pago) {
    $this->fact_condiciones_pago = $fact_condiciones_pago;
}

function setFact_medio_pago($fact_medio_pago) {
    $this->fact_medio_pago = $fact_medio_pago;
}

function setFact_guia_serie($fact_guia_serie) {
    $this->fact_guia_serie = $fact_guia_serie;
}

function setFact_envio_sunat($fact_envio_sunat) {
    $this->fact_envio_sunat = $fact_envio_sunat;
}

function setFact_pedido_usuario($fact_pedido_usuario) {
    $this->fact_pedido_usuario = $fact_pedido_usuario;
}

function setFact_pdf($fact_pdf) {
    $this->fact_pdf = $fact_pdf;
}

function setFact_xml($fact_xml) {
    $this->fact_xml = $fact_xml;
}

function setFact_cdr($fact_cdr) {
    $this->fact_cdr = $fact_cdr;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFact_pdf_a($fact_pdf_a) {
    $this->fact_pdf_a = $fact_pdf_a;
}

function setFact_xml_a($fact_xml_a) {
    $this->fact_xml_a = $fact_xml_a;
}

function setFact_cdr_a($fact_cdr_a) {
    $this->fact_cdr_a = $fact_cdr_a;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}