<?php
class Precios_controller extends Controller {
    function agregar() {
        $id                   = NULL;
        $id_lista             = 1;
        $id_articulo          = 1;
        $precio_compra_sinigv = 80.00;
        $precio_compra_conigv = 80.00;
        $precio_ventasinigv   = 50.00;
        $precio_ventaconigv   = 50.00;
        $min                  = 11;
        $max                  = 20;
        $precio               = new Precios($id, $id_lista, $id_articulo, $precio_compra_sinigv, $precio_compra_conigv, $precio_ventasinigv, $precio_ventaconigv, $min, $max);
        $precio->create();
    }
    function obtener_precio($lista, $articulo, $cantidad = 0) {
        $data_precios = array(
            'id_lista' => $lista,
            'id_articulo' => $articulo
        );
        $precio       = Precios::whereV($data_precios, 'and');
        foreach ($precio as $value) {
            if (in_array($cantidad, range($value['min'], $value['max']))) {
                $precio_sinigv = $value['precio_ventasinigv'];
                echo $precio_sinigv . '<br>';                
            } else {
                $articulos = Articulos::getById($articulo);
                echo $articulos->getArt_precio_ventasinigv() . '<br>';
            }
        }
    }
}
