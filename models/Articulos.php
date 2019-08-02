<?php

class Articulos extends Model {
   protected static $table = "t_articulos";
    private $id;
    private $art_familia;
    private $art_codusuario;
    private $art_fechaalta;
    private $art_nombre;
    private $art_fabricante;
    private $art_especificaciontecnica;
    private $art_stockminimo;
    private $art_descripcion;
    private $art_imagen;
    private $art_marca;
    private $art_unidadmedida;
    private $art_estado;
    private $art_proveedor;
    private $art_impuesto;
    
    private $art_ganancia;
    private $art_precio_compra_sinigv;
    private $art_precio_compra_conigv;
    private $art_precio_ventasinigv;
    private $art_precio_ventaconigv;
    
    private $art_codbarras;
    private $art_codigo;
    private $art_stock;
    private $art_ubicacion;
    private $art_moneda;
    
    function __construct($id, $art_familia, $art_codusuario, $art_fechaalta, $art_nombre, $art_fabricante, $art_especificaciontecnica, $art_stockminimo, $art_descripcion, $art_imagen, $art_marca, $art_unidadmedida, $art_estado, $art_proveedor, $art_impuesto, $art_ganancia, $art_precio_compra_sinigv, $art_precio_compra_conigv, $art_precio_ventasinigv, $art_precio_ventaconigv, $art_codbarras, $art_codigo, $art_stock, $art_ubicacion, $art_moneda) {
        $this->id = $id;
        $this->art_familia = $art_familia;
        $this->art_codusuario = $art_codusuario;
        $this->art_fechaalta = $art_fechaalta;
        $this->art_nombre = $art_nombre;
        $this->art_fabricante = $art_fabricante;
        $this->art_especificaciontecnica = $art_especificaciontecnica;
        $this->art_stockminimo = $art_stockminimo;
        $this->art_descripcion = $art_descripcion;
        $this->art_imagen = $art_imagen;
        $this->art_marca = $art_marca;
        $this->art_unidadmedida = $art_unidadmedida;
        $this->art_estado = $art_estado;
        $this->art_proveedor = $art_proveedor;
        $this->art_impuesto = $art_impuesto;
        $this->art_ganancia = $art_ganancia;
        $this->art_precio_compra_sinigv = $art_precio_compra_sinigv;
        $this->art_precio_compra_conigv = $art_precio_compra_conigv;
        $this->art_precio_ventasinigv = $art_precio_ventasinigv;
        $this->art_precio_ventaconigv = $art_precio_ventaconigv;
        $this->art_codbarras = $art_codbarras;
        $this->art_codigo = $art_codigo;
        $this->art_stock = $art_stock;
        $this->art_ubicacion = $art_ubicacion;
        $this->art_moneda = $art_moneda;
    }

    function getId() {
        return $this->id;
    }

    function getArt_familia() {
        return $this->art_familia;
    }

    function getArt_codusuario() {
        return $this->art_codusuario;
    }

    function getArt_fechaalta() {
        return $this->art_fechaalta;
    }

    function getArt_nombre() {
        return $this->art_nombre;
    }

    function getArt_fabricante() {
        return $this->art_fabricante;
    }

    function getArt_especificaciontecnica() {
        return $this->art_especificaciontecnica;
    }

    function getArt_stockminimo() {
        return $this->art_stockminimo;
    }

    function getArt_descripcion() {
        return $this->art_descripcion;
    }

    function getArt_imagen() {
        return $this->art_imagen;
    }

    function getArt_marca() {
        return $this->art_marca;
    }

    function getArt_unidadmedida() {
        return $this->art_unidadmedida;
    }

    function getArt_estado() {
        return $this->art_estado;
    }

    function getArt_proveedor() {
        return $this->art_proveedor;
    }

    function getArt_impuesto() {
        return $this->art_impuesto;
    }

    function getArt_ganancia() {
        return $this->art_ganancia;
    }

    function getArt_precio_compra_sinigv() {
        return $this->art_precio_compra_sinigv;
    }

    function getArt_precio_compra_conigv() {
        return $this->art_precio_compra_conigv;
    }

    function getArt_precio_ventasinigv() {
        return $this->art_precio_ventasinigv;
    }

    function getArt_precio_ventaconigv() {
        return $this->art_precio_ventaconigv;
    }

    function getArt_codbarras() {
        return $this->art_codbarras;
    }

    function getArt_codigo() {
        return $this->art_codigo;
    }

    function getArt_stock() {
        return $this->art_stock;
    }

    function getArt_ubicacion() {
        return $this->art_ubicacion;
    }

    function getArt_moneda() {
        return $this->art_moneda;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setArt_familia($art_familia) {
        $this->art_familia = $art_familia;
    }

    function setArt_codusuario($art_codusuario) {
        $this->art_codusuario = $art_codusuario;
    }

    function setArt_fechaalta($art_fechaalta) {
        $this->art_fechaalta = $art_fechaalta;
    }

    function setArt_nombre($art_nombre) {
        $this->art_nombre = $art_nombre;
    }

    function setArt_fabricante($art_fabricante) {
        $this->art_fabricante = $art_fabricante;
    }

    function setArt_especificaciontecnica($art_especificaciontecnica) {
        $this->art_especificaciontecnica = $art_especificaciontecnica;
    }

    function setArt_stockminimo($art_stockminimo) {
        $this->art_stockminimo = $art_stockminimo;
    }

    function setArt_descripcion($art_descripcion) {
        $this->art_descripcion = $art_descripcion;
    }

    function setArt_imagen($art_imagen) {
        $this->art_imagen = $art_imagen;
    }

    function setArt_marca($art_marca) {
        $this->art_marca = $art_marca;
    }

    function setArt_unidadmedida($art_unidadmedida) {
        $this->art_unidadmedida = $art_unidadmedida;
    }

    function setArt_estado($art_estado) {
        $this->art_estado = $art_estado;
    }

    function setArt_proveedor($art_proveedor) {
        $this->art_proveedor = $art_proveedor;
    }

    function setArt_impuesto($art_impuesto) {
        $this->art_impuesto = $art_impuesto;
    }

    function setArt_ganancia($art_ganancia) {
        $this->art_ganancia = $art_ganancia;
    }

    function setArt_precio_compra_sinigv($art_precio_compra_sinigv) {
        $this->art_precio_compra_sinigv = $art_precio_compra_sinigv;
    }

    function setArt_precio_compra_conigv($art_precio_compra_conigv) {
        $this->art_precio_compra_conigv = $art_precio_compra_conigv;
    }

    function setArt_precio_ventasinigv($art_precio_ventasinigv) {
        $this->art_precio_ventasinigv = $art_precio_ventasinigv;
    }

    function setArt_precio_ventaconigv($art_precio_ventaconigv) {
        $this->art_precio_ventaconigv = $art_precio_ventaconigv;
    }

    function setArt_codbarras($art_codbarras) {
        $this->art_codbarras = $art_codbarras;
    }

    function setArt_codigo($art_codigo) {
        $this->art_codigo = $art_codigo;
    }

    function setArt_stock($art_stock) {
        $this->art_stock = $art_stock;
    }

    function setArt_ubicacion($art_ubicacion) {
        $this->art_ubicacion = $art_ubicacion;
    }

    function setArt_moneda($art_moneda) {
        $this->art_moneda = $art_moneda;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
