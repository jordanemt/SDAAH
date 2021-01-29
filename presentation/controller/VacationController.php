<?php

class VacationController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Vacation/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }
    
    public function detail() {
        $this->view->show($this->controllerName . 'detailView.php', null);
    }

}
