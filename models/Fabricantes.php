<?php

class Fabricantes extends Model{
   protected static $table = "t_fabricantes";
   private $id;
   private $fabri_codinterno;
   private $fabri_nombre;
   private $fabri_codusuario;
   function __construct($id, $fabri_codinterno, $fabri_nombre, $fabri_codusuario) {
       $this->id = $id;
       $this->fabri_codinterno = $fabri_codinterno;
       $this->fabri_nombre = $fabri_nombre;
       $this->fabri_codusuario = $fabri_codusuario;
   }

   function getId() {
       return $this->id;
   }

   function getFabri_codinterno() {
       return $this->fabri_codinterno;
   }

   function getFabri_nombre() {
       return $this->fabri_nombre;
   }

   function getFabri_codusuario() {
       return $this->fabri_codusuario;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setFabri_codinterno($fabri_codinterno) {
       $this->fabri_codinterno = $fabri_codinterno;
   }

   function setFabri_nombre($fabri_nombre) {
       $this->fabri_nombre = $fabri_nombre;
   }

   function setFabri_codusuario($fabri_codusuario) {
       $this->fabri_codusuario = $fabri_codusuario;
   }

   

      public function getMyVars() {
        return get_object_vars($this);
    }
}
