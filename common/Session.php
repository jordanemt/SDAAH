<?php

require_once 'business/UserBusiness.php';

class Session {

    public static $instance;
    public static $_CONSULTANT = 1;
    public static $_DIGITIZER = 2;
    public static $_ADMIN = 3;

    public function __construct() {
        session_start();
    }

    private function loadSession() {
        if (isset($_SESSION['id'])) {
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
    }

    public function isNotLoggedThenRedirect() {
        if (!isset($_SESSION['id'])) {
            header('Location: ?controller=index');
            die();
        }
    }

    public function isLoggedThenRedirect() {
        if (isset($_SESSION['id'])) {
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

    public function validRole($roleToValid = 0) {
        return $_SESSION['role'] >= $roleToValid;
    }

    public static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        self::$instance->loadSession();
        return self::$instance;
    }

}
