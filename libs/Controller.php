<?php
class Controller {
    function __construct() {
        Session::init(NOMBRE_SESSION);
        $this->view = new View();
    }
}
spl_autoload_register(function($class) {
    if (file_exists("./controllers/" . $class . ".php")) {
        require "./controllers/" . $class . ".php";
    }
});
    