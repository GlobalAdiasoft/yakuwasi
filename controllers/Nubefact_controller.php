<?php

class Nubefact_controller extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function conexion($data){
   
        $ruta                   = ruta_nubefact;
        $token                  = token_nubefact;
        $data_json = json_encode($data);
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Token token="' . $token . '"',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);
        curl_close($ch);
        $leer_respuesta = json_decode($respuesta, true);
        return $leer_respuesta;
    }
}
