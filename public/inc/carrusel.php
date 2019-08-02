<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
      <!--<span class="carrureloj hidden-sm-down centrar2">

    <div class="clock countdown"></div>

</span>-->
    <div class="carousel-item active">
       <img class="d-block img-fluid" src=" ">
        <div class="bg">
       <div>
         <h5><?php echo  $lang_carrusel_titulo1;?></h5>
         <h6><?php echo  $lang_carrusel_subtitulo1;?></h6>
         <button class="btn-page  link_registro"><?php echo  $lang_btn_ingresar;?></button>
       </div>
       </div>
    </div>
    <div class="carousel-item">
           <div class="bg">
       <div>
         <h5><?php echo  $lang_carrusel_titulo2;?></h5>
         <h6><?php echo  $lang_carrusel_subtitulo2;?></h6>
         <button class="btn-page link_registro"><?php echo  $lang_btn_ingresar;?></button>
       </div>
       </div>
      <img class="d-block img-fluid" src=" ">
    </div>
    <div class="carousel-item">
        <div class="bg">
       <div>
         <h5><?php echo  $lang_carrusel_titulo3;?></h5>
         <h6><?php echo  $lang_carrusel_subtitulo3;?></h6>
         <button class="btn-page  link_registro"><?php echo  $lang_btn_ingresar;?></button>
       </div>
       </div>
      <img class="d-block img-fluid" src=" ">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<script>
 (function($) {
     FlipClock.Lang.Spanish = {
         'years': '<?php echo $lang_FlipClock_anos?>',
         'months': '<?php echo $lang_FlipClock_meses?>',
         'days': '<?php echo $lang_FlipClock_dias?>',
         'hours': '<?php echo $lang_FlipClock_horas?>',
         'minutes': '<?php echo $lang_FlipClock_minutos?>',
         'seconds': '<?php echo $lang_FlipClock_segundos?>'
     };
     /* Create various aliases for convenience */
     FlipClock.Lang['es'] = FlipClock.Lang.Spanish;
     FlipClock.Lang['es-es'] = FlipClock.Lang.Spanish;
     FlipClock.Lang['spanish'] = FlipClock.Lang.Spanish;
 }(jQuery));
</script>