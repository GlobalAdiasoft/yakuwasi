<nav class="nav_web" >

<ul class="reset">
<li><img class="img-fluid nav_web_logo animated bounceInLeft" src="<?php print URL.URLIMG.NOMBRE_LOGO?>" alt="Responsive image"></li>			
</ul>

<ul class="reset ul_nav_web">
<li class="nav_oculto"><img src="<?php print URL.URLIMG.NOMBRE_LOGO?>" style="height: 30px;"><span class="nav_web_icon nav_oculto" onclick="myFunction()">&#9776;</span></li>
<li><a class="page-scroll" href="#carouselExampleIndicators"><?php print $lang_inicio;?></a></li>
<li><a class="page-scroll" href="#cod_nosotros"><?php print $lang_nosotros;?></a></li>
<li><a class="page-scroll" href="#cod_servicios"><?php print $lang_servicios;?></a></li>
<li><a class="page-scroll" href="#cod_mercados"><?php print $lang_mercados;?></a></li>
<li><a class="page-scroll" href="#cod_planes"><?php print $lang_planes;?></a></li>
<li><a class="page-scroll" href="#cod_planesdecarrera"><?php print $lang_plandecarrera;?></a></i>
<li><a class="page-scroll" href="#cod_contacto"><?php print $lang_contacto;?></a></li>
<li class="link_registro nav_oculto"><a href="#"><?php print $lang_registro;?></a></li>
<li class="link_entrar nav_oculto"><a href="#"><?php print $lang_entrar;?></a></li>
<li class=" nav_oculto"><a class="btn_idioma_es" href="#"><img class="img_idioma" src="<?php echo URL.URLIMG?>spain.svg"></a></li>
<li class=" nav_oculto"><a class="btn_idioma_en" href="#"><img class="img_idioma" src="<?php echo URL.URLIMG?>united-states.svg"></a></li>	
</ul>

<ul class="reset">
<li><a class="btn_idioma_es" href="#"><img class="img_idioma" src="<?php echo URL.URLIMG?>spain.svg"></a></li>
<li><a class="btn_idioma_en" href="#"><img class="img_idioma" src="<?php echo URL.URLIMG?>united-states.svg"></a></li>
<!--<li><a class="link_registro" href="#"><?php print $lang_registro;?></a></li>
<li><a class="link_entrar" href="#"><?php print $lang_entrar;?></a></li>-->
<li class="efecto link_registro">
<svg height="40" width="90" xmlns="http://www.w3.org/2000/svg">
    <rect class="shape" height="40" width="90" />

  </svg>
     <div class="centrar"><?php print $lang_registro;?></div>
</li>
<li class="efecto link_entrar">
<svg height="40" width="111" xmlns="http://www.w3.org/2000/svg">
    <rect class="shape" height="40" width="111" />

  </svg>
      <div class="centrar"><?php print $lang_entrar;?></div>
</li>
</ul>

</nav>

