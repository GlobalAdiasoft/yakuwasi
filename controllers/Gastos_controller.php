<?php
class Gastos_controller extends Controller {
    function crear() {
        
        $id                  = null;
        $fecha               = $_POST['fecha'];
        $impuesto            = $_POST['impuesto'];
        $costo_total         = $_POST['costo_total'];
        $costo               = $_POST['costo'];
        $porcentaje_impuesto = $_POST['porcentaje_impuesto'];
        $descripcion         = $_POST['descripcion'];
        $usuario             = Session::getValue('ID_TRA' . NOMBRE_SESSION);
        $razon               = $_POST['razon'];
        $categoria           = $_POST['categoria'];
        $documento           = $_POST['documento'];
        $correlativo         = $_POST['correlativo'];
        $numero              = $_POST['numero'];
        $proveedor           = $_POST['proveedor'];
        $aprobado            = $_POST['aprobado'];
        $nota                = $_POST['nota'];
        $retiro              = $_POST['retiro'];
        $condicion           = 0;
        $gastos              = new Gastos($id, $fecha, $impuesto, $costo_total, $costo, $porcentaje_impuesto, $descripcion, $usuario, $razon, $categoria, $documento, $correlativo, $numero, $proveedor, $aprobado, $nota, $retiro, $condicion);
        $gastos->create();
        $descripcion_total = $_POST['descripcion'] . ' | ' . $_POST['categoria'] . ' | ' . $_POST['documento'] . ' | ' . $_POST['correlativo'] . ' | ' . $_POST['numero'];
        Caja2_controller::crear('Gastos - [ Gastos ]', $descripcion_total, 'EFECTIVO', 0, $costo_total);
    }
    function mostrar() {
        if (empty($_GET['fecha_incio']) && empty($_GET['fecha_final'])) {
            $datos  = array(
                'fecha' => fecha_mysql
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (empty($_GET['fecha_incio']) && !empty($_GET['fecha_final'])) {
            $datos  = array(
                'fecha' => fecha_mysql
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && empty($_GET['fecha_final'])) {
            $datos  = array(
                'fecha' => $_GET['fecha_inicio']
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (!empty($_GET['fecha_inicio']) && !empty($_GET['fecha_final'])) {
            $gastos = Gastos::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        }
        $data = array();
        foreach ($gastos as $value) {
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "fecha" => mb_strtoupper($value['fecha']),
                "impuesto" => mb_strtoupper($value['impuesto']),
                "costo_total" => mb_strtoupper($value['costo_total']),
                "costo" => mb_strtoupper($value['costo']),
                "porcentaje_impuesto" => mb_strtoupper($value['porcentaje_impuesto']),
                "descripcion" => mb_strtoupper($value['descripcion']),
                "usuario" => mb_strtoupper($value['usuario']),
                "razon" => mb_strtoupper($value['razon']),
                "categoria" => mb_strtoupper($value['categoria']),
                "documento" => mb_strtoupper($value['documento']),
                "correlativo" => mb_strtoupper($value['correlativo']),
                "numero" => mb_strtoupper($value['numero']),
                "proveedor" => mb_strtoupper($value['proveedor']),
                "aprobado" => mb_strtoupper($value['aprobado']),
                "nota" => mb_strtoupper($value['nota']),
                "retiro" => mb_strtoupper($value['retiro']),
                "condicion" => mb_strtoupper($value['condicion'])
            ));
        }
        echo json_encode($data);
    }
    function mostrar_proveedores() {
        $proveedores = Proveedores::getAll();
        foreach ($proveedores as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['pro_razonsocial'] . '</option>';
        }
    }
    function mostrar_empleados() {
        $user = Usuario::getAll();
        foreach ($user as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['usu_nombres'] . ' ' . $value['usu_apellidos'] . '</option>';
        }
    }
    function eliminar() {
        $id     = $_POST['id'];
        $gastos = Gastos::getById($id);
        $gastos->delete();
    }
    function mostrar_gasto() {
        $gastos = Gastos::where('id', $_POST['id']);
        echo json_encode($gastos);
    }
    function modificar() {
        $gastos = Gastos::getById($_POST['id']);
        $gastos->setFecha($_POST['fecha']);
        $gastos->setImpuesto($_POST['impuesto']);
        $gastos->setCosto_total($_POST['costo_total']);
        $gastos->setCosto($_POST['costo']);
        $gastos->setPorcentaje_impuesto($_POST['porcentaje_impuesto']);
        $gastos->setDescripcion($_POST['descripcion']);
        $gastos->setRazon($_POST['razon']);
        $gastos->setCategoria($_POST['categoria']);
        $gastos->setDocumento($_POST['documento']);
        $gastos->setCorrelativo($_POST['correlativo']);
        $gastos->setNumero($_POST['numero']);
        $gastos->setProveedor($_POST['proveedor']);
        $gastos->setAprobado($_POST['aprobado']);
        $gastos->setNota($_POST['nota']);
        $gastos->setRetiro($_POST['retiro']);
        $gastos->update();
    }
    function mostrar_totales() {
        if (empty($_POST['fecha_inicio']) && empty($_POST['fecha_final'])) {
            $datos  = array(
                'fecha' => fecha_mysql
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (empty($_POST['fecha_inicio']) && !empty($_POST['fecha_final'])) {
            $datos  = array(
                'fecha' => fecha_mysql
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (!empty($_POST['fecha_inicio']) && empty($_POST['fecha_final'])) {
            $datos  = array(
                'fecha' => $_POST['fecha_inicio']
            );
            $gastos = Gastos::whereV($datos, 'and');
        }
        if (!empty($_POST['fecha_inicio']) && !empty($_POST['fecha_final'])) {
            $gastos = Gastos::whereBetween('fecha', $_POST['fecha_inicio'], $_POST['fecha_final']);
        }
        $data        = array();
        $costo_total = 0;
        $costo       = 0;
        foreach ($gastos as $value) {
            $costo_total = $costo_total + $value['costo_total'];
            $costo       = $costo + $value['costo'];
        }
        $data = array(
            'costo_total' => number_format((float) $costo_total, 2, '.', ','),
            'costo' => number_format((float) $costo, 2, '.', ',')
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
   
}
        