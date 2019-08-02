<?php 
   require URLINC.'check_session_login.php';
   require URLINC.'head.php';
?>

<div id="particles-js"></div>
<div class="back_initial centrar text-center">
    <img id="logo" src="<?php echo URL.URLIMG?>logo_adiasoft.png" alt="">
    <hr>
    <form id="formulario_logueo" action="<?php echo URL?>User/login" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text sin_sombra" id="basic-addon1"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Ingrese su usuario" aria-label="Username" aria-describedby="basic-addon1" name="usuario" autocomplete="off">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text sin_sombra" id="basic-addon1"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Ingrese su contraseña" aria-label="Username" aria-describedby="basic-addon1" name="password" autocomplete="off">
        </div>
        <div class="form-group">
            <button class="card_button" data-background-color="#337AB7">Ingresar</button>
        </div>
        <div class="form-group">
            <p>&copy;Adiasoft Corporation
                <br>soporte@adiasoft.com</p>
        </div>
    </form>
</div>
 <?php @HeadLinks::listar_fw(URLFW . 'particulas/', 'particles.js'); ?>
<?php @HeadLinks::listar_fw(URLFW . 'particulas/', 'app.js'); ?>
<?php
   require URLINC.'footer.php';
   ?>

