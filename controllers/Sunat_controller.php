<?php
class Sunat_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function datos_jossmp($return = 'n', $ruc_data = '') {
        require(URLCOMPOSER . "jossmp/sunatphp/src/autoload.php");
        $company = new \Sunat\Sunat();
        if ($ruc_data == '') {
            $ruc = $_POST['ruc'];
        } else {
            $ruc = $ruc_data;
        }
        $search = $company->search($ruc);
        
        if(empty($search['success'])){
            $resultado=array();
            if ($return == 's') {
                return $resultado;
            } else {
                echo json_encode($resultado, JSON_PRETTY_PRINT);
            }
            exit;
        }
        if ($search['success'] == 1) {
            if ($search['result']['Direccion'] == '-' || $search['result']['Direccion'] == '') {
                $datos_obtenidos = array(
                    'Direccion_corregida' => '',
                    'Id_ubigeo' => '',
                    'ubi_departamento' => '',
                    'ubi_provincia' => '',
                    'ubi_distrito' => ''
                );
            } else {
          
                $datos_obtenidos = Sunat_controller::separar_direccion($search['result']['Direccion']);
              
               
            }
            $resultado = array_merge($search, $datos_obtenidos);
            if ($return == 's') {
                return $resultado;
            } else {
                echo json_encode($resultado, JSON_PRETTY_PRINT);
            }
        }
        
    }
    public function datos_konta($ruc) {
        require(URLCOMPOSER . "konta/sunat/src/Konta/curl.php");
        require(URLCOMPOSER . "konta/sunat/src/Konta/sunat.php");
        $cliente         = new Konta\Sunat;
        $ruc             = trim($ruc);
        $datos_sunat     = $cliente->BuscaDatosSunat($ruc);
        $datos_obtenidos = $this->separar_direccion($datos_sunat['Direccion']);
        $resultado       = array_merge($datos_sunat, $datos_obtenidos);
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
    public function separar_direccion($datos) {
        $direccion            = trim($datos);
        $variable             = explode("-", trim($direccion));
        $variable             = array_reverse($variable);
        $conteo               = count($variable) - 1;
        $deparmanento_separar = explode(" ", trim($variable[2]));
        $conto_depa           = count($deparmanento_separar) - 1;
        $departamento         = trim($deparmanento_separar[$conto_depa]);
        $provincia            = trim($variable[$conteo - $conteo + 1]);
        $distrito             = trim($variable[$conteo - $conteo]);
        $data                 = array(
            'ubi_departamento' => $departamento,
            'ubi_provincia' => $provincia,
            'ubi_distrito' => $distrito
        );
        $ubigeo               = Ubigeo::whereV($data, 'and');
        $juntar               = '';
        for ($i = 0; $i <= $conto_depa - 1; $i++) {
            $juntar = $juntar . ' ' . $deparmanento_separar[$i];
        }
        $datos_final = array(
            'Direccion_corregida' => trim($juntar),
            'Id_ubigeo' => $ubigeo[0]['id'],
            'ubi_departamento' => $departamento,
            'ubi_provincia' => $provincia,
            'ubi_distrito' => $distrito
        );
        return $datos_final;
    }
}