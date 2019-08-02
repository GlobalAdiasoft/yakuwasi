<?php 
$usuario = Usuario::getById(session::getValue('ID_TRA'.NOMBRE_SESSION));
require URLINC.'check_session.php';
require URLINC.'head.php';
require URLINC.'nav_dash.php';
//phpinfo();
?> 
<div class="container-fluid">
    <div class="row justify-content-center">       
      
        <div class="col-12 text-center" >
          <br>
          <div class="alert alert-secondary" role="alert">
  Bienvenid@ <?php echo ucwords($usuario->getUsu_nombres().' '.$usuario->getUsu_apellidos());?><br>
          <?php print utf8_encode(strftime("Arequipa , %A %d de %B del %Y ")) ; ?>
</div>
        <div>
          
        </div>

        </div>
        <div class="col-12 text-center" >
                  <div class="alert alert-secondary" role="alert">
                      <img src="<?php Configuracion_controller::consultar_logo()?>">  
</div>
  	     
        </div>
        <div class="col-6 text-center" >
          <div class="alert alert-secondary" role="alert">
           <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte en grafico
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
<div id="container" >
         
       </div>
   	    </div>
   	    </div> 
         <div class="col-6 text-center" >
          <div class="alert alert-secondary" role="alert">
           <hr>
      <h5 class="">
        <i class="fa fa-bars" aria-hidden="true"></i> Reporte Utilidad
      </h5>
      <small>
      <i class="far fa-edit"></i>Aquí podrá ver su reporte
      </small>
      <hr>
<div id="container2" >
         
       </div>
        </div>
        </div>       
    </div>
</div>

<?php
require URLINC.'footer.php';
?>
