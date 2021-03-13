<?php

require 'SessionController.php';
require_once 'business/DeductionBusiness.php';

class DeductionController {

    public function __construct() {
        $this->view = new View();
        $this->business = new DeductionBusiness();
        $this->controllerName = 'Deduction/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $vars['data'] = $this->business->getAll();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insert() {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $this->business->insert($name);
    }

    public function remove() {
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    }

}
