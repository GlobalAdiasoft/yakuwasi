<?php

class Listas_controller extends Controller {
   function agregar($data){
       $id = null;
       $nombre = $data;
       $listas = new Listas($id, $nombre);
       $listas->create();      
   }
   function mostrar(){
       $listas = Listas::getAll();
        echo json_encode($listas,JSON_PRETTY_PRINT);
   }
}
