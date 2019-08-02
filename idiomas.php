<?php

if(Session::exist()){
    $usuarios = Usuario::getById(session::getValue('ID_BUSI'));
    $idioma = $usuarios->getUser_idioma();
            
}else{

$visitas = Visitas::where('visitas_ip', $_SERVER['REMOTE_ADDR']);
if(empty($visitas)){
    $id = null;
    $visitas_ip=$_SERVER['REMOTE_ADDR'];
    $visitas_idioma = 'es';
    $visitas1 = new Visitas($id, $visitas_ip, $visitas_idioma);
    $visitas1->create();
}

$visitas = Visitas::where('visitas_ip', $_SERVER['REMOTE_ADDR']);
foreach ($visitas as $value) {
   $idioma = $value['visitas_idioma'];
}
}

  require './'.$idioma .'.php'; 
    @define('NOMBREVIDEO', 'video'.$idioma.'.mp4');
    @define('NOMBREBROCHURE', 'Presentacion_Bussinex_'.$idioma.'.pdf'); 
?>