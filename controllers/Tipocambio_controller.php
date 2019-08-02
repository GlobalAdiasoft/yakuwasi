<?php

class Tipocambio_controller extends Controller {
public function agregar(){
    $id=null;
    $cam_fecha=fecha_mysql;
    $cam_compra=$_POST['compra'];
    $cam_venta=$_POST['venta'];
    $tipocambio = new Tipocambio($id, $cam_fecha, $cam_compra, $cam_venta);
    $tipocambio->create();
}
public function mostrar(){
    $tipocambio = Tipocambio::getAll();
    echo json_encode($tipocambio);    
}
}
