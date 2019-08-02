<?php

class Tipocambio extends Model{
     protected static $table = "t_cambio";
private $id;
private $cam_fecha;
private $cam_compra;
private $cam_venta;
function __construct($id, $cam_fecha, $cam_compra, $cam_venta) {
    $this->id = $id;
    $this->cam_fecha = $cam_fecha;
    $this->cam_compra = $cam_compra;
    $this->cam_venta = $cam_venta;
}
function getId() {
    return $this->id;
}

function getCam_fecha() {
    return $this->cam_fecha;
}

function getCam_compra() {
    return $this->cam_compra;
}

function getCam_venta() {
    return $this->cam_venta;
}

function setId($id) {
    $this->id = $id;
}

function setCam_fecha($cam_fecha) {
    $this->cam_fecha = $cam_fecha;
}

function setCam_compra($cam_compra) {
    $this->cam_compra = $cam_compra;
}

function setCam_venta($cam_venta) {
    $this->cam_venta = $cam_venta;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}
