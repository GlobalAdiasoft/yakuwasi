<?php
class Reniec_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function datos() {
        require(URLCOMPOSER . "jossmp/datos-peru/src/autoload.php");
      
            $dni = $_POST['dni'];
        
        //$essalud = new \EsSalud\EsSalud();
        //$mintra  = new \MinTra\mintra();
        $reniec  = new \Reniec\Reniec();
        //$search1 = $essalud->search( $dni );
        //$search2 = $mintra->search( $dni );
        //$search = $essalud->search( $dni );
        // $search = $mintra->search( $dni );       
        $search  = $reniec->search($dni);
        if ($search->success == true) {
            $data   = array(
                'ubi_departamento' => $search->result->Departamento,
                'ubi_provincia' => $search->result->Provincia,
                'ubi_distrito' => $search->result->Distrito
            );
            // print_r($data);
            $ubigeo = Ubigeo::whereV($data, 'and');
            $datos  = array(
                'nombres' => $search->result->Nombres,
                'apellidos' => $search->result->apellidos,
                'distrito' => $search->result->Distrito,
                'provincia' => $search->result->Provincia,
                'departamento' => $search->result->Departamento,
                'direccion' => '',
                'Id_ubigeo' => $ubigeo[0]['id']
            );
           
        }else{
            $datos  = array();
        }
         echo json_encode($datos);
    }
}