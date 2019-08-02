<?php

class Marcas extends Model {
  protected static $table = "t_marcas";
   private $id;
   private $mar_codinterno;
   private $mar_nombre;
   private $mar_codusuario;
   function __construct($id, $mar_codinterno, $mar_nombre, $mar_codusuario) {
       $this->id = $id;
       $this->mar_codinterno = $mar_codinterno;
       $this->mar_nombre = $mar_nombre;
       $this->mar_codusuario = $mar_codusuario;
   }
   function getId() {
       return $this->id;
   }

   function getMar_codinterno() {
       return $this->mar_codinterno;
   }

   function getMar_nombre() {
       return $this->mar_nombre;
   }

   function getMar_codusuario() {
       return $this->mar_codusuario;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setMar_codinterno($mar_codinterno) {
       $this->mar_codinterno = $mar_codinterno;
   }

   function setMar_nombre($mar_nombre) {
       $this->mar_nombre = $mar_nombre;
   }

   function setMar_codusuario($mar_codusuario) {
       $this->mar_codusuario = $mar_codusuario;
   }

      public function getMyVars() {
        return get_object_vars($this);
    }
}
