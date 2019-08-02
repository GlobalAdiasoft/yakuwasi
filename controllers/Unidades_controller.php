<?php


class Unidades_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
        public function mostrar(){
      $unidades = Unidades_medida::getAll();
        $data = array();
        foreach ($unidades as $value) {
        array_push($data, array(
    "id"=> strtoupper($value['id']),
    "uni_nombre"=> strtoupper($value['uni_nombre']),
    "uni_simbolo"=> strtoupper($value['uni_simbolo']),
 
   
                   
));
        }
        echo json_encode($data);
    }
     public function mostrar_unidad() {
        $unidad = Unidades_medida::where('id', $_POST['id']);
        echo json_encode($unidad);
    }
     public function agregar(){
        $id= null;
        $uni_nombre=$_POST['nombre'];
        $uni_simbolo=$_POST['simbolo'];
        
        if (empty($_POST['nombre'])){
            echo 1;
            exit;
        }
        if (empty($_POST['simbolo'])){
            echo 2;
            exit;
        }
       
        $unidad = new Unidades_medida($id, $uni_nombre, $uni_simbolo);
        $unidad->create();
        echo 0;
    }
     public function eliminar() {
        $id       = $_POST['id'];
        $unidades = Unidades_medida::getById($id);
        $unidades->delete();       
    }
     public function modificar(){
        $unidad = Unidades_medida::getById($_POST['id']);
        $unidad->setUni_nombre($_POST['nombre']);
        $unidad->setUni_simbolo($_POST['simbolo']);
        $unidad->update();
    }
      public function mostrar_select(){
         $unidades = Unidades_medida::getAll();
         
        foreach ($unidades as $value) {
            echo '<option value="'.$value['id'].'">'.$value['uni_nombre'].'</option>';
        }
    }
}
