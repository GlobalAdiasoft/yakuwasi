<?php

class Familias_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
     public function mostrar(){
        $familias = Familias::getAll();
        $data = array();
        foreach ($familias as $value) {
        $usuario = Usuario::getById($value['fam_codusuario']);
        array_push($data, array(

    "id"=> strtoupper($value['id']),
    "fam_codinterno"=> strtoupper($value['fam_codinterno']),
    "fam_nombre"=> strtoupper($value['fam_nombre']),
    "fam_codusuario"=> strtoupper($usuario->getUsu_usuario()),
   
                   
));
        }
        echo json_encode($data);
    }
     public function mostrar_familia() {
        $familias = Familias::where('id', $_POST['id']);
        echo json_encode($familias);
    }
    public function agregar(){
        $id= null;
        $fam_codinterno=$_POST['codinterno'];
        $fam_nombre=$_POST['nombre'];
        
        if (empty($_POST['codinterno'])){
            echo 1;
            exit;
        }
        if (empty($_POST['nombre'])){
            echo 2;
            exit;
        }
        $fam_codusuario= Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $familias = new Familias($id, $fam_codinterno, $fam_nombre, $fam_codusuario);
        $familias->create();
        echo 0;
    }
    public function eliminar() {
        $id       = $_POST['id'];
        $familias = Familias::getById($id);
        $familias->delete();       
    }
    public function modificar(){
        $familias = Familias::getById($_POST['id']);
        $familias->setFam_codinterno($_POST['codinterno']);
        $familias->setFam_nombre($_POST['nombre']);
        $familias->update();
    }
    public function mostrar_select(){
         $familias = Familias::getAll();
         
        foreach ($familias as $value) {
            echo '<option value="'.$value['id'].'">'.$value['fam_nombre'].'</option>';
        }
    }
    function ejemplo(){
        $familias = Ventas_e::whereBetween('fecha', '2019-02-25', '2019-02-25');
        $data = array();
        foreach ($familias as $value) {
            
             array_push($data, array(
                 'hora'=>$value['hora'],
                 'mesa'=>$value['mesa'],
                 
             ));
        }
        echo json_encode($data,JSON_PRETTY_PRINT);
    }
}
