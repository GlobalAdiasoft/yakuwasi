<?php

class Verboletas_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
     public function mostrarboletas(){
		$boletas = Boletas::getAllDistAll('bol_numero_boleta');
        
		$data = array();
		foreach ($boletas as $value) {
			if ($value['bol_envio_sunat'] == 0) {
				$button = '<img class="img_icons_aceptado" src="' . URL . URLIMG . 'checked.svg" alt="">';
			} else {
				$button = '<img class="img_icons_aceptado" src="' . URL . URLIMG . 'checked.svg" alt="">';
			}
			if (empty($value['bol_pdf'])) {
				$pdf = '';
			} else {
				$pdf = '<a target="_blank" href="' . $value['bol_pdf'] . '"><img class="img_icons" src="' . URL . URLIMG . 'pdf.svg" alt=""></a>';
			}
			if (empty($value['bol_xml'])) {
				$xml = '';
			} else {
				$xml = '<a target="_blank" href="' . $value['bol_xml'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml.svg" alt=""></a>';
			}
			if (empty($value['bol_cdr'])) {
				$cdr = '';
			} else {
				$cdr = '<a target="_blank" href="' . $value['bol_cdr'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml_1.svg" alt=""></a>';
			}
                        if (empty($value['bol_pdf_a'])) {
				$pdf_a = '';
			} else {
				$pdf_a = '<a target="_blank" href="' . $value['bol_pdf_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'pdf.svg" alt=""></a>';
			}
			if (empty($value['bol_xml_a'])) {
				$xml_a = '';
			} else {
				$xml_a = '<a target="_blank" href="' . $value['bol_xml_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml.svg" alt=""></a>';
			}
			if (empty($value['bol_cdr_a'])) {
				$cdr_a = '';
			} else {
				$cdr_a = '<a target="_blank" href="' . $value['bol_cdr_a'] . '"><img class="img_icons" src="' . URL . URLIMG . 'xml_1.svg" alt=""></a>';
			}
                        switch ($value['estado']) {
                            case 'F':
                                 $estado = 'Boleteado';
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
				"bol_correlativo" => $value['bol_correlativo'],
				"bol_numero_boleta" => $value['bol_numero_boleta'],
				"btn_generarfacturasunat" => $button,
				'bol_pdf' => $pdf.$pdf_a,
				'bol_xml' => $xml.$xml_a,
				'bol_cdr' => $cdr.$cdr_a,
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
}
