<?php

class Marcas_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
      public function mostrar(){
        $marcas = Marcas::getAll();
        $data = array();
        foreach ($marcas as $value) {
        $usuario = Usuario::getById($value['mar_codusuario']);
        array_push($data, array(

    "id"=> strtoupper($value['id']),
    "mar_codinterno"=> strtoupper($value['mar_codinterno']),
    "mar_nombre"=> strtoupper($value['mar_nombre']),
    "mar_codusuario"=> strtoupper($usuario->getUsu_usuario()),
   
                   
));
        }
        echo json_encode($data);
    }
     public function mostrar_marca() {
        $marcas = Marcas::where('id', $_POST['id']);
        echo json_encode($marcas);
    }
    public function agregar(){
        $id= null;
        $mar_codinterno=$_POST['codinterno'];
        $mar_nombre=$_POST['nombre'];
        
        if (empty($_POST['codinterno'])){
            echo 1;
            exit;
        }
        if (empty($_POST['nombre'])){
            echo 2;
            exit;
        }
        $mar_codusuario= Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $marca = new Marcas($id, $mar_codinterno, $mar_nombre, $mar_codusuario);
        $marca->create();
        echo 0;
    }
      public function eliminar() {
        $id       = $_POST['id'];
        $marcas = Marcas::getById($id);
        $marcas->delete();       
    }
     public function modificar(){
        $marca = Marcas::getById($_POST['id']);
        $marca->setMar_codinterno($_POST['codinterno']);
        $marca->setMar_nombre($_POST['nombre']);
        $marca->update();
    }
     public function mostrar_select(){
         $marcas = Marcas::getAll();
         
        foreach ($marcas as $value) {
            echo '<option value="'.$value['id'].'">'.$value['mar_nombre'].'</option>';
        }
    }
}
