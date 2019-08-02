<?php
class Visitas extends Model {
   protected static $table = "t_visitas";
private $id;
private $visitas_ip;
private $visitas_idioma;
function __construct($id, $visitas_ip, $visitas_idioma) {
    $this->id = $id;
    $this->visitas_ip = $visitas_ip;
    $this->visitas_idioma = $visitas_idioma;
}
static function getTable() {
    return self::$table;
}

function getId() {
    return $this->id;
}

function getVisitas_ip() {
    return $this->visitas_ip;
}

function getVisitas_idioma() {
    return $this->visitas_idioma;
}

static function setTable($table) {
    self::$table = $table;
}

function setId($id) {
    $this->id = $id;
}

function setVisitas_ip($visitas_ip) {
    $this->visitas_ip = $visitas_ip;
}

function setVisitas_idioma($visitas_idioma) {
    $this->visitas_idioma = $visitas_idioma;
}

   public function getMyVars() {
        return get_object_vars($this);
    }
}
