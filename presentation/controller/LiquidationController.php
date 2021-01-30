<?php

class LiquidationController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Liquidation/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

}
