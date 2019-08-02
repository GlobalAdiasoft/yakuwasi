<?php

class CajaNueva extends Model{
  protected static $table = "t_caja_nueva";
  private $id;
  private $usuario;
  private $fecha;
  private $hora;
  private $estado;
  private $monto_inicial;
  private $monto_final;
  function __construct($id, $usuario, $fecha, $hora, $estado, $monto_inicial, $monto_final) {
      $this->id = $id;
      $this->usuario = $usuario;
      $this->fecha = $fecha;
      $this->hora = $hora;
      $this->estado = $estado;
      $this->monto_inicial = $monto_inicial;
      $this->monto_final = $monto_final;
  }
  function getId() {
      return $this->id;
  }

  function getUsuario() {
      return $this->usuario;
  }

  function getFecha() {
      return $this->fecha;
  }

  function getHora() {
      return $this->hora;
  }

  function getEstado() {
      return $this->estado;
  }

  function getMonto_inicial() {
      return $this->monto_inicial;
  }

  function getMonto_final() {
      return $this->monto_final;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setUsuario($usuario) {
      $this->usuario = $usuario;
  }

  function setFecha($fecha) {
      $this->fecha = $fecha;
  }

  function setHora($hora) {
      $this->hora = $hora;
  }

  function setEstado($estado) {
      $this->estado = $estado;
  }

  function setMonto_inicial($monto_inicial) {
      $this->monto_inicial = $monto_inicial;
  }

  function setMonto_final($monto_final) {
      $this->monto_final = $monto_final;
  }

    public function getMyVars() {
        return get_object_vars($this);
    }
}
