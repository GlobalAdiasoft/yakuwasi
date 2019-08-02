<?php

class Gastos extends Model{
    protected static $table = "t_gastos";
   private $id;
   private $fecha;
   private $impuesto;
   private $costo_total;
   private $costo;
   private $porcentaje_impuesto;
   private $descripcion;
   private $usuario;
   private $razon;
   private $categoria;
   private $documento;
   private $correlativo;
   private $numero;
   private $proveedor;
   private $aprobado;
   private $nota;
   private $retiro;
   private $condicion;
   function __construct($id, $fecha, $impuesto, $costo_total, $costo, $porcentaje_impuesto, $descripcion, $usuario, $razon, $categoria, $documento, $correlativo, $numero, $proveedor, $aprobado, $nota, $retiro, $condicion) {
       $this->id = $id;
       $this->fecha = $fecha;
       $this->impuesto = $impuesto;
       $this->costo_total = $costo_total;
       $this->costo = $costo;
       $this->porcentaje_impuesto = $porcentaje_impuesto;
       $this->descripcion = $descripcion;
       $this->usuario = $usuario;
       $this->razon = $razon;
       $this->categoria = $categoria;
       $this->documento = $documento;
       $this->correlativo = $correlativo;
       $this->numero = $numero;
       $this->proveedor = $proveedor;
       $this->aprobado = $aprobado;
       $this->nota = $nota;
       $this->retiro = $retiro;
       $this->condicion = $condicion;
   }
   function getId() {
       return $this->id;
   }

   function getFecha() {
       return $this->fecha;
   }

   function getImpuesto() {
       return $this->impuesto;
   }

   function getCosto_total() {
       return $this->costo_total;
   }

   function getCosto() {
       return $this->costo;
   }

   function getPorcentaje_impuesto() {
       return $this->porcentaje_impuesto;
   }

   function getDescripcion() {
       return $this->descripcion;
   }

   function getUsuario() {
       return $this->usuario;
   }

   function getRazon() {
       return $this->razon;
   }

   function getCategoria() {
       return $this->categoria;
   }

   function getDocumento() {
       return $this->documento;
   }

   function getCorrelativo() {
       return $this->correlativo;
   }

   function getNumero() {
       return $this->numero;
   }

   function getProveedor() {
       return $this->proveedor;
   }

   function getAprobado() {
       return $this->aprobado;
   }

   function getNota() {
       return $this->nota;
   }

   function getRetiro() {
       return $this->retiro;
   }

   function getCondicion() {
       return $this->condicion;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setFecha($fecha) {
       $this->fecha = $fecha;
   }

   function setImpuesto($impuesto) {
       $this->impuesto = $impuesto;
   }

   function setCosto_total($costo_total) {
       $this->costo_total = $costo_total;
   }

   function setCosto($costo) {
       $this->costo = $costo;
   }

   function setPorcentaje_impuesto($porcentaje_impuesto) {
       $this->porcentaje_impuesto = $porcentaje_impuesto;
   }

   function setDescripcion($descripcion) {
       $this->descripcion = $descripcion;
   }

   function setUsuario($usuario) {
       $this->usuario = $usuario;
   }

   function setRazon($razon) {
       $this->razon = $razon;
   }

   function setCategoria($categoria) {
       $this->categoria = $categoria;
   }

   function setDocumento($documento) {
       $this->documento = $documento;
   }

   function setCorrelativo($correlativo) {
       $this->correlativo = $correlativo;
   }

   function setNumero($numero) {
       $this->numero = $numero;
   }

   function setProveedor($proveedor) {
       $this->proveedor = $proveedor;
   }

   function setAprobado($aprobado) {
       $this->aprobado = $aprobado;
   }

   function setNota($nota) {
       $this->nota = $nota;
   }

   function setRetiro($retiro) {
       $this->retiro = $retiro;
   }

   function setCondicion($condicion) {
       $this->condicion = $condicion;
   }

   
   public function getMyVars(){
           return get_object_vars($this);
    }
}
