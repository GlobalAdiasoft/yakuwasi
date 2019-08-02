<?php

class Configuracion extends Model {
   protected static $table = "t_configuracion";
    private $id;
    private $archivo;
    function __construct($id, $archivo) {
        $this->id = $id;
        $this->archivo = $archivo;
    }
    function getId() {
        return $this->id;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
