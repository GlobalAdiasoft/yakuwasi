<?php
class Desc_e extends Model {
    protected static $table = "desc_venta";
private $id;
private $id_venta;
private $llevar;
private $num;
private $codigo;
private $descripcion;
private $precio_unitario;
private $cantidad;
private $dscto;
private $importe_neto;
private $estado_e;
function __construct($id, $id_venta, $llevar, $num, $codigo, $descripcion, $precio_unitario, $cantidad, $dscto, $importe_neto, $estado_e) {
    $this->id = $id;
    $this->id_venta = $id_venta;
    $this->llevar = $llevar;
    $this->num = $num;
    $this->codigo = $codigo;
    $this->descripcion = $descripcion;
    $this->precio_unitario = $precio_unitario;
    $this->cantidad = $cantidad;
    $this->dscto = $dscto;
    $this->importe_neto = $importe_neto;
    $this->estado_e = $estado_e;
}
function getId() {
    return $this->id;
}

function getId_venta() {
    return $this->id_venta;
}

function getLlevar() {
    return $this->llevar;
}

function getNum() {
    return $this->num;
}

function getCodigo() {
    return $this->codigo;
}

function getDescripcion() {
    return $this->descripcion;
}

function getPrecio_unitario() {
    return $this->precio_unitario;
}

function getCantidad() {
    return $this->cantidad;
}

function getDscto() {
    return $this->dscto;
}

function getImporte_neto() {
    return $this->importe_neto;
}

function getEstado_e() {
    return $this->estado_e;
}

function setId($id) {
    $this->id = $id;
}

function setId_venta($id_venta) {
    $this->id_venta = $id_venta;
}

function setLlevar($llevar) {
    $this->llevar = $llevar;
}

function setNum($num) {
    $this->num = $num;
}

function setCodigo($codigo) {
    $this->codigo = $codigo;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

function setPrecio_unitario($precio_unitario) {
    $this->precio_unitario = $precio_unitario;
}

function setCantidad($cantidad) {
    $this->cantidad = $cantidad;
}

function setDscto($dscto) {
    $this->dscto = $dscto;
}

function setImporte_neto($importe_neto) {
    $this->importe_neto = $importe_neto;
}

function setEstado_e($estado_e) {
    $this->estado_e = $estado_e;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}
