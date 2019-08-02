<?php
class Plecompras_controller extends Controller {
    public function crear($fecha_emision,$fecha_vencimiento,$tipo_comprobante,$serie,$numero,$tipo_doc,$numero_doc,$razon_social) {
        $id         = null;
        $plec_1     = ''; //Periodo
        $plec_2     = ''; //Número correlativo del Registro o código único de la operación
        $plec_3     = $fecha_emision; //Fecha de emisión del comprobante de pago o documento
        $plec_4     = $fecha_vencimiento; //Fecha de Vencimiento o Fecha de Pago
        $plec_5     = $tipo_comprobante; //Tipo de Comprobante de Pago o Documento
        $plec_6     = $serie; //Serie del comprobante de pago o documento. En los casos de la Declaración Única de Aduanas (DUA) o de la Declaración Simplificada de Importación (DSI) se consignará el código de la dependencia Aduanera.
        $plec_7     = ''; //Año de emisión de la DUA o DSI
        $plec_8     = $numero; //Número del comprobante de pago o documento o número de orden del formulario físico o virtual donde conste el pago del impuesto.
        $plec_9     = ''; //En caso de optar por anotar el importe total de las operaciones diarias que no otorguen derecho a crédito fiscal en forma consolidada, registrar el número inicial
        $plec_10    = $tipo_doc; //Tipo de Documento de Identidad del proveedor
        $plec_11    = $numero_doc; //Número de RUC del proveedor o número de documento de Identidad, según corresponda.
        $plec_12    = $razon_social; //Apellidos y nombres, denominación o razón social  del proveedor. En caso de personas naturales se debe consignar los datos en el siguiente orden: apellido paterno, apellido materno y nombre completo.
        $plec_13    = ''; //Base imponible de las adquisiciones gravadas que dan derecho a crédito fiscal y/o saldo a favor por exportación, destinadas exclusivamente a operaciones gravadas y/o de exportación
        $plec_14    = ''; //Monto del Impuesto General a las Ventas y/o Impuesto de Promoción Municipal
        $plec_15    = ''; //Base imponible de las adquisiciones gravadas que dan derecho a crédito fiscal y/o saldo a favor por exportación, destinadas a operaciones gravadas y/o de exportación y a operaciones no gravadas
        $plec_16    = ''; //Monto del Impuesto General a las Ventas y/o Impuesto de Promoción Municipal
        $plec_17    = ''; //Base imponible de las adquisiciones gravadas que no dan derecho a crédito fiscal y/o saldo a favor por exportación, por no estar destinadas a operaciones gravadas y/o de exportación.
        $plec_18    = ''; //Monto del Impuesto General a las Ventas y/o Impuesto de Promoción Municipal
        $plec_19    = ''; //Valor de las adquisiciones no gravadas
        $plec_20    = ''; //Monto del Impuesto Selectivo al Consumo en los casos en que el sujeto pueda utilizarlo como deducción.
        $plec_21    = ''; //Otros tributos y cargos que no formen parte de la base imponible.
        $plec_22    = ''; //Importe total de las adquisiciones registradas según comprobante de pago.
        $plec_23    = ''; //Tipo de cambio
        $plec_24    = ''; //Fecha de emisión del comprobante de pago que se modifica
        $plec_25    = ''; //Tipo de comprobante de pago que se modifica
        $plec_26    = ''; //Número de serie del comprobante de pago que se modifica
        $plec_27    = ''; //Número del comprobante de pago que se modifica
        $plec_28    = ''; //Número del comprobante de pago emitido por sujeto no domiciliado
        $plec_29    = ''; //Fecha de emisión de la Constancia de Depósito de Detracción
        $plec_30    = ''; //Número de la Constancia de Depósito de Detracción
        $plec_31    = ''; //Marca del comprobante de pago sujeto a retención
        $plec_32    = ''; //Indica el estado del comprobante de pago y a la incidencia en la base imponible  en relación al periodo tributario correspondiente
        $plecompras = new Plecompras($id, $plec_1, $plec_2, $plec_3, $plec_4, $plec_5, $plec_6, $plec_7, $plec_8, $plec_9, $plec_10, $plec_11, $plec_12, $plec_13, $plec_14, $plec_15, $plec_16, $plec_17, $plec_18, $plec_19, $plec_20, $plec_21, $plec_22, $plec_23, $plec_24, $plec_25, $plec_26, $plec_27, $plec_28, $plec_29, $plec_30, $plec_31, $plec_32);
        $plecompras->create();
    }
    public function mostrar() {
        $plecompras = Plecompras::getAll();
        $data       = array();
        foreach ($plecompras as $value) {
            array_push($data, array(
                "id" => mb_strtoupper($value['id']),
                "plec_1" => mb_strtoupper($value['plec_1']),
                "plec_2" => mb_strtoupper($value['plec_2']),
                "plec_3" => mb_strtoupper($value['plec_3']),
                "plec_4" => mb_strtoupper($value['plec_4']),
                "plec_5" => mb_strtoupper($value['plec_5']),
                "plec_6" => mb_strtoupper($value['plec_6']),
                "plec_7" => mb_strtoupper($value['plec_7']),
                "plec_8" => mb_strtoupper($value['plec_8']),
                "plec_9" => mb_strtoupper($value['plec_9']),
                "plec_10" => mb_strtoupper($value['plec_10']),
                "plec_11" => mb_strtoupper($value['plec_11']),
                "plec_12" => mb_strtoupper($value['plec_12']),
                "plec_13" => mb_strtoupper($value['plec_13']),
                "plec_14" => mb_strtoupper($value['plec_14']),
                "plec_15" => mb_strtoupper($value['plec_15']),
                "plec_16" => mb_strtoupper($value['plec_16']),
                "plec_17" => mb_strtoupper($value['plec_17']),
                "plec_18" => mb_strtoupper($value['plec_18']),
                "plec_19" => mb_strtoupper($value['plec_19']),
                "plec_20" => mb_strtoupper($value['plec_20']),
                "plec_21" => mb_strtoupper($value['plec_21']),
                "plec_22" => mb_strtoupper($value['plec_22']),
                "plec_23" => mb_strtoupper($value['plec_23']),
                "plec_24" => mb_strtoupper($value['plec_24']),
                "plec_25" => mb_strtoupper($value['plec_25']),
                "plec_26" => mb_strtoupper($value['plec_26']),
                "plec_27" => mb_strtoupper($value['plec_27']),
                "plec_28" => mb_strtoupper($value['plec_28']),
                "plec_29" => mb_strtoupper($value['plec_29']),
                "plec_30" => mb_strtoupper($value['plec_30']),
                "plec_31" => mb_strtoupper($value['plec_31']),
                "plec_32" => mb_strtoupper($value['plec_32'])
            ));
        }
        echo json_encode($data);
    }
}
