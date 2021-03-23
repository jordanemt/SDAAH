<?php

require_once 'business/UserBusiness.php';

class SessionController {
    
    public static $_CONSULTANT = 1;
    public static $_DIGITIZER = 2;
    public static $_ADMIN = 3;

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Session/';
        
        session_start();
        if (isset($_SESSION['id'])) {
            $this->loadSession();
        }
    }

    public function index() {
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
    
    private function loadSession() {
        $userBusiness = new UserBusiness();
        $user = $userBusiness->get($_SESSION['id']);
        if (empty($user)) {
            $this->logout();
            header('Location: ?controller=index');
            exit();
        }
        
        $_SESSION['card'] = $user['card'];
        $_SESSION['firstLastName'] = $user['firstLastName'];
        $_SESSION['secondLastName'] = $user['secondLastName'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
    }

    public function logout() {
        session_destroy();
    }

    public function isNotLoggedThenRedirect() {
        if (!isset($_SESSION['id'])) {
            header('Location: ?controller=index');
            die();
        }
    }
    
    public function checkConsultant() {
        if ($_SESSION['role'] < self::$_CONSULTANT) {
            header('Location: ?controller=index');
            die();
        }
    }
    
    public function checkDigitizer() {
        if ($_SESSION['role'] < self::$_DIGITIZER) {
            header('Location: ?controller=index');
            die();
        }
    }
    
    public function checkAdmin() {
        if ($_SESSION['role'] < self::$_ADMIN) {
            header('Location: ?controller=index');
            die();
        }
    }
    
    public static function validRole($roleToValid = 0) {
        return $_SESSION['role'] >= $roleToValid;
    }

}
