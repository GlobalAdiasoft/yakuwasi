<?php
class Kardex_controller extends Controller {
    function traer_datos($bol_pedido_usuario, $documento, $correlativo, $observacion,$tipo) {
        $datos        = $bol_pedido_usuario;
        $datos        = explode('/', $datos);
        $usuarios     = Usuario::getBy('usu_usuario', $datos[1]);
        $id_usuario   = $usuarios->getId();
        $data_pedidos = array(
            'ped_id_pedidos_doc' => $datos[0],
            'ped_usuario' => $id_usuario
        );
        $pedidos      = Pedidos::whereV($data_pedidos, 'and');
        foreach ($pedidos as $value) {
            $articulos = Articulos::getById($value['ped_id_pro']);
            Kardex_controller::crear_kardex($value['ped_id_pro'], 0, $value['ped_cantidad'], $articulos->getArt_stock(), $documento, $correlativo, '', $observacion,$tipo);
        }
    }
    function crear_kardex($articulo, $ingreso, $salida, $saldo, $documento, $correlativo, $proveedor, $observaciones = '',$tipo) {
        $id      = null;
        $fecha   = fecha_mysql;
        $hora    = hora_mysql;
        $usuario = Session::getValue('ID_TRA'.NOMBRE_SESSION);
        $kardex   = new Kardex($id, $articulo, $fecha, $hora, $ingreso, $salida, $saldo, $usuario, $documento, $correlativo, $proveedor, $observaciones, $tipo);
        $kardex->create();
    }
    function mostrar_kardex() {
        //$kardex = Kardex::getall();
        $kardex = Kardex::where('articulo', $_GET['nrokardex']);
        //$kardex = Kardex::where('articulo',1);

        $data   = array();
        foreach ($kardex as $value) {
            $articulos = Articulos::getById($value['articulo']);
            $usuario = Usuario::getById($value['usuario']);
            $proveedor = Proveedores::where('id',$value['proveedor']);
            if(empty($proveedor)){
                $varproveedor = '';
            }else{
                $varproveedor =$proveedor[0]['pro_razonsocial'].' - '.$proveedor[0]['pro_ruc'];
            }
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "articulo" => mb_strtoupper($articulos->getArt_nombre()),
                "cod_articulo" => mb_strtoupper($articulos->getArt_codigo()),
                "fecha" => mb_strtoupper($value['fecha']),
                "hora" => mb_strtoupper($value['hora']),
                "ingreso" => mb_strtoupper($value['ingreso']),
                "salida" => mb_strtoupper($value['salida']),
                "saldo" => mb_strtoupper($value['saldo']),
                "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                "documento" => $value['documento'],
                "correlativo" => $value['correlativo'],
                "proveedor" => $varproveedor,
                "observaciones" => mb_strtoupper($value['observaciones'])
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    public function kardex_inicial() {
        $articulos = Articulos::getAll();
        foreach ($articulos as $value) {
            $articulos1 = Articulos::getById($value['id']);
            Kardex_controller::crear_kardex($value['id'], $value['art_stock'], 0, $value['art_stock'], '', '', '', 'módulo [ generado automaticamente ]');
        }
    }
        function mostrar_kardex2() {
        //$kardex = Kardex::getall();
        $kardex = Kardex::getAll();
        //$kardex = Kardex::where('articulo',1);

        $data   = array();
        foreach ($kardex as $value) {
            $articulos = Articulos::getById($value['articulo']);
            $usuario = Usuario::getById($value['usuario']);
            $proveedor = Proveedores::where('id',$value['proveedor']);
            if(empty($proveedor)){
                $varproveedor = '';
            }else{
                $varproveedor =$proveedor[0]['pro_razonsocial'].' - '.$proveedor[0]['pro_ruc'];
            }
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "articulo" => mb_strtoupper($articulos->getArt_nombre()),
                "cod_articulo" => mb_strtoupper($articulos->getArt_codigo()),
                "fecha" => mb_strtoupper($value['fecha']),
                "hora" => mb_strtoupper($value['hora']),
                "ingreso" => mb_strtoupper($value['ingreso']),
                "salida" => mb_strtoupper($value['salida']),
                "saldo" => mb_strtoupper($value['saldo']),
                "usuario" => mb_strtoupper($usuario->getUsu_usuario()),
                "documento" => $value['documento'],
                "correlativo" => $value['correlativo'],
                "proveedor" => $varproveedor,
                "observaciones" => mb_strtoupper($value['observaciones'])
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
