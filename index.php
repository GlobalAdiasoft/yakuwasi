<?php
require './config.php';
require './config_datos.php';
 
$url        = (isset($_GET["url"])) ? $_GET["url"] : "Index/index";
$url        = explode("/", $url);
$controller = (isset($url[0])) ? $url[0] . "_controller" : "Index_controller";
$method     = (isset($url[1]) && $url[1] != null) ? $url[1] : "index";
$params     = (isset($url[2]) && $url[2] != null) ? $url[2] : null;
$params1     = (isset($url[3]) && $url[3] != null) ? $url[3] : null;
$params2     = (isset($url[4]) && $url[4] != null) ? $url[4] : null;
$params3     = (isset($url[5]) && $url[5] != null) ? $url[5] : null;
$params4    = (isset($url[6]) && $url[6] != null) ? $url[6] : null;
spl_autoload_register(function($class) {
    if (file_exists(LIBS . $class . ".php")) {
        require LIBS . $class . ".php";
    } elseif (file_exists(MODELS . $class . ".php")) {
        require MODELS . $class . ".php";
    } else {
        if (file_exists(BS . $class . ".php")) {
            require BS . $class . ".php";
        } else {
        }
    }
});
$path = "./controllers/" . $controller . ".php";
if (file_exists($path)) {
    require $path;
    $controller = new $controller();
    if (method_exists($controller, $method)) {
        if ($params != null) {
            $controller->{$method}($params,$params1,$params2);
        } else {
            $controller->{$method}();
        }
    } else {
        exit("No existe ningún método con ese nombre.");
    }
} else {
    exit("No existe ningún controlador con ese nombre.");
}


