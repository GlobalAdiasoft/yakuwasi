<?php
class Clientes extends Model {
    protected static $table = "t_clientes";
    private $id;
    private $cli_nombre;
    private $cli_ubigeo;
    private $cli_direccion;
    private $cli_telefono;
   
    private $cli_email;
    private $cli_web;
    private $cli_ruc;
    private $cli_dni;
    private $cli_observacion;
    private $tipo;
    function __construct($id, $cli_nombre, $cli_ubigeo, $cli_direccion, $cli_telefono, $cli_email, $cli_web, $cli_ruc, $cli_dni, $cli_observacion, $tipo) {
        $this->id = $id;
        $this->cli_nombre = $cli_nombre;
        $this->cli_ubigeo = $cli_ubigeo;
        $this->cli_direccion = $cli_direccion;
        $this->cli_telefono = $cli_telefono;
        $this->cli_email = $cli_email;
        $this->cli_web = $cli_web;
        $this->cli_ruc = $cli_ruc;
        $this->cli_dni = $cli_dni;
        $this->cli_observacion = $cli_observacion;
        $this->tipo = $tipo;
    }
    function getId() {
        return $this->id;
    }

    function getCli_nombre() {
        return $this->cli_nombre;
    }

    function getCli_ubigeo() {
        return $this->cli_ubigeo;
    }

    function getCli_direccion() {
        return $this->cli_direccion;
    }

    function getCli_telefono() {
        return $this->cli_telefono;
    }

    function getCli_email() {
        return $this->cli_email;
    }

    function getCli_web() {
        return $this->cli_web;
    }

    function getCli_ruc() {
        return $this->cli_ruc;
    }

    function getCli_dni() {
        return $this->cli_dni;
    }

    function getCli_observacion() {
        return $this->cli_observacion;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCli_nombre($cli_nombre) {
        $this->cli_nombre = $cli_nombre;
    }

    function setCli_ubigeo($cli_ubigeo) {
        $this->cli_ubigeo = $cli_ubigeo;
    }

    function setCli_direccion($cli_direccion) {
        $this->cli_direccion = $cli_direccion;
    }

    function setCli_telefono($cli_telefono) {
        $this->cli_telefono = $cli_telefono;
    }

    function setCli_email($cli_email) {
        $this->cli_email = $cli_email;
    }

    function setCli_web($cli_web) {
        $this->cli_web = $cli_web;
    }

    function setCli_ruc($cli_ruc) {
        $this->cli_ruc = $cli_ruc;
    }

    function setCli_dni($cli_dni) {
        $this->cli_dni = $cli_dni;
    }

    function setCli_observacion($cli_observacion) {
        $this->cli_observacion = $cli_observacion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        public function getMyVars() {
        return get_object_vars($this);
    }
}