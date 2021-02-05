<?php

require 'SessionController.php';

class LiquidationController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Liquidation/';
        
        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

}
