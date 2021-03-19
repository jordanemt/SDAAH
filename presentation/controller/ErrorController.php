<?php

class ErrorController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Error/';
    }
    
    public function index($msg = 'Error Inesperado') {
        $vars['msg'] = $msg;

        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

}
