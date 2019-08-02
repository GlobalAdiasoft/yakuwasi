<?php
class Configuracion_controller {
    public function upload_imagen() {
        mkdir(URLIMG . "logos/", 0777);
        $output_dir = URLIMG . "logos/";
        if (isset($_FILES["imagen"])) {
            $ret   = array();
            $error = $_FILES["imagen"]["error"];
            if (!is_array($_FILES["imagen"]["name"])) {
                $fileName       = $_FILES["imagen"]["name"];
                $nombre_archivo = explode('.', $fileName);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $output_dir . 'logo_' . $nombre_archivo[0] . '.' . $nombre_archivo[1]);
                $ret[] = $fileName;
            } else {
                $fileCount = count($_FILES["imagen"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["imagen"]["name"][$i];
                    move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                }
            }
            echo json_encode($ret);
        }
    }
    public function agregar() {
        $id      = null;
        $archivo = $_POST['nombre'];
        if(empty($_POST['nombre'])){
            
        }else{
            $config  = new Configuracion($id, $archivo);
            $config->create();            
        }
       $config2_busqueda = Configuracion2::getAll(); 
        if (empty($config2_busqueda)) {
            if(empty($_POST['razonsocial']) || empty($_POST['direccion']) || empty($_POST['ubigeo']) || empty($_POST['ruc'])){
                
            }else{
            $razon_social = $_POST['razonsocial'];
            $direccion    = $_POST['direccion'];
            $ubigeo       = $_POST['ubigeo'];
            $ruc          = $_POST['ruc'];
            $eliminar     = 0;
            $config2      = new Configuracion2($id, $razon_social, $direccion, $ubigeo, $ruc, $eliminar);
            $config2->create();
            }
        } else {
            $config2_busqueda = Configuracion2::getUltimo('id');
            $config2_busqueda = Configuracion2::getById($config2_busqueda[0]['id']);
            $config2_busqueda->setRazon_social($_POST['razonsocial']);
            $config2_busqueda->setDireccion($_POST['direccion']);
            $config2_busqueda->setUbigeo($_POST['ubigeo']);
            $config2_busqueda->setRuc($_POST['ruc']);
            $config2_busqueda->update();
        }
    }
    function consultar_logo() {
        $logo = Configuracion::getUltimo('id');
        if (empty($logo)) {
            echo URL . URLIMG . NOMBRE_LOGO;
        } else {
            echo URL . URLIMG . 'logos/' . $logo[0]['archivo'];
        }
    }
    function ejemplo(){
       $config = Configuracion2::getUltimo('id');
if(empty($config)){
    $config_i_RAZON_SOCIAL_EMPRESA='yakuwasi srl';
    $config_i_DIRECCION_EMPRESA='urb bancarios';
    $config_i_RUC_EMPRESA='104544639028';
    $config_i_UBIGEO_EMPRESA='150115';
 
}else{
    $config_i_RAZON_SOCIAL_EMPRESA=$config[0]['razon_social'];
    $config_i_DIRECCION_EMPRESA=$config[0]['direccion'];
    $config_i_RUC_EMPRESA=$config[0]['ruc'];
    $config_i_UBIGEO_EMPRESA=$config[0]['ubigeo'];

}

       
    }
}
