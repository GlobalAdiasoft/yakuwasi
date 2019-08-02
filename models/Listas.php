<?php

class Listas extends Model{
    protected static $table = "t_listas";
    private $id;
    private $nombre;
    function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
