<?php
class Pdfventas_controller extends Controller {
  public function pdf_ticket($tipo ,$serie, $numero) {
    $data_pdfventas = array(
      'correlativo' => $serie,
      'numero' => $numero
    );
    $pdfventas      = Pdfventas::whereV($data_pdfventas, 'and');
    $data_caja      = array(
      'documento' => $serie,
      'numero' => $numero
    );
    $caja           = Caja::whereV($data_caja, 'and');    
    $json           = $pdfventas[0]['json'];
    $json           = json_decode($json);
    $json           = (array) $json;
    $plantilla_body = '';
    foreach ($json['items'] as $value) {
      $value          = (array) $value;
      $plantilla_body = $plantilla_body . '
      <tr>
        <td class="des">' . $value['cantidad'] . '</td>
        <td class="des">' . $value['descripcion'] . '</td>
        <td class="des">' . number_format((float) $value['precio_unitario'], 2, '.', '') . '</td>
        <td class="des">' . number_format((float)$value['total'], 2, '.', '') . '</td>
      </tr>';
    }
    require(URLCOMPOSER . "autoload.php");
    ob_start();
    include(URLDOC . 'plantilla_boleta_head.php');
    echo $plantilla_body;
    include(URLDOC . 'plantilla_boleta_footer.php');
    $plantilla = ob_get_contents();
    ob_end_clean();    
    $mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8', 
    'format' => [500, 88], 
    'orientation' => 'L',
    'margin_left'=>5,
    'margin_right'=>5,
    'margin_top'=>5,
    'margin_bottom'=>5,        
    ]);
    $mpdf->WriteHTML($plantilla);
    $mpdf->Output();
  }
}
