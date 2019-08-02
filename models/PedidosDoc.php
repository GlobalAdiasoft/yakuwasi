<?php

class PedidosDoc extends Model{
   protected static $table='t_pedidos_doc';
   private $id;
    private $ped_cod_ped;
    private $ped_tipo_doc;
    private $ped_usuario;
    private $ped_fecha;
    private $ped_cli_id;
    private $ped_aprobacion;
    private $ped_facturado;
    private $ped_moneda;
    private $ped_tipocambio;
    
    function __construct($id, $ped_cod_ped, $ped_tipo_doc, $ped_usuario, $ped_fecha, $ped_cli_id, $ped_aprobacion, $ped_facturado, $ped_moneda, $ped_tipocambio) {
        $this->id = $id;
        $this->ped_cod_ped = $ped_cod_ped;
        $this->ped_tipo_doc = $ped_tipo_doc;
        $this->ped_usuario = $ped_usuario;
        $this->ped_fecha = $ped_fecha;
        $this->ped_cli_id = $ped_cli_id;
        $this->ped_aprobacion = $ped_aprobacion;
        $this->ped_facturado = $ped_facturado;
        $this->ped_moneda = $ped_moneda;
        $this->ped_tipocambio = $ped_tipocambio;
    }
    function getId() {
        return $this->id;
    }

    function getPed_cod_ped() {
        return $this->ped_cod_ped;
    }

    function getPed_tipo_doc() {
        return $this->ped_tipo_doc;
    }

    function getPed_usuario() {
        return $this->ped_usuario;
    }

    function getPed_fecha() {
        return $this->ped_fecha;
    }

    function getPed_cli_id() {
        return $this->ped_cli_id;
    }

    function getPed_aprobacion() {
        return $this->ped_aprobacion;
    }

    function getPed_facturado() {
        return $this->ped_facturado;
    }

    function getPed_moneda() {
        return $this->ped_moneda;
    }

    function getPed_tipocambio() {
        return $this->ped_tipocambio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPed_cod_ped($ped_cod_ped) {
        $this->ped_cod_ped = $ped_cod_ped;
    }

    function setPed_tipo_doc($ped_tipo_doc) {
        $this->ped_tipo_doc = $ped_tipo_doc;
    }

    function setPed_usuario($ped_usuario) {
        $this->ped_usuario = $ped_usuario;
    }

    function setPed_fecha($ped_fecha) {
        $this->ped_fecha = $ped_fecha;
    }

    function setPed_cli_id($ped_cli_id) {
        $this->ped_cli_id = $ped_cli_id;
    }

    function setPed_aprobacion($ped_aprobacion) {
        $this->ped_aprobacion = $ped_aprobacion;
    }

    function setPed_facturado($ped_facturado) {
        $this->ped_facturado = $ped_facturado;
    }

    function setPed_moneda($ped_moneda) {
        $this->ped_moneda = $ped_moneda;
    }

    function setPed_tipocambio($ped_tipocambio) {
        $this->ped_tipocambio = $ped_tipocambio;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
