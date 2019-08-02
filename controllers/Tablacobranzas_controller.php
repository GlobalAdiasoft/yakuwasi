<?php

class Tablacobranzas_controller extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function crear(){
        $id =NULL;
        $cobra_documento=$_POST['documento'];
        $cobra_fecha_hora= fecha_hora_mysql;
        $cobra_usuario= Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $cobra_monto =$_POST['monto'];
        $nuevacobranza= new Cobranzas($id, $cobra_documento, $cobra_fecha_hora, $cobra_usuario, $cobra_monto);
        $nuevacobranza->create();
    }
    public function mostrar_historial(){
        $documento = $_GET['documento'];
        
        if(empty($documento)){
            $cobranza = array();
             echo json_encode($cobranza,JSON_PRETTY_PRINT); 
             exit;
        }
        $data=array(
            'cobra_documento'=>$documento,
        
        );
        $cobranza= Cobranzas::whereV($data, 'and');
        $datos=array();
        foreach ($cobranza as $value) {
            $usuario = Usuario::getById($value['cobra_usuario']);
            
            array_push($datos, array(
                "id" => strtoupper($value['id']),
                "cobra_documento" => strtoupper($value['cobra_documento']),
                "cobra_fecha_hora" => strtoupper($value['cobra_fecha_hora']),
                "cobra_usuario" => strtoupper($usuario->getUsu_usuario()),
                "cobra_monto" => strtoupper($value['cobra_monto']),
          
            ));
        }
        echo json_encode($datos,JSON_PRETTY_PRINT);
    }
}
