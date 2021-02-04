<?php

require 'business/UserBusiness.php';

class UserController {

    private $business;

    public function __construct() {
        $this->view = new View();
        $this->business = new UserBusiness();
        $this->controllerName = 'User/';
    }

    public function index() {
        $vars['data'] = $this->business->getAll();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }

    public function updateView() {
        $vars['data'] = $this->business->get($_GET['id']);
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }

    public function insert() {
        $entity = array(
            'id' => $_POST['id'],
            'card' => $_POST['card'],
            'pass' => $_POST['pass'],
            'passConfirm' => $_POST['passConfirm'],
            'firstLastName' => $_POST['firstLastName'],
            'secondLastName' => $_POST['secondLastName'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'role' => isset($_POST['role']) ? $_POST['role'] : 0
        );

        $this->business->insert($entity);
    }

    public function update() {
        $entity = array(
            'id' => $_POST['id'],
            'pass' => $_POST['pass'],
            'passConfirm' => $_POST['passConfirm'],
            'firstLastName' => $_POST['firstLastName'],
            'secondLastName' => $_POST['secondLastName'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'is_changed_password' => isset($_POST['is_changed_password']) ? true : false
        );

        $this->business->update($entity);
    }

    public function remove() {
        $this->business->remove($_POST['id']);
    }

}
