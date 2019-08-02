<?php

use Zeus\Barcode\Renderer\SvgRenderer;


class Barcode_controller extends Controller {
    public function __construct() {
        parent::__construct();
    }
    public function generar(){
        require URLCOMPOSER.'autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode($_POST['code'], $generator::TYPE_CODE_128);
    }
       public function generar2($data){
        require URLCOMPOSER.'autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
return $generator->getBarcode($data, $generator::TYPE_CODE_128);
    }
 
    }
