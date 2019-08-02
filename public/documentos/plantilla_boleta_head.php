<style>
table {
    width: 100%;
}

img {
    height: 40px;
}

.titulo {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 14px;
}

.des {
    text-transform: uppercase;
    font-size: 14px;
}

.center {
    text-align: center;
}

hr {
    margin: 0;
    padding: 0;
}
</style>
<table class="center">
    <tr>
        <td>
            <img src="<?php Configuracion_controller::consultar_logo()?>" alt="">
</td>
    </tr>
    <tr>
        <td class="titulo"><?php echo NOMBRE_EMPRESA?></td>
    </tr>
    <tr>
        <td class="titulo"><?php echo DIRECCION_EMPRESA?></td>
    </tr>
    <tr>
        <td class="titulo"><?php echo UBIGEO_EMPRESA?></td>
    </tr>
    <tr>
        <td class="titulo">ruc: <?php echo RUC_EMPRESA?></td>
    </tr>
    <tr>
        <td class="titulo">
            <?php echo $tipo?>
            <?php echo $json['serie'].'/'.$json['numero']?>
        </td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td class="titulo">ruc/dni : </td>
        <td class="des">
            <?php echo $json['cliente_numero_de_documento']?>
        </td>
    </tr>
    <tr>
        <td class="titulo">razon social : </td>
        <td class="des">
            <?php echo $json['cliente_denominacion']?>
        </td>
    </tr>
    <tr>
        <td class="titulo">direccion : </td>
        <td class="des">
            <?php echo $json['cliente_direccion']?>
        </td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td class="titulo">fecha imp : </td>
        <td class="des">
            <?php echo fecha_hora_mysql ?>
        </td>
    </tr>
    <tr>
        <td class="titulo" style="width: 40%">fe / fv: </td>
        <td class="des" style="width: 60%">
            <?php echo $json['fecha_de_emision'].'/'.$json['fecha_de_vencimiento']?>
        </td>
    </tr>
    <!--<tr>
        <td class="titulo">condiciones de pago : </td>
        <td>contado</td>
    </tr>-->
    <tr>
        <td class="titulo">med. pago : </td>
        <td class="des">
            <?php echo $json['medio_de_pago'] ?>
        </td>
    </tr>
</table>
<hr>
<table class="center">
    <tr>
        <th>CANT.</th>
        <th>DESCRIPCIÓN</th>
        <th>P/U</th>
        <th>IMPORTE</th>
    </tr>