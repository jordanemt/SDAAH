<?php

class SessionController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Session/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

    public function login() {
        session_start();
        $_SESSION['id'] = 1;
        echo 'Sesión iniciada';
    }

    public function logout() {
        session_start();
        session_destroy();
    }

}
