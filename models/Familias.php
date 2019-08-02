<?php

class Familias extends Model{
   protected static $table = "t_familias";
   private $id;
   private $fam_codinterno;
   private $fam_nombre;
   private $fam_codusuario;
   function __construct($id, $fam_codinterno, $fam_nombre, $fam_codusuario) {
       $this->id = $id;
       $this->fam_codinterno = $fam_codinterno;
       $this->fam_nombre = $fam_nombre;
       $this->fam_codusuario = $fam_codusuario;
   }
   function getId() {
       return $this->id;
   }

   function getFam_codinterno() {
       return $this->fam_codinterno;
   }

   function getFam_nombre() {
       return $this->fam_nombre;
   }

   function getFam_codusuario() {
       return $this->fam_codusuario;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setFam_codinterno($fam_codinterno) {
       $this->fam_codinterno = $fam_codinterno;
   }

   function setFam_nombre($fam_nombre) {
       $this->fam_nombre = $fam_nombre;
   }

   function setFam_codusuario($fam_codusuario) {
       $this->fam_codusuario = $fam_codusuario;
   }

      public function getMyVars() {
        return get_object_vars($this);
    }
}
