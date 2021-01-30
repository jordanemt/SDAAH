<?php

class PayrollController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Payroll/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }
    
    public function monthlyView() {
        $this->view->show($this->controllerName . 'monthlyView.php', null);
    }
    
    public function provisionReportView() {
        $this->view->show($this->controllerName . 'provisionReportView.php', null);
    }
    
    public function detailProvisionReportView() {
        $this->view->show($this->controllerName . 'detailProvisionReportView.php', null);
    }
    
    public function bncrReportView() {
        $this->view->show($this->controllerName . 'bncrReportView.php', null);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }

    public function updateView() {
        $this->view->show($this->controllerName . 'updateView.php', null);
    }

}
