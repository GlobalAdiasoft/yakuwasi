<?php

class Paquetes extends Model {
    protected static $table = "t_paquetes";
    private $id;
    private $id_articulo;
    private $descripcion;
    private $cantidad;
    private $precio;
    function __construct($id, $id_articulo, $descripcion, $cantidad, $precio) {
        $this->id = $id;
        $this->id_articulo = $id_articulo;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
    }
    function getId() {
        return $this->id;
    }

    function getId_articulo() {
        return $this->id_articulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_articulo($id_articulo) {
        $this->id_articulo = $id_articulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
