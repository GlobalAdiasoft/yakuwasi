<?php
class Caja2_controller extends Controller
{
    public function crear($modulo, $descripcion, $tipo_pago, $ingreso = 0, $salida = 0)
    {
        $id      = null;
        $usuario = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $fecha   = fecha_mysql;
        $hora    = hora_mysql;
        $caja2   = new Caja2($id, $usuario, $fecha, $hora, $modulo, $descripcion, $tipo_pago, $ingreso, $salida);
        $caja2->create();
    }
    public function mostrar()
    {
        if (empty($_GET['fecha_incio']) && empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => fecha_mysql
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (empty($_GET['fecha_incio']) && !empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => fecha_mysql
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => $_GET['fecha_inicio']
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_final']))
        {
            $caja2 = Caja2::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        }
        $data = array();
        foreach ($caja2 as $value)
        {
            $usuario = Usuario::getById($value['usuario']);
              if($value['tipo_pago']=='VISA'){
                         array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                "fecha" => $value['fecha'] . ' | ' . $value['hora'],
                "modulo" => mb_strtoupper($value['modulo']),
                "descripcion" => mb_strtoupper($value['descripcion']),
                "tipo_pago" => mb_strtoupper($value['tipo_pago']),
                "visa" => mb_strtoupper(number_format((float) $value['ingreso'], 2, '.', ',')),
                "ingreso" => "0.00",
                "salida" => mb_strtoupper(number_format((float) $value['salida'], 2, '.', ','))
            ));
            }else{
           array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                "fecha" => $value['fecha'] . ' | ' . $value['hora'],
                "modulo" => mb_strtoupper($value['modulo']),
                "descripcion" => mb_strtoupper($value['descripcion']),
                "tipo_pago" => mb_strtoupper($value['tipo_pago']),
                "visa" => "0.00",
                "ingreso" => mb_strtoupper(number_format((float) $value['ingreso'], 2, '.', ',')),
                "salida" => mb_strtoupper(number_format((float) $value['salida'], 2, '.', ','))
            ));
            }
      
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function mostrar_totales()
    {
        if (empty($_GET['fecha_incio']) && empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => fecha_mysql
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (empty($_GET['fecha_incio']) && !empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => fecha_mysql
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && empty($_GET['fecha_final']))
        {
            $datos = array(
                'fecha' => $_GET['fecha_inicio']
            );
            $caja2 = Caja2::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_final']))
        {
            $caja2 = Caja2::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        }
        $data    = array();
        $ingreso = 0;
        $salida  = 0;
        $visa = 0;
        foreach ($caja2 as $value)
        {
            if($value['tipo_pago']=='VISA'){
                     $visa = $visa + $value['ingreso'];
            }else{
                 $ingreso = $ingreso + $value['ingreso'];
            }
           
            $salida  = $salida + $value['salida'];
        }
        $data = array(
            'ingreso' => number_format((float) $ingreso, 2, '.', ','),
            'salida' => number_format((float) $salida, 2, '.', ','),
            'visa' => number_format((float) $visa, 2, '.', ','),
            'saldo' => number_format((float) $ingreso - $salida, 2, '.', ',')
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
