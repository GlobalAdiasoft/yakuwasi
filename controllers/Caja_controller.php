<?php
class Caja_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function crear() {
        print_r($_POST);
        $id        = null;
        $total     = $_POST['total_caja'];
        $pago      = $_POST['total_pago'];
        $vuelto    = $_POST['total_vuelto'];
        $usuario   = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $fecha     = fecha_mysql;
        $hora      = hora_mysql;
        $documento = $_POST['caja_documento'];
        $numero    = $_POST['caja_numero'];
        $caja      = new Caja($id, $total, $pago, $vuelto, $usuario, $fecha, $hora, $documento, $numero);
        $caja->create();
    }
    function mostrar() {
        if(empty($_GET['fecha_incio']) && empty($_GET['fecha_final'])){
             $datos = array(
            'fecha'=>fecha_mysql,
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
        if(empty($_GET['fecha_incio']) && !empty($_GET['fecha_final'])){
             $datos = array(
            'fecha'=>fecha_mysql,
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
        if(!empty($_GET['fecha_inicio']) && empty($_GET['fecha_final'])){
              $datos = array(
            'fecha'=>$_GET['fecha_inicio'],
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
         if(!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_final'])){
              
        $caja = Caja::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        
        }
        $data = array();
        foreach ($caja as $value) {
            $usuario = Usuario::getBy('id', $value['usuario']);
            array_push($data, array(
                "id" => strtoupper($value['id']),
                "total" => strtoupper($value['total']),
                "pago" => strtoupper($value['pago']),
                "vuelto" => strtoupper($value['vuelto']),
                "usuario" => strtoupper($usuario->getUsu_usuario()),
                "fecha" => strtoupper($value['fecha']),
                "documento" => strtoupper($value['documento']),
                "numero" => strtoupper(str_pad($value['numero'], 7, "0", STR_PAD_LEFT))
            ));
        }
        echo json_encode($data);
    }
    function mostrar_totales(){
        if(empty($_GET['fecha_incio']) && empty($_GET['fecha_final'])){
             $datos = array(
            'fecha'=>fecha_mysql,
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
        if(empty($_GET['fecha_incio']) && !empty($_GET['fecha_final'])){
             $datos = array(
            'fecha'=>fecha_mysql,
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
        if(!empty($_GET['fecha_inicio']) && empty($_GET['fecha_final'])){
              $datos = array(
            'fecha'=>$_GET['fecha_inicio'],
        );
        $caja = Caja::whereV($datos, 'and');
        
        }
         if(!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_final'])){
              
        $caja = Caja::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        
        }
        $data = array();
        $total = 0;
        $pago = 0;
        $vuelto = 0;
        foreach ($caja as $value) {
             $total= $total+   $value['total'];
             $pago=$pago+   $value['pago'];
             $vuelto = $vuelto+  $value['vuelto'];       
          
        }
        $data=array(
        'total'=>number_format((float) $total, 2, '.', ','),
        'pago'=>number_format((float) $pago, 2, '.', ','),
        'vuelto'=>number_format((float) $vuelto, 2, '.', ','),    
        );
        echo json_encode($data,JSON_PRETTY_PRINT); 
    }
}
