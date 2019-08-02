</table>
<hr>
<table>
    <?php  
if($tipo == 'factura'){
    

    ?>
    <tr>
        <td class="titulo">gravada : </td>
        <td class="des">S/</td>
        <td class="des">66.00</td>
    </tr>
    <tr>
        <td class="titulo">igv : </td>
        <td class="des">S/</td>
        <td class="des">11.88</td>
    </tr>
    <?php } ?>
    <tr>
        <td class="titulo">total : </td>
        <td class="des">S/</td>
        <td class="des">
            <?php echo number_format((float) $json['total'], 2, '.', '') ?>
        </td>
    </tr>
</table>
<hr>
<table class="center">
    <tr>
        <td class="titulo">
            <?php echo NumeroALetras::convertir($json['total'], 'soles') ?>
        </td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td class="titulo">vendedor : </td>
        <td class="des">
            <?php echo $caja[0]['usuario'] ?>
        </td>
    </tr>
    <tr>
        <td class="titulo">pago con : </td>
        <td class="des">S/</td>
        <td class="des">
            <?php echo $caja[0]['pago'] ?>
        </td>
    </tr>
    <tr>
        <td class="titulo">vuelto : </td>
        <td class="des">S/</td>
        <td class="des">
            <?php echo $caja[0]['vuelto'] ?>
        </td>
    </tr>
</table>