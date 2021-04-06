<?php

require_once 'business/UserBusiness.php';

class LoginController {
    
    private $session;
    
    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Login/';
        
        $this->session = Session::singleton();
    }

    public function index() {
        $this->session->isLoggedThenRedirect();
        
        $this->view->show($this->controllerName . 'indexView.php', null);
    }
    
    public function login() {
        $card = filter_input(INPUT_POST, 'card', FILTER_SANITIZE_NUMBER_INT);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        $userBusiness = new UserBusiness();
        $user = $userBusiness->auth($card, $pass);
        $_SESSION['id'] = $user['id'];
        
        exit();
    }
    
    public function logout() {
        $this->session->logout();
        
        exit();
    }

}
