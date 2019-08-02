<?php

class Ubigeo_controller extends Controller{
    public function __construct() {
        parent::__construct();
    }
    function ubigeo_completo($data)
    {
        $ubigeo          = Ubigeo::getById($data);
        $ubigeo_completo = $ubigeo->getUbi_departamento() . "," . $ubigeo->getUbi_provincia() . "," . $ubigeo->getUbi_distrito();
        return $ubigeo_completo;
    }
      function ubigeo_all(){
       
        $ubigeo = Ubigeo::getAll();
        foreach ($ubigeo as $value) {
            echo '<option value="'.$value['id'].'">'.$value['ubi_departamento'].",".$value['ubi_provincia'].",".$value['ubi_distrito'].'</option>';
        }
    }
    function ubigeo_all2(){
       
        $ubigeo = Ubigeo::getAll();
       
        echo json_encode($ubigeo,JSON_PRETTY_PRINT);
    }
}
