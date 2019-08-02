<?php

class Proveedores_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
      public function mostrar(){
        $proveedores = Proveedores::getAll();
        $data = array();
        foreach ($proveedores as $value) {
        $ubigeo= Ubigeo_controller::ubigeo_completo($value['pro_ubigeo']);
                array_push($data, array(

    "id"=> strtoupper($value['id']),
    "pro_ruc"=> strtoupper($value['pro_ruc']),
    "pro_razonsocial"=> strtoupper($value['pro_razonsocial']),
    "pro_sectorcomercial"=> strtoupper($value['pro_sectorcomercial']),
    "pro_ubigeo"=> strtoupper($ubigeo),
    "pro_direccion"=> strtoupper($value['pro_direccion']),
    "pro_telefono"=> strtoupper($value['pro_telefono']),
    "pro_correo"=> strtoupper($value['pro_correo']),
    "pro_ctasoles"=> strtoupper($value['pro_ctasoles']),
    "pro_ctadolares"=> strtoupper($value['pro_ctadolares']),                
));
        }
        echo json_encode($data);
    }
    
     public function mostrar_proveedor() {
        $proveedor = Proveedores::where('id', $_POST['id']);
        echo json_encode($proveedor);
    }
    public function agregar(){
        $id= null;
        $pro_ruc=$_POST['ruc'];
        $pro_razonsocial=$_POST['razonsocial'];
        $pro_sectorcomercial=$_POST['sectorcomercial'];
        $pro_ubigeo=$_POST['ubigeo'];
        $pro_direccion=$_POST['direccion'];
        $pro_telefono=$_POST['telefono'];
        $pro_correo=$_POST['email'];
        $pro_ctasoles=$_POST['ctasoles'];
        $pro_ctadolares=$_POST['ctadolares'];
      
      if(empty($pro_ruc)){
          echo 'ruc';
          exit;
      }
      if(empty($pro_razonsocial)){
          echo 'razonsocial';
          exit;
      }
      if(empty($pro_ubigeo)){
          echo 'ubigeo';
          exit;
      }
      if(empty($pro_direccion)){
          echo 'direccion';
          exit;
      }
        $proveedor = new Proveedores($id, $pro_ruc, $pro_razonsocial, $pro_sectorcomercial, $pro_ubigeo, $pro_direccion, $pro_telefono, $pro_correo, $pro_ctasoles, $pro_ctadolares);
        $proveedor->create();
        echo 0;
    }
      public function eliminar() {
        $id       = $_POST['id'];
        $proveedores = Proveedores::getById($id);
        $proveedores->delete();       
    }
     public function modificar(){
          var_dump($_POST);
        $proveedor = Proveedores::getById($_POST['id']);
        $proveedor->setPro_ruc($_POST['ruc']);
        $proveedor->setPro_razonsocial($_POST['razonsocial']);
        $proveedor->setPro_sectorcomercial($_POST['sectorcomercial']);
        $proveedor->setPro_ubigeo($_POST['ubigeo']);
        $proveedor->setPro_direccion($_POST['direccion']);
        $proveedor->setPro_telefono($_POST['telefono']);
        $proveedor->setPro_correo($_POST['email']);
        $proveedor->setPro_ctasoles($_POST['ctasoles']);
        $proveedor->setPro_ctadolares($_POST['ctadolares']);
       
        $proveedor->update();
    }
     public function mostrar_select(){
         $proveedores = Proveedores::getAll();
         
        foreach ($proveedores as $value) {
            echo '<option value="'.$value['id'].'">'.$value['pro_razonsocial'].' - '.$value['pro_ruc'].'</option>';
        }
    }
}
