<?php
class Clientes_controller extends Controller {
    function __construct() {
        parent::__construct();
    }
    function mostrar_ubigeo2() {
        $ubigeo = Ubigeo::getAll();
        foreach ($ubigeo as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['ubi_departamento'] . "," . $value['ubi_provincia'] . "," . $value['ubi_distrito'] . '</option>';
        }
    }
    function mostrar_ubigeo() {
        $data   = array(
            'ubi_provincia' => '',
            'ubi_distrito' => ''
        );
        $ubigeo = Ubigeo::whereV($data, 'and');
        foreach ($ubigeo as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['ubi_departamento'] . '</option>';
        }
    }
    function mostrar_clientes() {
        $clientes = Clientes::getAll();
        $data     = array();
        foreach ($clientes as $value) {
            $ubigeo = Ubigeo_controller::ubigeo_completo($value['cli_ubigeo']);
            array_push($data, array(
                "id" => strtoupper($value['id']),
                "cli_nombre" => strtoupper($value['cli_nombre']),
                "cli_ubigeo" => strtoupper($ubigeo),
                "cli_direccion" => strtoupper($value['cli_direccion']),
                "cli_telefono" => strtoupper($value['cli_telefono']),
                "cli_email" => strtoupper($value['cli_email']),
                "cli_web" => strtoupper($value['cli_web']),
                "cli_ruc" => strtoupper($value['cli_ruc']),
                "cli_dni" => strtoupper($value['cli_dni']),
                "cli_observacion" => strtoupper($value['cli_observacion'])
            ));
        }
        echo json_encode($data,JSON_PRETTY_PRINT);
    }
    function mostrar_cliente() {
        $usuarios = Clientes::where('id', $_POST['id']);
        echo json_encode($usuarios);
    }
    function agregar_clientes() {
        $valor= iconv_strlen($_POST['ruc']);
        switch ($valor) {
            case '8':
            $dni=  $_POST['ruc']  ;
            $ruc= '';
            break;
            case '11':
               $dni= ''  ;
            $ruc=  $_POST['ruc']; 
                
            break;

         
        }
        $id              = null;
        $cli_nombre      = $_POST['nombres'];
        $cli_ubigeo      = $_POST['ubigeo'];
        $cli_direccion   = $_POST['direccion'];
        $cli_telefono    = $_POST['telefono'];
        $cli_email       = $_POST['email'];
        $cli_web         = $_POST['web'];
        $cli_ruc         = $ruc;
        $cli_dni        = $dni;
        $cli_observacion = $_POST['observacion'];
        $tipo = $_POST['tipo'];
        $cliente         = new Clientes($id, $cli_nombre, $cli_ubigeo, $cli_direccion, $cli_telefono, $cli_email, $cli_web, $cli_ruc, $cli_dni, $cli_observacion, $tipo);
        $cliente->create();
    }
    function eliminar_cliente() {
        $id       = $_POST['id'];
        $usuarios = Clientes::getById($id);
        $usuarios->delete();
    }
    function modificar_cliente() {
        $usuarios = Clientes::getById($_POST['id']);
        $usuarios->setCli_nombre($_POST['nombres']);
        $usuarios->setCli_ubigeo($_POST['ubigeo']);
        $usuarios->setCli_direccion($_POST['direccion']);
        $usuarios->setCli_telefono($_POST['telefono']);
        $usuarios->setCli_email($_POST['email']);
        $usuarios->setCli_web($_POST['web']);
        $usuarios->setCli_ruc($_POST['ruc']);
        $usuarios->setCli_observacion($_POST['observacion']);
        $usuarios->update();
        echo 1;
    }
    function llamar_cliente() {
        if(strlen($_POST['id'])==8 || strlen($_POST['id'])==11 ){
            $cliente_opcion = Clientes::getBy('cli_ruc', $_POST['id']);
            $cliente_id = $cliente_opcion->getId();
        }else{
            $cliente_id = $_POST['id'];
        }
        $cliente = Clientes::where('id', $cliente_id);
        $data    = array();
        if (empty($cliente)) {
            echo 'vacio';
            exit;
        } else {
            foreach ($cliente as $value) {
                $ubigeo = Ubigeo_controller::ubigeo_completo($value['cli_ubigeo']);
                array_push($data, array(
                    "id" => strtoupper($value['id']),
                    "cli_nombre" => strtoupper($value['cli_nombre']),
                    "cli_ubigeo" => strtoupper($ubigeo),
                    "cli_direccion" => strtoupper($value['cli_direccion']),
                    "cli_telefono" => strtoupper($value['cli_telefono']),
                    "cli_email" => strtoupper($value['cli_email']),
                    "cli_web" => strtoupper($value['cli_web']),
                    "cli_ruc" => strtoupper($value['cli_ruc']),
                    "cli_observacion" => strtoupper($value['cli_observacion']),
                     "tipo" => strtoupper($value['tipo']),
                ));
            }
        }
        echo json_encode($data);
    }
    function llamar_rucs($documento='vacio') {
        if($documento=='vacio'){
             $rucs = Clientes::getAll();
        }else{
            
        
        if($documento == 'FAC'){
        $rucs = Clientes::where_caracter('cli_ruc',11);
        }else{
          $rucs = Clientes::where_caracter('cli_ruc',8);
        }
        }
        foreach ($rucs as $value) {
            echo '<option value="' .$value['id'].' | '. strtoupper($value['cli_ruc']) . '">'.strtoupper($value['cli_nombre']).'</option>';
        }
    }
}
