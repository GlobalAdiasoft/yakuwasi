<?php
class Paquetes_controller extends Controller {
    function precio($var_cantidad,$var_articulo) {
        $cantidad = $var_cantidad;
        $articulo = Articulos::getById($var_articulo);
        $paquetes = Paquetes::where('id_articulo', $var_articulo);
        if ($cantidad == 1) {
            $precio = $articulo->getArt_precio_ventasinigv();
        } else {
            foreach ($paquetes as $value) {
                if ($value['cantidad'] <= $var_cantidad) {
                    $precio = $value['precio'];
                    $descripcion = $value['descripcion'];
                }
            }
        }
        if (!isset($precio)) {
            $precio = $articulo->getArt_precio_ventasinigv();
        }if (!isset($descripcion)) {
            $descripcion = '';
        }
        $data = array(
            'cantidad'=>$var_cantidad,
            'precio' => $precio,
            'descripcion' => $descripcion,
        );
        echo json_encode($data);
    }
    function mostrar() {
        $codigo = explode('|', $_POST['codigo']);
        $articulo = Articulos::getBy('art_codigo',$codigo[0]);
        $paquetes = Paquetes::where('id_articulo', $articulo->getId());
        $data     = array();
        foreach ($paquetes as $value) {
            array_push($data, array(
                'id' => strtoupper($value['id']),
                'id_articulo' => strtoupper($value['id_articulo']),
                'descripcion' => strtoupper($value['descripcion']),
                'cantidad' => strtoupper($value['cantidad']),
                'precio' => strtoupper($value['precio'])
            ));
        }
        echo json_encode($data);
    }
}
