<?php

class Ejemplo_controller extends controller {
    function crear(){
         require(URLCOMPOSER . "autoload.php");
         $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
         $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

$html =file_get_contents(URLDOC.'plantilla_pdf.html');
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output('example_061.pdf', 'I');
    }
    function ejemplo(){
        $fam = Compras::getAttrTable('t_articulos');
        print_r($fam);
    }
}
