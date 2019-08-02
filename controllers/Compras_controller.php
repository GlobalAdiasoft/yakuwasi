<?php
class Compras_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function agregar() {
        $id                   = null;
        $factura              = $_POST['numero_factura'];
        $proveedor            = $_POST['proveedor'];
        $producto             = $_POST['articulo'];
        $cantidad             = $_POST['cantidad'];
        $moneda               = $_POST['moneda'];
        $precio_compra_conigv = $_POST['produ_precio_ventaconigv'];
        $precio_compra_sinigv = $_POST['produ_precio_ventasinigv'];
        $precio_total         = $_POST['precio_total'];
        $fecha_hora           = fecha_mysql;
        $usuario              = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $compra               = new Compras($id, $factura, $proveedor, $producto, $cantidad, $moneda, $precio_compra_conigv, $precio_compra_sinigv, $precio_total, $fecha_hora, $usuario);
        $compra->create();
        $articulos = Articulos::getById($producto);
        $articulos->setArt_stock($articulos->getArt_stock() + $cantidad);
        $articulos->update();
        $articulos = Articulos::getById($producto);
        Kardex_controller::crear_kardex($producto, $cantidad, 0, $articulos->getArt_stock(), $factura, $factura, $proveedor, 'módulo [ compras ]', 'c');
    }
    public function mostrar() {
        if (empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
            $compras = Compras::getAll();
            //echo 'todos vacios';
        } else {
            //echo 'uno de ellos esta llenos<br>';
            if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                // echo 'fechas llenas y busqueda vacia<br>';
                $compras = Compras::whereBetween('fecha_hora', $_GET['fechainicio'], $_GET['fechafinal']);
            }
            if (empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::getAll();
            }
            if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::getAll();
            }
            if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas llenas y busqueda llenas<br>';
                $data_compras = array(
                    'producto' => $_GET['pro_busqueda']
                );
                $compras      = Compras::whereBetweenAnd($data_compras, 'and', 'fecha_hora', $_GET['fechainicio'], $_GET['fechafinal']);
            }
        }
        $data = array();
        foreach ($compras as $value) {
            $proveedor = Proveedores::getById($value['proveedor']);
            $articulo  = Articulos::getById($value['producto']);
            $usuarios  = Usuario::getById($value['usuario']);
            if ($value['moneda'] == 'PEN') {
                $simbolo = 'S/ ';
            } else if ($value['moneda'] == 'USD') {
                $simbolo = 'USD ';
            } else {
                $simbolo = '';
            }
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "factura" => mb_strtoupper($value['factura']),
                "proveedor" => $proveedor->getPro_ruc() . ' - ' . $proveedor->getPro_razonsocial(),
                "producto" => mb_strtoupper($articulo->getArt_nombre() . ' - ' . $articulo->getArt_codigo()),
                "cantidad" => mb_strtoupper($value['cantidad']),
                "moneda" => mb_strtoupper($value['moneda']),
                "precio_compra_conigv" => $simbolo . number_format((float) $value['precio_compra_conigv'], 2, '.', ','),
                "precio_compra_sinigv" => $simbolo . number_format((float) $value['precio_compra_sinigv'], 2, '.', ','),
                "total" => $simbolo . number_format((float) $value['precio_compra_conigv'] * $value['cantidad'], 2, '.', ','),
                "fecha_hora" => mb_strtoupper($value['fecha_hora']),
                "usuario" => mb_strtoupper($usuarios->getUsu_usuario())
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
  
    public function mostrar_select() {
        $articulos = Articulos::getAll();
        foreach ($articulos as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['art_nombre'] . ' - ' . $value['art_codigo'] . '</option>';
        }
    }
    public function eliminar() {
        $compras   = Compras::getById($_POST['id']);
        $articulos = Articulos::getById($compras->getProducto());
        $articulos->setArt_stock($articulos->getArt_stock() - $compras->getCantidad());
        $articulos->update();
        $id      = $_POST['id'];
        $compras = Compras::getById($id);
        $compras->delete();
    }
    public function mostrar_compras() {
        $compras = Compras::where('id', $_POST['id']);
        echo json_encode($compras);
    }
    public function modificar() {
        $compras   = Compras::getById($_POST['id']);
        $articulos = Articulos::getById($compras->getProducto());
        $articulos->setArt_stock($articulos->getArt_stock() - $compras->getCantidad() + $_POST['cantidad']);
        $articulos->update();
        $compras = Compras::getById($_POST['id']);
        $compras->setFactura($_POST['numero_factura']);
        $compras->setProveedor($_POST['proveedor']);
        $compras->setProducto($_POST['articulo']);
        $compras->setCantidad($_POST['cantidad']);
        $compras->setMoneda($_POST['moneda']);
        $compras->setPrecio_compra_conigv($_POST['produ_precio_ventaconigv']);
        $compras->setPrecio_compra_sinigv($_POST['produ_precio_ventasinigv']);
        $compras->update();
    }
    public function item_valorizado() {
        if (empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
            $compras = Compras::getAll();
            //echo 'todos vacios';
        } else {
            //echo 'uno de ellos esta llenos<br>';
            if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                // echo 'fechas llenas y busqueda vacia<br>';
                $compras = Compras::whereBetween('fecha_hora', $_GET['fechainicio'], $_GET['fechafinal']);
            }
            if (empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::where('producto', $_GET['pro_busqueda']);
            }
            if (!empty($_GET['fechainicio']) && empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::getAll();
            }
            if (empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && empty($_GET['pro_busqueda'])) {
                //echo 'fechas vacias y busqueda llenas<br>';
                $compras = Compras::getAll();
            }
            if (!empty($_GET['fechainicio']) && !empty($_GET['fechafinal']) && !empty($_GET['pro_busqueda'])) {
                //echo 'fechas llenas y busqueda llenas<br>';
                $data_compras = array(
                    'producto' => $_GET['pro_busqueda']
                );
                $compras      = Compras::whereBetweenAnd($data_compras, 'and', 'fecha_hora', $_GET['fechainicio'], $_GET['fechafinal']);
            }
        }
        $datos_json = array();
        $cantidad   = 0;
        $total      = 0;
        foreach ($compras as $value) {
            if ($value['moneda'] == 'PEN') {
                $simbolo = 'S/ ';
            } else if ($value['moneda'] == 'USD') {
                $simbolo = 'USD ';
            } else {
                $simbolo = '';
            }
            $cantidad = $cantidad + $value['cantidad'];
            $totales_ = $value['cantidad'] * $value['precio_compra_conigv'];
            $total    = $total + $totales_;
        }
        $valor                  = $total / $cantidad;
        //echo $cantidad.'<br>';
        //echo $total.'<br>';
        //echo $valor;
        $datos_json['cantidad'] = $cantidad;
        $datos_json['total']    = $simbolo . number_format((float) $total, 2, '.', ',');
        $datos_json['valor']    = $simbolo . number_format((float) $valor, 2, '.', ',');
        echo json_encode($datos_json, JSON_PRETTY_PRINT);
    }
    public function productos_busqueda() {
        $compras = Compras::getAll();
        foreach ($compras as $value) {
            $articulos = Articulos::getById($value['producto']);
            echo '<option value="' . $value['producto'] . '">' . $articulos->getArt_codigo() . ' - ' . $articulos->getArt_nombre() . '</option>';
        }
    }
  
}