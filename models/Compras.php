<?php
class Compras extends Model {
   protected static $table = "t_compras";
private $id;
private $factura;
private $proveedor;
private $producto;
private $cantidad;
private $moneda;
private $precio_compra_conigv;
private $precio_compra_sinigv;
private $precio_total;
private $fecha_hora;
private $usuario;

function __construct($id, $factura, $proveedor, $producto, $cantidad, $moneda, $precio_compra_conigv, $precio_compra_sinigv, $precio_total, $fecha_hora, $usuario) {
    $this->id = $id;
    $this->factura = $factura;
    $this->proveedor = $proveedor;
    $this->producto = $producto;
    $this->cantidad = $cantidad;
    $this->moneda = $moneda;
    $this->precio_compra_conigv = $precio_compra_conigv;
    $this->precio_compra_sinigv = $precio_compra_sinigv;
    $this->precio_total = $precio_total;
    $this->fecha_hora = $fecha_hora;
    $this->usuario = $usuario;
}

function getId() {
    return $this->id;
}

function getFactura() {
    return $this->factura;
}

function getProveedor() {
    return $this->proveedor;
}

function getProducto() {
    return $this->producto;
}

function getCantidad() {
    return $this->cantidad;
}

function getMoneda() {
    return $this->moneda;
}

function getPrecio_compra_conigv() {
    return $this->precio_compra_conigv;
}

function getPrecio_compra_sinigv() {
    return $this->precio_compra_sinigv;
}

function getPrecio_total() {
    return $this->precio_total;
}

function getFecha_hora() {
    return $this->fecha_hora;
}

function getUsuario() {
    return $this->usuario;
}

function setId($id) {
    $this->id = $id;
}

function setFactura($factura) {
    $this->factura = $factura;
}

function setProveedor($proveedor) {
    $this->proveedor = $proveedor;
}

function setProducto($producto) {
    $this->producto = $producto;
}

function setCantidad($cantidad) {
    $this->cantidad = $cantidad;
}

function setMoneda($moneda) {
    $this->moneda = $moneda;
}

function setPrecio_compra_conigv($precio_compra_conigv) {
    $this->precio_compra_conigv = $precio_compra_conigv;
}

function setPrecio_compra_sinigv($precio_compra_sinigv) {
    $this->precio_compra_sinigv = $precio_compra_sinigv;
}

function setPrecio_total($precio_total) {
    $this->precio_total = $precio_total;
}

function setFecha_hora($fecha_hora) {
    $this->fecha_hora = $fecha_hora;
}

function setUsuario($usuario) {
    $this->usuario = $usuario;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}
