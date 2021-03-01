<?php

class SessionController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Session/';

        session_start();
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

    public function login() {
        $_SESSION['id'] = 1;
        echo 'Sesión iniciada';
    }

    public function logout() {
        session_destroy();
    }

    public function isNotLoggedThenRedirect() {
        if (!isset($_SESSION['id'])) {
            header('Location: /Index');
            die();
        }
    }

}
