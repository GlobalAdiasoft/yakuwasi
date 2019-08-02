<?php

class Pedidosnotacredito extends Model {
        protected static $table='t_pedidos_nota_credito';
    private $id;
    private $ped_correlativo;
    private $ped_numero;
    private $ped_id_pro;
    private $ped_cod_pro;
    private $ped_nombre_pro;
    private $ped_cantidad;
    private $ped_valor_venta_sin_igv;
    private $ped_total;
    function __construct($id, $ped_correlativo, $ped_numero, $ped_id_pro, $ped_cod_pro, $ped_nombre_pro, $ped_cantidad, $ped_valor_venta_sin_igv, $ped_total) {
        $this->id = $id;
        $this->ped_correlativo = $ped_correlativo;
        $this->ped_numero = $ped_numero;
        $this->ped_id_pro = $ped_id_pro;
        $this->ped_cod_pro = $ped_cod_pro;
        $this->ped_nombre_pro = $ped_nombre_pro;
        $this->ped_cantidad = $ped_cantidad;
        $this->ped_valor_venta_sin_igv = $ped_valor_venta_sin_igv;
        $this->ped_total = $ped_total;
    }
    function getId() {
        return $this->id;
    }

    function getPed_correlativo() {
        return $this->ped_correlativo;
    }

    function getPed_numero() {
        return $this->ped_numero;
    }

    function getPed_id_pro() {
        return $this->ped_id_pro;
    }

    function getPed_cod_pro() {
        return $this->ped_cod_pro;
    }

    function getPed_nombre_pro() {
        return $this->ped_nombre_pro;
    }

    function getPed_cantidad() {
        return $this->ped_cantidad;
    }

    function getPed_valor_venta_sin_igv() {
        return $this->ped_valor_venta_sin_igv;
    }

    function getPed_total() {
        return $this->ped_total;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPed_correlativo($ped_correlativo) {
        $this->ped_correlativo = $ped_correlativo;
    }

    function setPed_numero($ped_numero) {
        $this->ped_numero = $ped_numero;
    }

    function setPed_id_pro($ped_id_pro) {
        $this->ped_id_pro = $ped_id_pro;
    }

    function setPed_cod_pro($ped_cod_pro) {
        $this->ped_cod_pro = $ped_cod_pro;
    }

    function setPed_nombre_pro($ped_nombre_pro) {
        $this->ped_nombre_pro = $ped_nombre_pro;
    }

    function setPed_cantidad($ped_cantidad) {
        $this->ped_cantidad = $ped_cantidad;
    }

    function setPed_valor_venta_sin_igv($ped_valor_venta_sin_igv) {
        $this->ped_valor_venta_sin_igv = $ped_valor_venta_sin_igv;
    }

    function setPed_total($ped_total) {
        $this->ped_total = $ped_total;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
