<?php

class Boletas extends Model
{
    protected static $table = "t_boletas";
    private $id;
    private $bol_correlativo;
    private $bol_numero_boleta;
    private $bol_cli_id;
    private $bol_fecha;
    private $bol_usuario;
    private $bol_moneda;
    private $bol_tipocambio;
    private $bol_sunat_transaccion;
    private $bol_condiciones_pago;
    private $bol_medio_pago;
    private $bol_envio_sunat;
    private $bol_pedido_usuario;
    private $bol_pdf;
    private $bol_xml;
    private $bol_cdr;
    private $descripcion;
    private $estado;
    private $bol_pdf_a;  
    private $bol_xml_a;
    private $bol_cdr_a;
    function __construct($id, $bol_correlativo, $bol_numero_boleta, $bol_cli_id, $bol_fecha, $bol_usuario, $bol_moneda, $bol_tipocambio, $bol_sunat_transaccion, $bol_condiciones_pago, $bol_medio_pago, $bol_envio_sunat, $bol_pedido_usuario, $bol_pdf, $bol_xml, $bol_cdr, $descripcion, $estado, $bol_pdf_a, $bol_xml_a, $bol_cdr_a) {
        $this->id = $id;
        $this->bol_correlativo = $bol_correlativo;
        $this->bol_numero_boleta = $bol_numero_boleta;
        $this->bol_cli_id = $bol_cli_id;
        $this->bol_fecha = $bol_fecha;
        $this->bol_usuario = $bol_usuario;
        $this->bol_moneda = $bol_moneda;
        $this->bol_tipocambio = $bol_tipocambio;
        $this->bol_sunat_transaccion = $bol_sunat_transaccion;
        $this->bol_condiciones_pago = $bol_condiciones_pago;
        $this->bol_medio_pago = $bol_medio_pago;
        $this->bol_envio_sunat = $bol_envio_sunat;
        $this->bol_pedido_usuario = $bol_pedido_usuario;
        $this->bol_pdf = $bol_pdf;
        $this->bol_xml = $bol_xml;
        $this->bol_cdr = $bol_cdr;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->bol_pdf_a = $bol_pdf_a;
        $this->bol_xml_a = $bol_xml_a;
        $this->bol_cdr_a = $bol_cdr_a;
    }
    function getId() {
        return $this->id;
    }

    function getBol_correlativo() {
        return $this->bol_correlativo;
    }

    function getBol_numero_boleta() {
        return $this->bol_numero_boleta;
    }

    function getBol_cli_id() {
        return $this->bol_cli_id;
    }

    function getBol_fecha() {
        return $this->bol_fecha;
    }

    function getBol_usuario() {
        return $this->bol_usuario;
    }

    function getBol_moneda() {
        return $this->bol_moneda;
    }

    function getBol_tipocambio() {
        return $this->bol_tipocambio;
    }

    function getBol_sunat_transaccion() {
        return $this->bol_sunat_transaccion;
    }

    function getBol_condiciones_pago() {
        return $this->bol_condiciones_pago;
    }

    function getBol_medio_pago() {
        return $this->bol_medio_pago;
    }

    function getBol_envio_sunat() {
        return $this->bol_envio_sunat;
    }

    function getBol_pedido_usuario() {
        return $this->bol_pedido_usuario;
    }

    function getBol_pdf() {
        return $this->bol_pdf;
    }

    function getBol_xml() {
        return $this->bol_xml;
    }

    function getBol_cdr() {
        return $this->bol_cdr;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getBol_pdf_a() {
        return $this->bol_pdf_a;
    }

    function getBol_xml_a() {
        return $this->bol_xml_a;
    }

    function getBol_cdr_a() {
        return $this->bol_cdr_a;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBol_correlativo($bol_correlativo) {
        $this->bol_correlativo = $bol_correlativo;
    }

    function setBol_numero_boleta($bol_numero_boleta) {
        $this->bol_numero_boleta = $bol_numero_boleta;
    }

    function setBol_cli_id($bol_cli_id) {
        $this->bol_cli_id = $bol_cli_id;
    }

    function setBol_fecha($bol_fecha) {
        $this->bol_fecha = $bol_fecha;
    }

    function setBol_usuario($bol_usuario) {
        $this->bol_usuario = $bol_usuario;
    }

    function setBol_moneda($bol_moneda) {
        $this->bol_moneda = $bol_moneda;
    }

    function setBol_tipocambio($bol_tipocambio) {
        $this->bol_tipocambio = $bol_tipocambio;
    }

    function setBol_sunat_transaccion($bol_sunat_transaccion) {
        $this->bol_sunat_transaccion = $bol_sunat_transaccion;
    }

    function setBol_condiciones_pago($bol_condiciones_pago) {
        $this->bol_condiciones_pago = $bol_condiciones_pago;
    }

    function setBol_medio_pago($bol_medio_pago) {
        $this->bol_medio_pago = $bol_medio_pago;
    }

    function setBol_envio_sunat($bol_envio_sunat) {
        $this->bol_envio_sunat = $bol_envio_sunat;
    }

    function setBol_pedido_usuario($bol_pedido_usuario) {
        $this->bol_pedido_usuario = $bol_pedido_usuario;
    }

    function setBol_pdf($bol_pdf) {
        $this->bol_pdf = $bol_pdf;
    }

    function setBol_xml($bol_xml) {
        $this->bol_xml = $bol_xml;
    }

    function setBol_cdr($bol_cdr) {
        $this->bol_cdr = $bol_cdr;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setBol_pdf_a($bol_pdf_a) {
        $this->bol_pdf_a = $bol_pdf_a;
    }

    function setBol_xml_a($bol_xml_a) {
        $this->bol_xml_a = $bol_xml_a;
    }

    function setBol_cdr_a($bol_cdr_a) {
        $this->bol_cdr_a = $bol_cdr_a;
    }

        public function getMyVars()
    {
        return get_object_vars($this);
    }
}
