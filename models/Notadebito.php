<?php

class Notadebito extends Model{
     protected static $table = "t_nota_d";
      private $id;
      private $nota_fecha;
      private $nota_correlativo;
      private $nota_numero;
      private $nota_moneda;
      private $nota_tipocambio;
      private $nota_sunat_transaccion;
      private $nota_fecha_vencimiento;
      private $nota_cli_id;
      private $nota_documento_modificar;
      private $nota_numero_modificar;
      private $nota_tipo;
      private $nota_correlativo_numero;
       private $nota_envio_sunat;
      private $nota_pdf;
      private $nota_xml;
      private $nota_cdr;
      function __construct($id, $nota_fecha, $nota_correlativo, $nota_numero, $nota_moneda, $nota_tipocambio, $nota_sunat_transaccion, $nota_fecha_vencimiento, $nota_cli_id, $nota_documento_modificar, $nota_numero_modificar, $nota_tipo, $nota_correlativo_numero, $nota_envio_sunat, $nota_pdf, $nota_xml, $nota_cdr) {
          $this->id = $id;
          $this->nota_fecha = $nota_fecha;
          $this->nota_correlativo = $nota_correlativo;
          $this->nota_numero = $nota_numero;
          $this->nota_moneda = $nota_moneda;
          $this->nota_tipocambio = $nota_tipocambio;
          $this->nota_sunat_transaccion = $nota_sunat_transaccion;
          $this->nota_fecha_vencimiento = $nota_fecha_vencimiento;
          $this->nota_cli_id = $nota_cli_id;
          $this->nota_documento_modificar = $nota_documento_modificar;
          $this->nota_numero_modificar = $nota_numero_modificar;
          $this->nota_tipo = $nota_tipo;
          $this->nota_correlativo_numero = $nota_correlativo_numero;
          $this->nota_envio_sunat = $nota_envio_sunat;
          $this->nota_pdf = $nota_pdf;
          $this->nota_xml = $nota_xml;
          $this->nota_cdr = $nota_cdr;
      }
      function getId() {
          return $this->id;
      }

      function getNota_fecha() {
          return $this->nota_fecha;
      }

      function getNota_correlativo() {
          return $this->nota_correlativo;
      }

      function getNota_numero() {
          return $this->nota_numero;
      }

      function getNota_moneda() {
          return $this->nota_moneda;
      }

      function getNota_tipocambio() {
          return $this->nota_tipocambio;
      }

      function getNota_sunat_transaccion() {
          return $this->nota_sunat_transaccion;
      }

      function getNota_fecha_vencimiento() {
          return $this->nota_fecha_vencimiento;
      }

      function getNota_cli_id() {
          return $this->nota_cli_id;
      }

      function getNota_documento_modificar() {
          return $this->nota_documento_modificar;
      }

      function getNota_numero_modificar() {
          return $this->nota_numero_modificar;
      }

      function getNota_tipo() {
          return $this->nota_tipo;
      }

      function getNota_correlativo_numero() {
          return $this->nota_correlativo_numero;
      }

      function getNota_envio_sunat() {
          return $this->nota_envio_sunat;
      }

      function getNota_pdf() {
          return $this->nota_pdf;
      }

      function getNota_xml() {
          return $this->nota_xml;
      }

      function getNota_cdr() {
          return $this->nota_cdr;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setNota_fecha($nota_fecha) {
          $this->nota_fecha = $nota_fecha;
      }

      function setNota_correlativo($nota_correlativo) {
          $this->nota_correlativo = $nota_correlativo;
      }

      function setNota_numero($nota_numero) {
          $this->nota_numero = $nota_numero;
      }

      function setNota_moneda($nota_moneda) {
          $this->nota_moneda = $nota_moneda;
      }

      function setNota_tipocambio($nota_tipocambio) {
          $this->nota_tipocambio = $nota_tipocambio;
      }

      function setNota_sunat_transaccion($nota_sunat_transaccion) {
          $this->nota_sunat_transaccion = $nota_sunat_transaccion;
      }

      function setNota_fecha_vencimiento($nota_fecha_vencimiento) {
          $this->nota_fecha_vencimiento = $nota_fecha_vencimiento;
      }

      function setNota_cli_id($nota_cli_id) {
          $this->nota_cli_id = $nota_cli_id;
      }

      function setNota_documento_modificar($nota_documento_modificar) {
          $this->nota_documento_modificar = $nota_documento_modificar;
      }

      function setNota_numero_modificar($nota_numero_modificar) {
          $this->nota_numero_modificar = $nota_numero_modificar;
      }

      function setNota_tipo($nota_tipo) {
          $this->nota_tipo = $nota_tipo;
      }

      function setNota_correlativo_numero($nota_correlativo_numero) {
          $this->nota_correlativo_numero = $nota_correlativo_numero;
      }

      function setNota_envio_sunat($nota_envio_sunat) {
          $this->nota_envio_sunat = $nota_envio_sunat;
      }

      function setNota_pdf($nota_pdf) {
          $this->nota_pdf = $nota_pdf;
      }

      function setNota_xml($nota_xml) {
          $this->nota_xml = $nota_xml;
      }

      function setNota_cdr($nota_cdr) {
          $this->nota_cdr = $nota_cdr;
      }

            public function getMyVars() {
        return get_object_vars($this);
    }
}
