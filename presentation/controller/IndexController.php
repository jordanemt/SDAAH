<?php

require 'business/EmployeeBusiness.php';

class IndexController {
    
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Index/';
        
        $this->session = Session::singleton();
    }

    public function index() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employeesOnMonthBirthday'] = $employeeBusiness->getAllOnMonthBirthday();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

}
