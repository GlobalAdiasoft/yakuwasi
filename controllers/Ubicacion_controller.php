<?php

class Ubicacion_controller extends Controller{
   public function agregar(){
        $id= null;      
        $nombre=$_POST['nombre'];
      
        $ubicacion = new Ubicacion($id, $nombre);
        $ubicacion->create();
        
    }
      public function mostrar(){
        $ubicacion = Ubicacion::getAll();
        $data = array();
        foreach ($ubicacion as $value) {
       
        array_push($data, array(

    "id"=> strtoupper($value['id']),
    "nombre"=> strtoupper($value['nombre']),
    
   
                   
));
        }
        echo json_encode($data);
    }
    public function eliminar() {
        $id       = $_POST['id'];
        $ubicacion = Ubicacion::getById($id);
        $ubicacion->delete();       
    }
      public function mostrar_select(){
         $ubicacion = Ubicacion::getAll();
         
        foreach ($ubicacion as $value) {
            echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
        }
    }
}
