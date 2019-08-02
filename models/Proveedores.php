<?php

class Proveedores extends Model {
      protected static $table = "t_proveedores";
      private $id;
      private $pro_ruc;
      private $pro_razonsocial;
      private $pro_sectorcomercial;
      private $pro_ubigeo;
      private $pro_direccion;
    
      private $pro_telefono;
      private $pro_correo;
      private $pro_ctasoles;
      private $pro_ctadolares;
      function __construct($id, $pro_ruc, $pro_razonsocial, $pro_sectorcomercial, $pro_ubigeo, $pro_direccion, $pro_telefono, $pro_correo, $pro_ctasoles, $pro_ctadolares) {
          $this->id = $id;
          $this->pro_ruc = $pro_ruc;
          $this->pro_razonsocial = $pro_razonsocial;
          $this->pro_sectorcomercial = $pro_sectorcomercial;
          $this->pro_ubigeo = $pro_ubigeo;
          $this->pro_direccion = $pro_direccion;
          
          $this->pro_telefono = $pro_telefono;
          $this->pro_correo = $pro_correo;
          $this->pro_ctasoles = $pro_ctasoles;
          $this->pro_ctadolares = $pro_ctadolares;
      }
      function getId() {
          return $this->id;
      }

      function getPro_ruc() {
          return $this->pro_ruc;
      }

      function getPro_razonsocial() {
          return $this->pro_razonsocial;
      }

      function getPro_sectorcomercial() {
          return $this->pro_sectorcomercial;
      }

      function getPro_ubigeo() {
          return $this->pro_ubigeo;
      }

      function getPro_direccion() {
          return $this->pro_direccion;
      }

     

      function getPro_telefono() {
          return $this->pro_telefono;
      }

      function getPro_correo() {
          return $this->pro_correo;
      }

      function getPro_ctasoles() {
          return $this->pro_ctasoles;
      }

      function getPro_ctadolares() {
          return $this->pro_ctadolares;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setPro_ruc($pro_ruc) {
          $this->pro_ruc = $pro_ruc;
      }

      function setPro_razonsocial($pro_razonsocial) {
          $this->pro_razonsocial = $pro_razonsocial;
      }

      function setPro_sectorcomercial($pro_sectorcomercial) {
          $this->pro_sectorcomercial = $pro_sectorcomercial;
      }

      function setPro_ubigeo($pro_ubigeo) {
          $this->pro_ubigeo = $pro_ubigeo;
      }

      function setPro_direccion($pro_direccion) {
          $this->pro_direccion = $pro_direccion;
      }

      

      function setPro_telefono($pro_telefono) {
          $this->pro_telefono = $pro_telefono;
      }

      function setPro_correo($pro_correo) {
          $this->pro_correo = $pro_correo;
      }

      function setPro_ctasoles($pro_ctasoles) {
          $this->pro_ctasoles = $pro_ctasoles;
      }

      function setPro_ctadolares($pro_ctadolares) {
          $this->pro_ctadolares = $pro_ctadolares;
      }

            public function getMyVars() {
        return get_object_vars($this);
    }
}
