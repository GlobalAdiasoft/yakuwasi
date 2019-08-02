<?php

class Verfacturas_controller extends Controller {
	public function __construct() {
		parent::__construct();
	}
	public function mostrarfacturas() {
		$facturas = Facturas::getAllDistAll('fac_numero_factura');
		$data = array();
		foreach ($facturas as $value) {
			if ($value['fact_envio_sunat'] == 0) {
				$button = '<img class="img_icons_aceptado" src="' . URL . URLIMG . 'checked.svg" alt="">';
			} else {
				$button = '<img class="img_icons_aceptado" src="' . URL . URLIMG . 'checked.svg" alt="">';
			}
			if (empty($value['fact_pdf'])) {
				$pdf = '';
			} else {
				$pdf = '<a target="_blank" href="' . $value['fact_pdf'] . '"><img class="img_icons" src="' . URL . URLIMG . 'pdf.svg" alt=""></a>';
			}
			if (empty($value['fact_xml'])) {
				$xml = '';
			} else {
				$xml = '<a target="_blank" href="' . $value['fact_xml'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml.svg" alt=""></a>';
			}
			if (empty($value['fact_cdr'])) {
				$cdr = '';
			} else {
				$cdr = '<a target="_blank" href="' . $value['fact_cdr'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml_1.svg" alt=""></a>';
			}
                        if (empty($value['fact_pdf_a'])) {
				$pdf_a = '';
			} else {
				$pdf_a = '<a target="_blank" href="' . $value['fact_pdf_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'pdf.svg" alt=""></a>';
			}
			if (empty($value['fact_xml_a'])) {
				$xml_a = '';
			} else {
				$xml_a = '<a target="_blank" href="' . $value['fact_xml_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml.svg" alt=""></a>';
			}
			if (empty($value['fact_cdr_a'])) {
				$cdr_a = '';
			} else {
				$cdr_a = '<a target="_blank" href="' . $value['fact_cdr_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml_1.svg" alt=""></a>';
			}
                        switch ($value['estado']) {
                            case 'F':
                                 $estado = 'facturado';
                                $btn_anular ="<button id='btn_anular' class='btn btn-danger btn-sm'><i class='fas fa-ban'></i></button>";
                                $btn_consultar ="<button id='btn_actualizar_factura' class='btn btn-info btn-sm'><i class='fas fa-sync-alt'></i></button>";
                            break;
                            case 'E':
                                 $estado = 'esperando anulación';
                                 $btn_anular ="<button id='' disabled class='btn btn-danger btn-sm'><i class='fas fa-ban'></i></button>";
                                 $btn_consultar ="<button id='btn_actualizar_anulacion' class='btn btn-info btn-sm'><i class='fas fa-sync-alt'></i></button>";;
                            break;
                          case 'A':
                                   $estado = 'anulada';
                               $btn_anular ="<button id='' disabled class='btn btn-danger btn-sm'><i class='fas fa-ban'></i></button>";
                               $btn_consultar ="<button id='btn_actualizar_anulacion' class='btn btn-info btn-sm'><i class='fas fa-sync-alt'></i></button>";;
                            break;
                            default:
                                break;
                        }
			array_push($data, array(

				"id" => $value['id'],
				"fac_correlativo" => $value['fac_correlativo'],
				"fac_numero_factura" => $value['fac_numero_factura'],
				"btn_generarfacturasunat" => $button,
				'fact_pdf' => $pdf.$pdf_a,
				'fact_xml' => $xml.$xml_a,
				'fact_cdr' => $cdr.$cdr_a,
				'descripcion' => '<small>' . $value['descripcion'] . '</br><strong>[ '.mb_strtoupper($estado).' ]</strong></small>',
				"btn_imprimirguia" => "<div class='row'>
  <div class='col-4'>
  ".$btn_consultar."
  </div>
  <div class='col-4'>
 ".$btn_anular."
  </div>
  <div class='col-4'>
    <button id='btn_imprimirguia' class='btn btn-dark btn-sm'><i class='fas fa-print'></i></button>
</div>
</div>",
			));
		}
		echo json_encode($data);
	}
	public function eliminar_factura() {
		$data = array(
			'fac_numero_factura' => $_POST['fac_numero_factura'],
			'fac_correlativo' => $_POST['fac_correlativo'],
		);
		$facturas = Facturas::whereV($data, 'and');
		foreach ($facturas as $value) {
			$id = $value['id'];
			$usuarios = Facturas::getById($id);
			$usuarios->delete();
		}
	}
}
