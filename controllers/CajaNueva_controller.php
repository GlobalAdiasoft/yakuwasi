<?php
class CajaNueva_controller extends Controller {
    function abrir_caja() {
        $data = array(
            'usuario' => session::getValue('ID_TRA' . NOMBRE_SESSION),
            'fecha' => fecha_mysql
        );
        $caja = CajaNueva::whereV($data, 'and');
        if (empty($caja)) {
            $id            = null;
            $usuario       = session::getValue('ID_TRA' . NOMBRE_SESSION);
            $fecha         = fecha_mysql;
            $hora          = hora_mysql;
            $estado        = 0;
            $monto_inicial = $_POST['monto_inicial'];
            $monto_final   = '';
            $caja          = new CajaNueva($id, $usuario, $fecha, $hora, $estado, $monto_inicial, $monto_final);
            $caja->create();
        } else {
            foreach ($caja as $value) {
                $estado = $value['estado'];
            }
            switch ($estado) {
                case 1:
                    $id            = null;
                    $usuario       = session::getValue('ID_TRA' . NOMBRE_SESSION);
                    $fecha         = fecha_mysql;
                    $hora          = hora_mysql;
                    $estado        = 0;
                    $monto_inicial = $_POST['monto_inicial'];
                    $monto_final   = '';
                    $caja          = new CajaNueva($id, $usuario, $fecha, $hora, $estado, $monto_inicial, $monto_final);
                    $caja->create();
                    break;
            }
        }
    }
    function cerrar_caja() {
        $data = array(
            'usuario' => session::getValue('ID_TRA' . NOMBRE_SESSION),
            'fecha' => fecha_mysql
        );
        $caja = CajaNueva::whereV($data, 'and');
        if (!empty($caja)) {
            foreach ($caja as $value) {
                $id = $value['id'];
            }
            $caja2 = CajaNueva::getById($id);
            $caja2->setEstado(1);
            $caja2->setMonto_final($_POST['monto_final']);
            $caja2->update();
        }
    }
    function verificar_estado($datos = '') {
        $data = array(
            'usuario' => session::getValue('ID_TRA' . NOMBRE_SESSION),
            'fecha' => fecha_mysql
        );
        $caja = CajaNueva::whereV($data, 'and');
        if (empty($caja)) {
            if ($datos == 'r') {
                return 0;
            } else {
                echo 0;
            }
        } else {
            foreach ($caja as $value) {
                $estado = $value['estado'];
            }
            if ($estado == 1) {
                if ($datos == 'r') {
                    return 0;
                } else {
                    echo 0;
                }
            } else {
                if ($datos == 'r') {
                    return 1;
                } else {
                    echo 1;
                }
            }
        }
    }
    function mostrar_todas_cajas() {
        $caja = CajaNueva::getAll();
        $data = array();
        foreach ($caja as $value) {
            switch ($value['estado']) {
                case '0':
                    $estado = 'Abierto';
                    break;
                case '1':
                    $estado = 'Cerrado';
                    break;
            }
            $usuario = UsuariosG::getById($value['usuario']);
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "usuario" => mb_strtoupper($usuario->getUsuario()),
                "fecha" => mb_strtoupper($value['fecha']),
                "hora" => mb_strtoupper($value['hora']),
                "estado" => mb_strtoupper($estado),
                "monto_inicial" => mb_strtoupper($value['monto_inicial']),
                "monto_final" => mb_strtoupper($value['monto_final'])
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
