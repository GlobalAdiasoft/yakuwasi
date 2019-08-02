<?php

class Fabricantes_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
     public function mostrar(){
        $fabricantes = Fabricantes::getAll();
        $data = array();
        foreach ($fabricantes as $value) {
        $usuario = Usuario::getById($value['fabri_codusuario']);
        array_push($data, array(

    "id"=> strtoupper($value['id']),
    "fabri_codinterno"=> strtoupper($value['fabri_codinterno']),
    "fabri_nombre"=> strtoupper($value['fabri_nombre']),
    "fabri_codusuario"=> strtoupper($usuario->getUsu_usuario()),
   
                   
));
        }
        echo json_encode($data);
    }
     public function mostrar_fabricante() {
        $fabricante = Fabricantes::where('id', $_POST['id']);
        echo json_encode($fabricante);
    }
    public function agregar(){
        $id= null;
        $fabri_codinterno=$_POST['codinterno'];
        $fabri_nombre=$_POST['nombre'];
        
        if (empty($_POST['codinterno'])){
            echo 1;
            exit;
        }
        if (empty($_POST['nombre'])){
            echo 2;
            exit;
        }
        $fabri_codusuario= Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $fabricantes = new Fabricantes($id, $fabri_codinterno, $fabri_nombre, $fabri_codusuario);
        $fabricantes ->create();
        echo 0;
    }
      public function eliminar() {
        $id       = $_POST['id'];
        $fabricante = Fabricantes::getById($id);
        $fabricante->delete();       
    }
    public function modificar(){
        $fabricante = Fabricantes::getById($_POST['id']);
        $fabricante->setFabri_codinterno($_POST['codinterno']);
        $fabricante->setFabri_nombre($_POST['nombre']);
        $fabricante->update();
    }
     public function mostrar_select(){
         $fabricantes = Fabricantes::getAll();
         
        foreach ($fabricantes as $value) {
            echo '<option value="'.$value['id'].'">'.$value['fabri_nombre'].'</option>';
        }
    }
}
