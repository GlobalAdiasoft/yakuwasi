<?php

class Precios extends Model{
    protected static $table = "t_precios_art";
    private $id;
    private $id_lista;
    private $id_articulo;
    private $precio_compra_sinigv;
    private $precio_compra_conigv;
    private $precio_ventasinigv;
    private $precio_ventaconigv;
    private $min;
    private $max;
    function __construct($id, $id_lista, $id_articulo, $precio_compra_sinigv, $precio_compra_conigv, $precio_ventasinigv, $precio_ventaconigv, $min, $max) {
        $this->id = $id;
        $this->id_lista = $id_lista;
        $this->id_articulo = $id_articulo;
        $this->precio_compra_sinigv = $precio_compra_sinigv;
        $this->precio_compra_conigv = $precio_compra_conigv;
        $this->precio_ventasinigv = $precio_ventasinigv;
        $this->precio_ventaconigv = $precio_ventaconigv;
        $this->min = $min;
        $this->max = $max;
    }

    function getId() {
        return $this->id;
    }

    function getId_lista() {
        return $this->id_lista;
    }

    function getId_articulo() {
        return $this->id_articulo;
    }

    function getPrecio_compra_sinigv() {
        return $this->precio_compra_sinigv;
    }

    function getPrecio_compra_conigv() {
        return $this->precio_compra_conigv;
    }

    function getPrecio_ventasinigv() {
        return $this->precio_ventasinigv;
    }

    function getPrecio_ventaconigv() {
        return $this->precio_ventaconigv;
    }

    function getMin() {
        return $this->min;
    }

    function getMax() {
        return $this->max;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_lista($id_lista) {
        $this->id_lista = $id_lista;
    }

    function setId_articulo($id_articulo) {
        $this->id_articulo = $id_articulo;
    }

    function setPrecio_compra_sinigv($precio_compra_sinigv) {
        $this->precio_compra_sinigv = $precio_compra_sinigv;
    }

    function setPrecio_compra_conigv($precio_compra_conigv) {
        $this->precio_compra_conigv = $precio_compra_conigv;
    }

    function setPrecio_ventasinigv($precio_ventasinigv) {
        $this->precio_ventasinigv = $precio_ventasinigv;
    }

    function setPrecio_ventaconigv($precio_ventaconigv) {
        $this->precio_ventaconigv = $precio_ventaconigv;
    }

    function setMin($min) {
        $this->min = $min;
    }

    function setMax($max) {
        $this->max = $max;
    }

        
      public function getMyVars() {
        return get_object_vars($this);
    }
}
