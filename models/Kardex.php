<?php

class Kardex extends Model{
    protected static $table = "t_kardex";
    private $id;
    private $articulo;
    private $fecha;
    private $hora;
    private $ingreso;
    private $salida;
    private $saldo;
    private $usuario;
    private $documento;
    private $correlativo;
    private $proveedor;
    private $observaciones;
    private $tipo;
    function __construct($id, $articulo, $fecha, $hora, $ingreso, $salida, $saldo, $usuario, $documento, $correlativo, $proveedor, $observaciones, $tipo) {
        $this->id = $id;
        $this->articulo = $articulo;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ingreso = $ingreso;
        $this->salida = $salida;
        $this->saldo = $saldo;
        $this->usuario = $usuario;
        $this->documento = $documento;
        $this->correlativo = $correlativo;
        $this->proveedor = $proveedor;
        $this->observaciones = $observaciones;
        $this->tipo = $tipo;
    }
    function getId() {
        return $this->id;
    }

    function getArticulo() {
        return $this->articulo;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getIngreso() {
        return $this->ingreso;
    }

    function getSalida() {
        return $this->salida;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getDocumento() {
        return $this->documento;
    }

    function getCorrelativo() {
        return $this->correlativo;
    }

    function getProveedor() {
        return $this->proveedor;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setArticulo($articulo) {
        $this->articulo = $articulo;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setIngreso($ingreso) {
        $this->ingreso = $ingreso;
    }

    function setSalida($salida) {
        $this->salida = $salida;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setCorrelativo($correlativo) {
        $this->correlativo = $correlativo;
    }

    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }

}
