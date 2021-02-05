<?php

require 'business/PositionBusiness.php';

class PositionController {
    
    private $business;

    public function __construct() {
        $this->view = new View();
        $this->business = new PositionBusiness();
        $this->controllerName = 'Position/';
    }

    public function index() {
        $vars['data'] = $this->business->getAll();
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }
    
    public function updateView() {
        $vars['data'] = $this->business->get($_GET['id']);
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }
    
    public function insert() {
        $entity = array(
            'cod' => $_POST['cod'],
            'name' => $_POST['name'],
            'type' => isset($_POST['type']) ? $_POST['type'] : null,
            'salary' => isset($_POST['salary']) ? substr_replace($_POST['salary'], '.', strlen($_POST['salary']) - 2, 0) : null,
            'ordinaryTime' => isset($_POST['ordinaryTime']) ? substr_replace($_POST['ordinaryTime'], '.', strlen($_POST['ordinaryTime']) - 2, 0) : null,
            'extraTime' => isset($_POST['extraTime']) ? substr_replace($_POST['extraTime'], '.', strlen($_POST['extraTime']) - 2, 0) : null,
            'doubleTime' => isset($_POST['doubleTime']) ? substr_replace($_POST['doubleTime'], '.', strlen($_POST['doubleTime']) - 2, 0) : null
        );
        
        print_r($entity);

        $this->business->insert($entity);
    }

    public function update() {
        $entity = array(
            'id' => $_POST['id'],
            'cod' => $_POST['cod'],
            'name' => $_POST['name'],
            'type' => isset($_POST['type']) ? $_POST['type'] : null,
            'salary' => isset($_POST['salary']) ? substr_replace($_POST['salary'], '.', strlen($_POST['salary']) - 2, 0) : null,
            'ordinaryTime' => isset($_POST['ordinaryTime']) ? substr_replace($_POST['ordinaryTime'], '.', strlen($_POST['ordinaryTime']) - 2, 0) : null,
            'extraTime' => isset($_POST['extraTime']) ? substr_replace($_POST['extraTime'], '.', strlen($_POST['extraTime']) - 2, 0) : null,
            'doubleTime' => isset($_POST['doubleTime']) ? substr_replace($_POST['doubleTime'], '.', strlen($_POST['doubleTime']) - 2, 0) : null
        );

        $this->business->update($entity);
    }

    public function remove() {
        $this->business->remove($_POST['id']);
    }

}
