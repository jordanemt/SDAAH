<?php

require 'business/PositionBusiness.php';
require 'SessionController.php';

class PositionController {

    public function __construct() {
        $this->view = new View();
        $this->business = new PositionBusiness();
        $this->controllerName = 'Position/';
        
        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
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
    
    public function getAllByType() {
        $type = isset($_GET['type']) ? $_GET['type'] : null;

        echo json_encode($this->business->getAllByType($type));
    }
    
    public function insert() {
        $entity = array(
            'cod' => $_POST['cod'],
            'name' => $_POST['name'],
            'type' => isset($_POST['type']) ? $_POST['type'] : null,
            'salary' => isset($_POST['salary']) ? $_POST['salary'] : null,
            'ordinaryTime' => isset($_POST['ordinaryTime']) ? $_POST['ordinaryTime'] : null,
            'extraTime' => isset($_POST['extraTime']) ? $_POST['extraTime'] : null,
            'doubleTime' => isset($_POST['doubleTime']) ? $_POST['doubleTime'] : null
        );

        $this->business->insert($entity);
    }

    public function update() {
        $entity = array(
            'id' => $_POST['id'],
            'cod' => $_POST['cod'],
            'name' => $_POST['name'],
            'type' => isset($_POST['type']) ? $_POST['type'] : null,
            'salary' => isset($_POST['salary']) ? $_POST['salary'] : null,
            'ordinaryTime' => isset($_POST['ordinaryTime']) ? $_POST['ordinaryTime'] : null,
            'extraTime' => isset($_POST['extraTime']) ? $_POST['extraTime'] : null,
            'doubleTime' => isset($_POST['doubleTime']) ? $_POST['doubleTime'] : null
        );

        $this->business->update($entity);
    }

    public function remove() {
        $this->business->remove($_POST['id']);
    }

}
