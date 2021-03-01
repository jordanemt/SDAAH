<?php

require 'SessionController.php';
require_once 'business/UserBusiness.php';

class UserController {
    
    private $business;

    public function __construct() {
        $this->view = new View();
        $this->business = new UserBusiness();
        $this->controllerName = 'User/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $vars['data'] = $this->business->getAll();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }

    public function updateView() {
        $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }

    public function insert() {
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
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
