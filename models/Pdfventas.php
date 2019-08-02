<?php

class Pdfventas extends Model{
     protected static $table = "t_pdfventas";
   private $id;
    private $correlativo;
     private $numero;
      private $json;
   
      function __construct($id, $correlativo, $numero, $json) {
          $this->id = $id;
          $this->correlativo = $correlativo;
          $this->numero = $numero;
          $this->json = $json;
      }
      function getId() {
          return $this->id;
      }

      function getCorrelativo() {
          return $this->correlativo;
      }

      function getNumero() {
          return $this->numero;
      }

      function getJson() {
          return $this->json;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setCorrelativo($correlativo) {
          $this->correlativo = $correlativo;
      }

      function setNumero($numero) {
          $this->numero = $numero;
      }

      function setJson($json) {
          $this->json = $json;
      }

            public function getMyVars() {
        return get_object_vars($this);
    }
}
