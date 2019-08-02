<?php

class Ventas extends Model {
     protected static $table = "ventas";
private $id_venta;
private $token;
private $fecha;
private $hora;
private $mesa;
private $estado;
private $total_boleta;
private $id_client;
private $vendedor;
private $cond_pago;
private $guia_remision;
private $num_control;
private $moneda;
private $total_bruto;
private $total_dscto;
private $valor_venta;
private $igv;
private $total_letras;
private $hecho_por;
private $fecha_pagado;
private $comentario;
private $num_boleta;
private $serie;
private $dniruc;
private $referencia;
private $estado_pago;
private $codo;
private $deuda;
private $pagad;
private $tokenv;
private $mpago;
private $mvuelto;
function __construct($id_venta, $token, $fecha, $hora, $mesa, $estado, $total_boleta, $id_client, $vendedor, $cond_pago, $guia_remision, $num_control, $moneda, $total_bruto, $total_dscto, $valor_venta, $igv, $total_letras, $hecho_por, $fecha_pagado, $comentario, $num_boleta, $serie, $dniruc, $referencia, $estado_pago, $codo, $deuda, $pagad, $tokenv, $mpago, $mvuelto) {
    $this->id_venta = $id_venta;
    $this->token = $token;
    $this->fecha = $fecha;
    $this->hora = $hora;
    $this->mesa = $mesa;
    $this->estado = $estado;
    $this->total_boleta = $total_boleta;
    $this->id_client = $id_client;
    $this->vendedor = $vendedor;
    $this->cond_pago = $cond_pago;
    $this->guia_remision = $guia_remision;
    $this->num_control = $num_control;
    $this->moneda = $moneda;
    $this->total_bruto = $total_bruto;
    $this->total_dscto = $total_dscto;
    $this->valor_venta = $valor_venta;
    $this->igv = $igv;
    $this->total_letras = $total_letras;
    $this->hecho_por = $hecho_por;
    $this->fecha_pagado = $fecha_pagado;
    $this->comentario = $comentario;
    $this->num_boleta = $num_boleta;
    $this->serie = $serie;
    $this->dniruc = $dniruc;
    $this->referencia = $referencia;
    $this->estado_pago = $estado_pago;
    $this->codo = $codo;
    $this->deuda = $deuda;
    $this->pagad = $pagad;
    $this->tokenv = $tokenv;
    $this->mpago = $mpago;
    $this->mvuelto = $mvuelto;
}
function getId_venta() {
    return $this->id_venta;
}

function getToken() {
    return $this->token;
}

function getFecha() {
    return $this->fecha;
}

function getHora() {
    return $this->hora;
}

function getMesa() {
    return $this->mesa;
}

function getEstado() {
    return $this->estado;
}

function getTotal_boleta() {
    return $this->total_boleta;
}

function getId_client() {
    return $this->id_client;
}

function getVendedor() {
    return $this->vendedor;
}

function getCond_pago() {
    return $this->cond_pago;
}

function getGuia_remision() {
    return $this->guia_remision;
}

function getNum_control() {
    return $this->num_control;
}

function getMoneda() {
    return $this->moneda;
}

function getTotal_bruto() {
    return $this->total_bruto;
}

function getTotal_dscto() {
    return $this->total_dscto;
}

function getValor_venta() {
    return $this->valor_venta;
}

function getIgv() {
    return $this->igv;
}

function getTotal_letras() {
    return $this->total_letras;
}

function getHecho_por() {
    return $this->hecho_por;
}

function getFecha_pagado() {
    return $this->fecha_pagado;
}

function getComentario() {
    return $this->comentario;
}

function getNum_boleta() {
    return $this->num_boleta;
}

function getSerie() {
    return $this->serie;
}

function getDniruc() {
    return $this->dniruc;
}

function getReferencia() {
    return $this->referencia;
}

function getEstado_pago() {
    return $this->estado_pago;
}

function getCodo() {
    return $this->codo;
}

function getDeuda() {
    return $this->deuda;
}

function getPagad() {
    return $this->pagad;
}

function getTokenv() {
    return $this->tokenv;
}

function getMpago() {
    return $this->mpago;
}

function getMvuelto() {
    return $this->mvuelto;
}

function setId_venta($id_venta) {
    $this->id_venta = $id_venta;
}

function setToken($token) {
    $this->token = $token;
}

function setFecha($fecha) {
    $this->fecha = $fecha;
}

function setHora($hora) {
    $this->hora = $hora;
}

function setMesa($mesa) {
    $this->mesa = $mesa;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setTotal_boleta($total_boleta) {
    $this->total_boleta = $total_boleta;
}

function setId_client($id_client) {
    $this->id_client = $id_client;
}

function setVendedor($vendedor) {
    $this->vendedor = $vendedor;
}

function setCond_pago($cond_pago) {
    $this->cond_pago = $cond_pago;
}

function setGuia_remision($guia_remision) {
    $this->guia_remision = $guia_remision;
}

function setNum_control($num_control) {
    $this->num_control = $num_control;
}

function setMoneda($moneda) {
    $this->moneda = $moneda;
}

function setTotal_bruto($total_bruto) {
    $this->total_bruto = $total_bruto;
}

function setTotal_dscto($total_dscto) {
    $this->total_dscto = $total_dscto;
}

function setValor_venta($valor_venta) {
    $this->valor_venta = $valor_venta;
}

function setIgv($igv) {
    $this->igv = $igv;
}

function setTotal_letras($total_letras) {
    $this->total_letras = $total_letras;
}

function setHecho_por($hecho_por) {
    $this->hecho_por = $hecho_por;
}

function setFecha_pagado($fecha_pagado) {
    $this->fecha_pagado = $fecha_pagado;
}

function setComentario($comentario) {
    $this->comentario = $comentario;
}

function setNum_boleta($num_boleta) {
    $this->num_boleta = $num_boleta;
}

function setSerie($serie) {
    $this->serie = $serie;
}

function setDniruc($dniruc) {
    $this->dniruc = $dniruc;
}

function setReferencia($referencia) {
    $this->referencia = $referencia;
}

function setEstado_pago($estado_pago) {
    $this->estado_pago = $estado_pago;
}

function setCodo($codo) {
    $this->codo = $codo;
}

function setDeuda($deuda) {
    $this->deuda = $deuda;
}

function setPagad($pagad) {
    $this->pagad = $pagad;
}

function setTokenv($tokenv) {
    $this->tokenv = $tokenv;
}

function setMpago($mpago) {
    $this->mpago = $mpago;
}

function setMvuelto($mvuelto) {
    $this->mvuelto = $mvuelto;
}

public function getMyVars() {
        return get_object_vars($this);
    }
}
