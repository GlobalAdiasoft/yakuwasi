<?php

class Cobranzas extends Model{
 protected static $table = "t_cobranzas";
    private $id;
    private $cobra_documento ;
    private $cobra_fecha_hora;
    private $cobra_usuario;
    private $cobra_monto;
    
    function __construct($id, $cobra_documento, $cobra_fecha_hora, $cobra_usuario, $cobra_monto) {
        $this->id = $id;
        $this->cobra_documento = $cobra_documento;
        $this->cobra_fecha_hora = $cobra_fecha_hora;
        $this->cobra_usuario = $cobra_usuario;
        $this->cobra_monto = $cobra_monto;
    }
    
    function getId() {
        return $this->id;
    }

    function getCobra_documento() {
        return $this->cobra_documento;
    }

    function getCobra_fecha_hora() {
        return $this->cobra_fecha_hora;
    }

    function getCobra_usuario() {
        return $this->cobra_usuario;
    }

    function getCobra_monto() {
        return $this->cobra_monto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCobra_documento($cobra_documento) {
        $this->cobra_documento = $cobra_documento;
    }

    function setCobra_fecha_hora($cobra_fecha_hora) {
        $this->cobra_fecha_hora = $cobra_fecha_hora;
    }

    function setCobra_usuario($cobra_usuario) {
        $this->cobra_usuario = $cobra_usuario;
    }

    function setCobra_monto($cobra_monto) {
        $this->cobra_monto = $cobra_monto;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}
