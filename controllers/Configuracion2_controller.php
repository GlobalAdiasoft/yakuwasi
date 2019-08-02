<?php

class Configuracion2_controller extends Controller{
    function agregar(){
                $id=null;
                $razon_social=$_POST['razonsocial'];
                $direccion=$_POST['direccion'];
                $ubigeo=$_POST['ubigeo'];
                $ruc=$_POST['ruc'];
                $eliminar=0;
        $config2=new Configuracion2($id, $razon_social, $direccion, $ubigeo, $ruc, $eliminar);
        $config2->create();
        
        
    }
    function  mostrar(){
        $config2 = Configuracion2::where('eliminar', 0);
        print_r($config2);
    }
    function  eliminar(){
        $config2 = Configuracion2::getById(1);
        $config2->delete();
    }
     function  eliminar2(){
        $config2 = Configuracion2::getById(2);
        $config2->setEliminar(1);
        $config2->update();
        
       
    }
    function buscar(){
       $config2 = Configuracion2::where('eliminar', 1);
       $data=array();
       foreach ($config2 as $value) {
           $usuario = Usuario::getById($value['ruc']);
           array_push($data, array(
               'id'=>$value['id'],
               'ruc'=>$usuario->getUsu_email(),
           ));
       }
       echo json_encode($data,JSON_PRETTY_PRINT);
}
}