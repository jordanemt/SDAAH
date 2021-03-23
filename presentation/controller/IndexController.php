<?php

require 'SessionController.php';
require 'business/EmployeeBusiness.php';

class IndexController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Index/';
        
        $this->sessionController = new SessionController;
    }

    public function index() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employeesOnMonthBirthday'] = $employeeBusiness->getAllOnMonthBirthday();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

}
