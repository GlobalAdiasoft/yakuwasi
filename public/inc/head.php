<?php //require './idiomas.php'; ?>
<!Doctype html>
<html lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta content="<?php print AUTHOR; ?>" name="author" />
    <meta content="<?php print DESCRIPTION; ?>" name="description" />
    <head>  
    
        <title><?php echo NOMBRE_EMPRESA?></title>
        <link rel="shortcut icon" href="<?php print URL . URLIMG . NOMBRE_FAVICON; ?>" />
        <meta property="og:url" content="http://<?php print META_FACEBOOK_URL ?>/" />
        <meta property="og:type" content="<?php print META_FACEBOOK_TYPE ?>" />
        <meta property="og:title" content="<?php print META_FACEBOOK_TITULO ?>" />
        <meta property="og:description" content="<?php print META_FACEBOOK_DESCRIPCION ?>" />
        <meta property="og:image" content="<?php print URLIMG . META_FACEBOOK_IMG ?>" />
        <!-- CDN'S -->
        <?php @HeadLinks::listar_fw(URLFW . 'jquery/', 'jquery.min.js'); ?> <!-- Jquery -->
        <!-- CDN'S END-->
        <!-- JqueryUI-->
        <?php @HeadLinks::listar_fw(URLFW . 'jqueryui/', 'jquery-ui.min.js'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'jqueryui/', 'jquery-ui.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'jqueryui/', 'jquery-ui.theme.min.css'); ?>
        <!-- JqueryUI END-->     
        <!-- Bootstrap-->
        <?php @HeadLinks::listar_fw(URLFW . 'bootstrap/js/', 'popper.js'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'bootstrap/css/', 'bootstrap.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'bootstrap/js/', 'bootstrap.min.js'); ?>
        <!-- Bootstrap END-->
     
 
        <!-- Fontawesone-->
         <?php     
         
        @HeadLinks::listar_fw(URLFW . 'fontawesone/js/', 'all.js'); 
        @HeadLinks::listar_fw(URLFW . 'fontawesone/css/', 'all.css'); ?>
        <!-- Fontawesone END-->
         <?php @HeadLinks::listar_fw(URLFW . 'datatables/', 'datatables.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'datatables/', 'datatables.min.js'); ?>
        
        <?php @HeadLinks::listar_fw(URLFW . 'select2/css/', 'select2.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'select2/css/', 'select2-bootstrap.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'select2/js/', 'select2.full.js'); ?>
        
          <?php @HeadLinks::listar_fw(URLFW . 'bootstrapselect/css/', 'bootstrap-select.min.css'); ?>     
        <?php @HeadLinks::listar_fw(URLFW . 'bootstrapselect/js/', 'bootstrap-select.min.js'); ?>
        
        <?php @HeadLinks::listar_fw(URLFW . 'alertifyjs/js/', 'alertify.min.js'); ?>
         <?php @HeadLinks::listar_fw(URLFW . 'alertifyjs/css/', 'alertify.min.css'); ?>
         <?php @HeadLinks::listar_fw(URLFW . 'alertifyjs/css/', 'bootstrap.min.css'); ?>
        
        <?php @HeadLinks::listar_fw(URLFW . 'jqueryupload/css/', 'uploadfile.css'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'jqueryupload/js/', 'jquery.uploadfile.min.js'); ?>
        
      <?php @HeadLinks::listar_fw(URLFW . 'highcharts/', 'jsapi.js'); ?>
        <?php @HeadLinks::listar_fw(URLFW . 'highcharts/', 'loader.js'); ?>
         <?php //@HeadLinks::listar_fw(URLFW . 'semantic/', 'semantic.min.css'); ?>
        <?php //@HeadLinks::listar_fw(URLFW . 'semantic/', 'semantic.min.js'); ?>
        


        
        <?php @HeadLinks::carpetas_head('css'); ?>
        <?php @HeadLinks::carpetas_head('js'); ?>
        
        <?php @HeadLinks::listar_fw(URLCSS, $this->archivo . '.min.css'); ?>
        <?php @HeadLinks::listar_fw(URLJS, $this->archivo . '.min.js'); ?>
        <script>
        var URL = '<?php echo URL?>';
    $(window).load(function(responseTxt, statusTxt, xhr) {
        $('#preloader').fadeOut();
    });
        </script>
    </head>

    <body>
<!--<div id="preloader">
    <div id="loader" class="centrar text-center">
                <img class="" src="<?php echo URL . URLIMG ?>equis.svg"/>   
        <div class="spinner ">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
     
        </div>
     </div>
</div>-->
        
        

