<?php

require 'SessionController.php';
require_once 'business/UserBusiness.php';

class UserController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->business = new UserBusiness();
        $this->controllerName = 'User/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->sessionController->checkAdmin();
            $vars['data'] = $this->business->getAll();
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function insertView() {
        try {
            $this->sessionController->checkAdmin();
            $this->view->show($this->controllerName . 'insertView.php', null);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function updateView() {
        try {
            $this->sessionController->checkAdmin();
            $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
            $this->view->show($this->controllerName . 'updateView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }
    
    public function profileView() {
        try {
            $this->sessionController->checkConsultant();
            $vars['data'] = $this->business->get($_SESSION['id']);
            $this->view->show($this->controllerName . 'profileView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function insert() {
        $this->sessionController->checkAdmin();
        $filter = array(
            'card' => Filters::getInt(),
            'pass' => Filters::getString(),
            'passConfirm' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'email' => Filters::getEmail(),
            'role' => Filters::getInt()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
        exit();
    }

    public function update() {
        $this->sessionController->checkAdmin();
        $filter = array(
            'id' => Filters::getInt(),
            'pass' => Filters::getString(),
            'passConfirm' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'email' => Filters::getEmail(),
            'role' => Filters::getInt(),
            'is_changed_password' => Filters::getInt()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->update($entity);
        exit();
    }
    
    public function updateProfile() {
        $this->sessionController->checkConsultant();
        $filter = array(
            'pass' => Filters::getString(),
            'passConfirm' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'email' => Filters::getEmail(),
            'role' => Filters::getInt(),
            'is_changed_password' => Filters::getInt()
        );
        $entity = filter_input_array(INPUT_POST, $filter);
        $entity['id'] = $_SESSION['id'];
        
        //validSession
        if (!SessionController::validRole(SessionController::$_ADMIN)) {
            $entity['role'] = $_SESSION['role'];
        }
        
        $this->business->update($entity);
        exit();
    }
    
    public function updatePassword() {
        $this->sessionController->checkConsultant();
        $filter = array(
            'id' => Filters::getInt(),
            'pass' => Filters::getString(),
            'passConfirm' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'email' => Filters::getEmail(),
            'role' => Filters::getInt(),
            'is_changed_password' => Filters::getInt()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->update($entity);
        exit();
    }

    public function remove() {
        $this->sessionController->checkAdmin();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
