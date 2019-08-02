<?php

class Configuracion2 extends Model {
    protected static $table = "t_configuracion2";
    private $id;
    private $razon_social;
    private $direccion;
    private $ubigeo;
    private $ruc;
    private $eliminar;
    function __construct($id, $razon_social, $direccion, $ubigeo, $ruc, $eliminar) {
        $this->id = $id;
        $this->razon_social = $razon_social;
        $this->direccion = $direccion;
        $this->ubigeo = $ubigeo;
        $this->ruc = $ruc;
        $this->eliminar = $eliminar;
    }

    function getId() {
        return $this->id;
    }

    function getRazon_social() {
        return $this->razon_social;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getUbigeo() {
        return $this->ubigeo;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getEliminar() {
        return $this->eliminar;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRazon_social($razon_social) {
        $this->razon_social = $razon_social;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setUbigeo($ubigeo) {
        $this->ubigeo = $ubigeo;
    }

    function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    function setEliminar($eliminar) {
        $this->eliminar = $eliminar;
    }

            public function getMyVars() {
        return get_object_vars($this);
    }
}
