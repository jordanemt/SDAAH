<?php

class ErrorController {
    
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Error/';
        
        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }
    
    public function index($msg = 'Error Inesperado', $cod = 500) {
        $vars['msg'] = $msg;
        $vars['cod'] = $cod;
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

}
