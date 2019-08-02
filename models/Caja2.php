<?php
class Caja2 extends Model {
    protected static $table = "t_caja2";
    private $id;
    private $usuario;
    private $fecha;
    private $hora;
    private $modulo;
    private $descripcion;
    private $tipo_pago;
    private $ingreso;
    private $salida;
    function __construct($id, $usuario, $fecha, $hora, $modulo, $descripcion, $tipo_pago, $ingreso, $salida) {
        $this->id          = $id;
        $this->usuario     = $usuario;
        $this->fecha       = $fecha;
        $this->hora        = $hora;
        $this->modulo      = $modulo;
        $this->descripcion = $descripcion;
        $this->tipo_pago   = $tipo_pago;
        $this->ingreso     = $ingreso;
        $this->salida      = $salida;
    }
    function getId() {
        return $this->id;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getHora() {
        return $this->hora;
    }
    function getModulo() {
        return $this->modulo;
    }
    function getDescripcion() {
        return $this->descripcion;
    }
    function getTipo_pago() {
        return $this->tipo_pago;
    }
    function getIngreso() {
        return $this->ingreso;
    }
    function getSalida() {
        return $this->salida;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setHora($hora) {
        $this->hora = $hora;
    }
    function setModulo($modulo) {
        $this->modulo = $modulo;
    }
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function setTipo_pago($tipo_pago) {
        $this->tipo_pago = $tipo_pago;
    }
    function setIngreso($ingreso) {
        $this->ingreso = $ingreso;
    }
    function setSalida($salida) {
        $this->salida = $salida;
    }
    public function getMyVars() {
        return get_object_vars($this);
    }
}
