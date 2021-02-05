<?php

require 'SessionController.php';

class BonusController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Bonus/';
        
        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }
    
    public function detail() {
        $this->view->show($this->controllerName . 'detailView.php', null);
    }

}
