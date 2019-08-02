<?php
class Usuario extends Model {
protected static $table = "t_usuarios";
private $id;
private $usu_nombres;
private $usu_apellidos;
private $usu_email;
private $usu_telefono;
private $usu_celular;
private $usu_dni;
private $usu_fechaalta;
private $usu_usuario;
private $usu_password;
private $usu_acceso;
private $usu_estado;

function __construct($id, $usu_nombres, $usu_apellidos, $usu_email, $usu_telefono, $usu_celular, $usu_dni, $usu_fechaalta, $usu_usuario, $usu_password, $usu_acceso, $usu_estado) {
    $this->id = $id;
    $this->usu_nombres = $usu_nombres;
    $this->usu_apellidos = $usu_apellidos;
    $this->usu_email = $usu_email;
    $this->usu_telefono = $usu_telefono;
    $this->usu_celular = $usu_celular;
    $this->usu_dni = $usu_dni;
    $this->usu_fechaalta = $usu_fechaalta;
    $this->usu_usuario = $usu_usuario;
    $this->usu_password = $usu_password;
    $this->usu_acceso = $usu_acceso;
    $this->usu_estado = $usu_estado;
}
function getId() {
    return $this->id;
}

function getUsu_nombres() {
    return $this->usu_nombres;
}

function getUsu_apellidos() {
    return $this->usu_apellidos;
}

function getUsu_email() {
    return $this->usu_email;
}

function getUsu_telefono() {
    return $this->usu_telefono;
}

function getUsu_celular() {
    return $this->usu_celular;
}

function getUsu_dni() {
    return $this->usu_dni;
}

function getUsu_fechaalta() {
    return $this->usu_fechaalta;
}

function getUsu_usuario() {
    return $this->usu_usuario;
}

function getUsu_password() {
    return $this->usu_password;
}

function getUsu_acceso() {
    return $this->usu_acceso;
}

function getUsu_estado() {
    return $this->usu_estado;
}

function setId($id) {
    $this->id = $id;
}

function setUsu_nombres($usu_nombres) {
    $this->usu_nombres = $usu_nombres;
}

function setUsu_apellidos($usu_apellidos) {
    $this->usu_apellidos = $usu_apellidos;
}

function setUsu_email($usu_email) {
    $this->usu_email = $usu_email;
}

function setUsu_telefono($usu_telefono) {
    $this->usu_telefono = $usu_telefono;
}

function setUsu_celular($usu_celular) {
    $this->usu_celular = $usu_celular;
}

function setUsu_dni($usu_dni) {
    $this->usu_dni = $usu_dni;
}

function setUsu_fechaalta($usu_fechaalta) {
    $this->usu_fechaalta = $usu_fechaalta;
}

function setUsu_usuario($usu_usuario) {
    $this->usu_usuario = $usu_usuario;
}

function setUsu_password($usu_password) {
    $this->usu_password = $usu_password;
}

function setUsu_acceso($usu_acceso) {
    $this->usu_acceso = $usu_acceso;
}

function setUsu_estado($usu_estado) {
    $this->usu_estado = $usu_estado;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}