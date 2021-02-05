<?php

require 'SessionController.php';

class EmployeeController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Employee/';
        
        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }
    
    public function updateView() {
        $this->view->show($this->controllerName . 'updateView.php', null);
    }

}
