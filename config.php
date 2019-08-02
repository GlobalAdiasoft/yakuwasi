<?php
//define('URL', '/jpinversionessystem/');
define('URL', '/yakuwasi2/');
define('URLCSS', 'public/css/');
define('URLJS', 'public/js/');
define('URLCSSSYSTEM', 'public/css_system/');
define('URLJSSYSTEM', 'public/js_system/');
define('URLCOMPOSER', 'public/composer/vendor/');

define('URLFW', 'public/fw/');
define('URLIMG', 'public/img/');
define('URLINC', 'public/inc/');
define('URLPUBLIC', 'public/');
define('URLAUDIO', 'public/audio/');
define('URLVIDEO', 'public/video/');
define('URLDOC', 'public/documentos/');
define('LIBS', 'libs/');
define('MODELS', './models/');
define('BS', 'bussineslogic');
//Parámetros DB
define('_DB_TYPE', 'mysql');
define('_DB_HOST', 'localhost');
define('_DB_USER', 'root');
define('_DB_PASS', '');
define('_DB_NAME', 'yakuwasi');

/*define('_DB_TYPE', 'mysql');
define('_DB_HOST', 'localhost');
define('_DB_USER', 'adia_adminyakuwasi');
define('_DB_PASS', 'kassandra@2015');
define('_DB_NAME', 'adia_yakuwasi');*/
//Parámetros SEGURIDAD
define('ALGORITMO', 'sha512');
define('HASHKEY', 'kassandra@2015');
//Parámetros FECHAS
date_default_timezone_set('America/lima');
setlocale(LC_TIME, "spanish");
define("CHARSET", "iso-8859-1");
define('fecha_mysql', date("Y-m-d"));
define('fecha_mysql_', date("d/m/Y"));
define('fecha_hora_mysql', date("Y-m-d H:i:s"));
define('hora_mysql', date("H:i:s"));
//Parámetros IDIOMA

define('ruta_nubefact', 'https://api.nubefact.com/api/v1/b7526857-6f30-4e05-8850-51e942558797');
define('token_nubefact', '77024fbc63094198b52710ac3e94e6da3617e2d476ec45db996449a35ff2e09f');

define('IGV', 18);
