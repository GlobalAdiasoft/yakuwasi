<?php


class Caja extends Model {
   protected static $table = "t_caja";
    private $id;
    private $total;
    private $pago;
    private $vuelto;
    private $usuario;
    private $fecha;
    private $hora;
    private $documento;
    private $numero;
    function __construct($id, $total, $pago, $vuelto, $usuario, $fecha, $hora, $documento, $numero) {
        $this->id = $id;
        $this->total = $total;
        $this->pago = $pago;
        $this->vuelto = $vuelto;
        $this->usuario = $usuario;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->documento = $documento;
        $this->numero = $numero;
    }
    function getId() {
        return $this->id;
    }

    function getTotal() {
        return $this->total;
    }

    function getPago() {
        return $this->pago;
    }

    function getVuelto() {
        return $this->vuelto;
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

    function getDocumento() {
        return $this->documento;
    }

    function getNumero() {
        return $this->numero;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setPago($pago) {
        $this->pago = $pago;
    }

    function setVuelto($vuelto) {
        $this->vuelto = $vuelto;
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

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

                        public function getMyVars() {
        return get_object_vars($this);
    }
}
