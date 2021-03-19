<?php

require 'SessionController.php';
require_once 'business/DeductionBusiness.php';

class DeductionController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->business = new DeductionBusiness();
        $this->controllerName = 'Deduction/';

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

    public function insert() {
        $this->sessionController->checkAdmin();
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $this->business->insert($name);
        exit();
    }

    public function remove() {
        $this->sessionController->checkAdmin();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
