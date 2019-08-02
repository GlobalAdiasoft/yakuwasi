<?php

class Datos_controller extends Controller{
   
    public function __construct() {
        parent::__construct();
    }
    public function datos_personales($nombre,$codigo){
        $codigo_sistema = Hash::create(ALGORITMO, 'p1', HASHKEY);
    if($codigo_sistema==$codigo){
        
    
        
        if($nombre == 'v14'){
            $datos_personales=array(
                'nombre'=>'eder',
                'apellido'=>'alegre',
                'edad'=>'20',
                'fecha_nacimiento'=>'23/12/1988',
              
            );
            print_r($datos_personales);
        }
           if($nombre == 'v13'){
            $datos_personales=array(
                'nombre'=>'marco',
                'apellido'=>'rodriguez',
                'edad'=>'29',
                'fecha_nacimiento'=>'23/12/1970',
              
            );
            print_r($datos_personales);
        }else{
            echo 'intruso';
        }
        }else{
            echo 'usted fue retirado de la empresa';
        }
    }
}
