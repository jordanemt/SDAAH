<?php

class IndexController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Index/';
    }

    public function index() {
        $this->view->show($this->controllerName . 'indexView.php', null);
    }

}
