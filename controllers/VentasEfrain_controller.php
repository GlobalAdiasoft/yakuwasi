<?php
class VentasEfrain_controller extends Controller {
    function reporte($dato) {
        if ($dato == 'all') {
            $ventas = Ventas::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        } else {
            $datos_ventas = array(
                'mesa' => $dato
            );
            $ventas       = Ventas::whereBetweenAnd($datos_ventas, 'and', 'fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        }
        $data = array();
        foreach ($ventas as $value) {
            array_push($data, array(
                'id_venta' => $value['id_venta'],
                'fecha_hora' => $value['fecha'] . ' ' . $value['hora'],
                'mesa' => mb_strtoupper($value['mesa']),
                'total_bruto' => 'S/ ' . number_format($value['total_bruto'], 2, '.', ','),
                'hecho_por'=>$value['hecho_por'],
                'num_boleta'=>$value['num_boleta'],
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function total($dato) {
        if ($dato == 'all') {
            $ventas = Ventas::whereBetween('fecha', $_POST['fecha_inicio'], $_POST['fecha_final']);
        } else {
            $datos_ventas = array(
                'mesa' => $dato
            );
            $ventas       = Ventas::whereBetweenAnd($datos_ventas, 'and', 'fecha', $_POST['fecha_inicio'], $_POST['fecha_final']);
        }
        $total = 0;
        foreach ($ventas as $value) {
            $total = $total + $value['total_bruto'];
        }
        $data = array(
            'total' => 'S/ ' . number_format($total, 2, '.', ','),
            'total_s' => $total,
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function totales_fechas() {
        if(empty($_GET['fecha_inicio']) && empty($_GET['fecha_final'])){
            $datos_json   = array();
          echo json_encode($datos_json, JSON_PRETTY_PRINT);
        }else{
        $inicio       = $_GET['fecha_inicio'];
        $final        = $_GET['fecha_final'];
        $datos_json   = array();
        $fecha_inicio = new DateTime($inicio);
        $fecha_final  = new DateTime($final);
        $diff         = $fecha_inicio->diff($fecha_final);
        ;
        $diff->days;
        for ($i = 0; $i <= $diff->days; $i++) {
            $fecha      = date($inicio);
            $nuevafecha = strtotime('+' . $i . ' day', strtotime($fecha));
            $nuevafecha = date('Y-m-j', $nuevafecha);
            $total_ingresos      = 0;
            $total_egresos      = 0;
            $ventas_e   = Ventas::where('fecha', $nuevafecha);
             $gastos = Gastos::where('fecha', $nuevafecha);
            foreach ($ventas_e as $value) {
                $total_ingresos = $total_ingresos + $value['total_bruto'];
            }
             foreach ($gastos as $value1) {
                $total_egresos = $total_egresos + $value1['costo_total'];
            }
           
            array_push($datos_json, array(
                 'fecha' => $nuevafecha,
                'total_ingresos' => $total_ingresos,                
                'total_egresos' => $total_egresos,
                'utilidad' =>$total_ingresos - $total_egresos,
               
            ));
        }
        echo json_encode($datos_json, JSON_PRETTY_PRINT);
    }
    }
     function reporte_gastos() {
     $gastos       = Gastos::whereBetween('fecha', $_GET['fecha_inicio'], $_GET['fecha_final']);
        
        $data = array();
        foreach ($gastos as $value) {
            array_push($data, array(
                'id' => $value['id'],
                'fecha_hora' => $value['fecha'],
                'mesa' => mb_strtoupper($value['impuesto']),
                'total_bruto' => 'S/ ' . number_format($value['costo_total'], 2, '.', ',')
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
        function total_gastos() {
       $gastos       = Gastos::whereBetween('fecha', $_POST['fecha_inicio'], $_POST['fecha_final']);
       $total = 0;
        foreach ($gastos as $value) {
            $total = $total + $value['costo_total'];
        }
        $data = array(
            'total' => 'S/ ' . number_format($total, 2, '.', ','),
             'total_s' => $total,
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    function convertir_moneda($data){
        $datos=array(
            'total'=>'S/ ' . number_format($data, 2, '.', ','),
        );
        echo json_encode($datos, JSON_PRETTY_PRINT);
    }
    function totales_fechas_cpanel() {
       
        $inicio       = date("Y").'-01-01';
        $final        = date("Y").'-12-31';
        $datos_json   = array();
        $fecha_inicio = new DateTime($inicio);
        $fecha_final  = new DateTime($final);
        $diff         = $fecha_inicio->diff($fecha_final);
        ;
        $diff->days;
        for ($i = 0; $i <= $diff->days; $i++) {
            $fecha      = date($inicio);
            $nuevafecha = strtotime('+' . $i . ' day', strtotime($fecha));
            $nuevafecha = date('Y-m-j', $nuevafecha);
            $total_ingresos      = 0;
            $total_egresos      = 0;
            $ventas_e   = Ventas::where('fecha', $nuevafecha);
             $gastos = Gastos::where('fecha', $nuevafecha);
            foreach ($ventas_e as $value) {
                $total_ingresos = $total_ingresos + $value['total_bruto'];
            }
             foreach ($gastos as $value1) {
                $total_egresos = $total_egresos + $value1['costo_total'];
            }
           
            array_push($datos_json, array(
                 'fecha' => $nuevafecha,
                'total_ingresos' => $total_ingresos,                
                'total_egresos' => $total_egresos,
                'utilidad' =>$total_ingresos - $total_egresos,
               
            ));
        }
        echo json_encode($datos_json, JSON_PRETTY_PRINT);
    }
     function total_cpanel($dato) {
        if ($dato == 'all') {
            $ventas = Ventas::whereBetween('fecha',  date("Y").'-01-01', date("Y").'-12-31');
        } else {
            $datos_ventas = array(
                'mesa' => $dato
            );
            $ventas       = Ventas::whereBetweenAnd($datos_ventas, 'and', 'fecha',  date("Y").'-01-01', date("Y").'-12-31');
        }
        $total = 0;
        foreach ($ventas as $value) {
            $total = $total + $value['total_bruto'];
        }
        return $total;
    }
     function total_gastos_cpanel() {
       $gastos       = Gastos::whereBetween('fecha',date("Y").'-01-01', date("Y").'-12-31');
       $total = 0;
        foreach ($gastos as $value) {
            $total = $total + $value['costo_total'];
        }
       
        return $total;
    }
    function reporte_utilidad_cpanel(){
        $total_all = $this->total_cpanel('all');
        $totales_gastos = $this->total_gastos_cpanel();
        $data=array(            
            'ingresos'=> number_format($total_all, 2, '.', ''),
            'egresos'=>number_format($totales_gastos, 2, '.', ''),
            'utilidades'=>number_format($total_all - $totales_gastos, 2, '.', ''),
        );
        echo json_encode($data,JSON_PRETTY_PRINT);
    }
    }

