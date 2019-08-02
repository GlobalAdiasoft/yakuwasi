<?php
class Articulos_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function upload_especificacion() {
        mkdir(URLIMG . "uploads/especificacion/" . $_POST['archivo'], 0777);
        $output_dir = URLIMG . "uploads/especificacion/" . $_POST['archivo'] . "/";
        if (isset($_FILES["especificaciontecnica"])) {
            $ret   = array();
            //	This is for custom errors;	
            /*	$custom_error= array();
            $custom_error['jquery-upload-file-error']="File already exists";
            echo json_encode($custom_error);
            die();
            */
            $error = $_FILES["especificaciontecnica"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if (!is_array($_FILES["especificaciontecnica"]["name"])) //single file
                {
                $fileName = $_FILES["especificaciontecnica"]["name"];
                move_uploaded_file($_FILES["especificaciontecnica"]["tmp_name"], $output_dir . $fileName);
                $ret[] = $fileName;
            } else //Multiple files, file[]
                {
                $fileCount = count($_FILES["especificaciontecnica"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["especificaciontecnica"]["name"][$i];
                    move_uploaded_file($_FILES["especificaciontecnica"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                }
            }
            echo json_encode($ret);
        }
    }
    public function upload_imagen() {
        mkdir(URLIMG . "uploads/imagen/" . $_POST['archivo'], 0777);
        $output_dir = URLIMG . "uploads/imagen/" . $_POST['archivo'] . "/";
        if (isset($_FILES["imagen"])) {
            $ret   = array();
            //	This is for custom errors;	
            /*	$custom_error= array();
            $custom_error['jquery-upload-file-error']="File already exists";
            echo json_encode($custom_error);
            die();
            */
            $error = $_FILES["imagen"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if (!is_array($_FILES["imagen"]["name"])) //single file
                {
                $fileName = $_FILES["imagen"]["name"];
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $output_dir . $fileName);
                $ret[] = $fileName;
            } else //Multiple files, file[]
                {
                $fileCount = count($_FILES["imagen"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["imagen"]["name"][$i];
                    move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                }
            }
            echo json_encode($ret);
        }
    }
    public function agregar() {
        $id             = null;
        $art_familia    = $_POST['familia'];
        $art_codusuario = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $art_fechaalta  = date(fecha_mysql);
        ;
        $art_nombre                = $_POST['nombre'];
        $art_fabricante            = empty($_POST['fabricante'])?'':$_POST['fabricante'];
        $art_especificaciontecnica = $_POST['cod_articulo'];
        $art_stockminimo           = $_POST['stockminimo'];
        $art_descripcion           = $_POST['descripcion'];
        $art_imagen                = $_POST['cod_articulo'];
        $art_marca                 = $_POST['marca'];
        $art_unidadmedida          = $_POST['unidad_medida'];
        $art_estado                = $_POST['estado'];
        $art_proveedor             = $_POST['proveedor'];
        $art_impuesto              = $_POST['impuesto'];
        
        $art_ganancia              = $_POST['ganancia'];
        $art_precio_compra_sinigv  = $_POST['produ_precio_compra_sinigv'];
        $art_precio_compra_conigv  = $_POST['produ_precio_compra_conigv'];
        $art_precio_ventasinigv    = $_POST['produ_precio_ventasinigv'];
        $art_precio_ventaconigv    = $_POST['produ_precio_ventaconigv'];
        
        $art_codbarras             = $_POST['codbarras'];
        $art_codigo                = $_POST['cod_articulo'];
        $art_stock                 = $_POST['stock'];
        $art_ubicacion             = $_POST['ubicacion'];
        $art_moneda                = $_POST['moneda'];
        $verificacion              = Articulos::getBy('art_nombre', $art_nombre);
        if (!empty($verificacion)) {
            echo 0;
            exit;
        }
        $articulos = new Articulos($id, $art_familia, $art_codusuario, $art_fechaalta, $art_nombre, $art_fabricante, $art_especificaciontecnica, $art_stockminimo, $art_descripcion, $art_imagen, $art_marca, $art_unidadmedida, $art_estado, $art_proveedor, $art_impuesto, $art_ganancia, $art_precio_compra_sinigv, $art_precio_compra_conigv, $art_precio_ventasinigv, $art_precio_ventaconigv, $art_codbarras, $art_codigo, $art_stock, $art_ubicacion, $art_moneda);
        $articulos->create();
        echo 1;
        rename(URLIMG . "uploads/especificacion/" . $art_imagen, URLIMG . "uploads/especificacion/aprobado_" . $art_especificaciontecnica);
        rename(URLIMG . "uploads/imagen/" . $art_imagen, URLIMG . "uploads/imagen/aprobado_" . $art_imagen);
        $articulos= Articulos::getBy('art_codigo', $_POST['cod_articulo']);
        Kardex_controller::crear_kardex($articulos->getId(),$art_stock,0,$art_stock,'','','','módulo [ agregar artculo ]');

    }
    public function mostrar() {
   $articulos = Articulos::getAll();
        $data      = array();
        foreach ($articulos as $value) {
            $familias = Familias::where('id', $value['art_familia']);
            if (empty($familias)) {
                $art_familia = 'no se encontro familia';
            } else {
                $art_familia = $familias[0]['fam_nombre'];
            }
            $usuario = Usuario::where('id', $value['art_codusuario']);
            if (empty($usuario)) {
                $art_codusuario = 'no se encontro usuario';
            } else {
                $art_codusuario = $usuario[0]['usu_usuario'];
            }
            $fabricante = Fabricantes::where('id', $value['art_fabricante']);
            if (empty($fabricante)) {
                $art_fabricante = 'no se encontro fabricante';
            } else {
                $art_fabricante = $fabricante[0]['fabri_nombre'];
            }
            $especificacion = $this->listar_pdf($value['art_especificaciontecnica']);
            $imagenes       = $this->listar_img($value['art_imagen']);
            $marca          = Marcas::where('id', $value['art_marca']);
            if (empty($marca)) {
                $art_marca = 'no se encontro marca';
            } else {
                $art_marca = $marca[0]['mar_nombre'];
            }
            $unidad_medida = Unidades_medida::where('id', $value['art_unidadmedida']);
            if (empty($unidad_medida)) {
                $art_unidadmedida = 'no se encontro unidad de medida';
            } else {
                $art_unidadmedida = $unidad_medida[0]['uni_nombre'] . ' (<small>' . $unidad_medida[0]['uni_simbolo'] . '</small>)';
            }
            $proveedor = Proveedores::where('id', $value['art_proveedor']);
            if (empty($proveedor)) {
                $art_proveedor = 'no se encontro proveedor';
            } else {
                $art_proveedor = $proveedor[0]['pro_razonsocial'] . ' - ' . $proveedor[0]['pro_ruc'];
            }
            if ($value['art_moneda'] == 'PEN') {
                $simbolo = 'S/ ';
            }
            if ($value['art_moneda'] == 'USD') {
                $simbolo = 'US$ ';
            }
            //$imagencodigo = Barcode_controller::generar2($value['art_codbarras']);
            $imagencodigo = '';
            switch ($value['art_stock']) {
                case ($value['art_stockminimo'] <= $value['art_stock']):
                    $stock = '<p style="color:green;">' . $value['art_stock'] . '</p>';
                    break;
                case ($value['art_stockminimo'] >= $value['art_stock']):
                    $stock = '<p style="color:red;">' . $value['art_stock'] . '</p>';
                    break;
                default:
                    break;
            }
            array_push($data, array(
          'id' => $value['id'],
                'art_familia' => mb_strtoupper($art_familia),
                'art_codusuario' => mb_strtoupper($art_codusuario),
                'art_fechaalta' => mb_strtoupper($value['art_fechaalta']),
                'art_nombre' => mb_strtoupper($value['art_nombre']),
                'art_fabricante' => mb_strtoupper($art_fabricante),
                'art_especificaciontecnica' => $especificacion,
                'art_stockminimo' => mb_strtoupper($value['art_stockminimo']),
                'art_descripcion' => mb_strtoupper($value['art_descripcion']),
                'art_imagen' => $imagenes,
                'art_marca' => mb_strtoupper($art_marca),
                'art_unidadmedida' => mb_strtoupper($art_unidadmedida),
                'art_estado' => mb_strtoupper($value['art_estado'] == 0 ? 'Desactivo' : 'Activo'),
                'art_proveedor' => mb_strtoupper($art_proveedor),
                'art_impuesto' => mb_strtoupper($value['art_impuesto'] . '%'),
                'art_ganancia' => mb_strtoupper($value['art_ganancia'] . '%'),
                'art_precio_compra_sinigv' => mb_strtoupper($simbolo . number_format((float) $value['art_precio_compra_sinigv'], 2, '.', ',')),
                'art_precio_compra_conigv' => mb_strtoupper($simbolo . number_format((float) $value['art_precio_compra_conigv'], 2, '.', ',')),
                'art_precio_ventasinigv' => mb_strtoupper($simbolo . number_format((float) $value['art_precio_ventasinigv'], 2, '.', ',')),
                'art_precio_ventaconigv' => mb_strtoupper($simbolo . number_format((float) $value['art_precio_ventaconigv'], 2, '.', ',')),
                'art_codbarras' => mb_strtoupper($imagencodigo),
                'art_codigo' => mb_strtoupper($value['art_codigo']),
                'art_stock' => mb_strtoupper($stock),
                'art_ubicacion' => mb_strtoupper($value['art_ubicacion'] == 1 ? 'Almacen Principal' : 'Error'),
                'art_moneda' => mb_strtoupper($value['art_moneda']),
            
            ));
        }
        echo json_encode($data);
    }
    public function listar_pdf($data) {
        if (file_exists(URLIMG . "uploads/especificacion/aprobado_" . $data)) {
            $directorio = opendir(URLIMG . "uploads/especificacion/aprobado_" . $data); //ruta actual
            $datos      = '';
            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                {
                if (is_dir($archivo)) //verificamos si es o no un directorio
                    {
                    //return "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
                } else {
                    $datos = '<a href="' . URL . URLIMG . "uploads/especificacion/aprobado_" . $data . '/' . $archivo . '">' . $archivo . '</a></br>' . $datos;
                }
            }
            return '<br>' . $datos;
        } else {
            $datos = '';
            return $datos;
        }
    }
    public function listar_img($data) {
        if (file_exists(URLIMG . "uploads/imagen/aprobado_" . $data)) {
            $directorio = opendir(URLIMG . "uploads/imagen/aprobado_" . $data); //ruta actual
            $datos      = '<br>';
            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                {
                if (is_dir($archivo)) //verificamos si es o no un directorio
                    {
                    //return "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
                } else {
                    $datos = $datos . '<img class="img_art" src="' . URL . URLIMG . "uploads/imagen/aprobado_" . $data . '/' . $archivo . '">';
                }
            }
            return $datos;
        } else {
            $datos = '';
            return $datos;
        }
    }
    public function eliminar() {
        $id        = $_POST['id'];
        $articulos = Articulos::getById($id);
        $articulos->delete();
    }
    public function llamar_codpro() {
        $articulos = Articulos::getAll();
        print_r($articulos);
        foreach ($articulos as $value) {
            echo '<option value="' . $value['art_codigo'] . '|' . $value['art_nombre'] . '">['.number_format((float) $value['art_precio_ventaconigv'], 2, '.', '').'] - ['.$value['art_stock'].']</option>';
        }
    }
    public function modificar(){
         $articulos = Articulos::getById($_POST['id']);
       
      
        $articulos->setArt_familia($_POST['familia']);
        $articulos->setArt_nombre($_POST['nombre']);
        $articulos->setArt_fabricante($_POST['fabricante']);
        $articulos->setArt_stockminimo($_POST['stockminimo']);
        $articulos->setArt_descripcion($_POST['descripcion']);
        $articulos->setArt_marca($_POST['marca']);
        $articulos->setArt_unidadmedida($_POST['unidad_medida']);
        $articulos->setArt_estado($_POST['estado']);
        $articulos->setArt_proveedor($_POST['proveedor']);
        $articulos->setArt_impuesto($_POST['impuesto']);
        
        $articulos->setArt_ganancia($_POST['ganancia']);
        $articulos->setArt_precio_compra_sinigv($_POST['produ_precio_compra_sinigv']);
        $articulos->setArt_precio_compra_conigv($_POST['produ_precio_compra_conigv']);
        $articulos->setArt_precio_ventasinigv($_POST['produ_precio_ventasinigv']);
        $articulos->setArt_precio_ventaconigv($_POST['produ_precio_ventaconigv']);
        
        $articulos->setArt_codbarras($_POST['codbarras']);
        $articulos->setArt_codigo($_POST['cod_articulo']);
        $articulos->setArt_stock($_POST['stock']);
        $articulos->setArt_ubicacion($_POST['ubicacion']);
        $articulos->setArt_moneda($_POST['moneda']);
        
        $articulos->update();
        echo 1;
    }
      public function mostrar_articulo() {
        $articulos = Articulos::where('id', $_POST['id']);
        echo json_encode($articulos);
    }
    public function modificar_especificaciones(){
        $articulos = Articulos::getBy('id', $_POST['id']);
        echo json_encode($this->listar_pdf2($articulos->getArt_especificaciontecnica()),JSON_PRETTY_PRINT);
    }
       public function listar_pdf2($data) {
        if (file_exists(URLIMG . "uploads/especificacion/aprobado_" . $data)) {
            $directorio = opendir(URLIMG . "uploads/especificacion/aprobado_" . $data); //ruta actual
               $datos=array(
                   'id'=>'id',
                   'archivos'=>array(),
                   );
            
            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                {
                if (is_dir($archivo)) //verificamos si es o no un directorio
                    {
                    //return "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
                } else {
array_push($datos['archivos'], array('nombre'=>$archivo));

                }
                
            }
          return $datos;
        } else {
            $datos = '';
            return $datos;
        }
    }
       public function restar_art($pedido, $usuario) {
        $data_pedido = array(
            "ped_id_pedidos_doc" => $pedido,
            "ped_usuario" => $usuario
        );
        $pedido      = Pedidos::whereV($data_pedido, 'and');
        foreach ($pedido as $value) {
            $articulo = Articulos::getById($value['ped_id_pro']);
            $resta    = $articulo->getArt_stock() - $value['ped_cantidad'];
            $articulo->setArt_stock($resta);
            $articulo->update();
        }
    }
    public function facturado($pedido, $usuario){
        $datos=array(
            'ped_cod_ped'=>$pedido,
            'ped_usuario'=>$usuario,
        );
        $pedidos_doc = PedidosDoc::getByData($datos, 'and');
        $pedidos_doc->setPed_facturado(1);
        $pedidos_doc->update();
        
    }
}

