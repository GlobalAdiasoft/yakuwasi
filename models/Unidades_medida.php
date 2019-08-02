<?php
class Unidades_medida extends Model{
protected static $table = "t_unidadesmedida";
private $id;
private $uni_nombre;
private $uni_simbolo;
function __construct($id, $uni_nombre, $uni_simbolo) {
    $this->id = $id;
    $this->uni_nombre = $uni_nombre;
    $this->uni_simbolo = $uni_simbolo;
}
function getId() {
    return $this->id;
}

function getUni_nombre() {
    return $this->uni_nombre;
}

function getUni_simbolo() {
    return $this->uni_simbolo;
}

function setId($id) {
    $this->id = $id;
}

function setUni_nombre($uni_nombre) {
    $this->uni_nombre = $uni_nombre;
}

function setUni_simbolo($uni_simbolo) {
    $this->uni_simbolo = $uni_simbolo;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}
