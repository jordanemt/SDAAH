<?php

require 'business/EmployeeBusiness.php';
require 'SessionController.php';
require_once 'business/PositionBusiness.php';

class EmployeeController {

    public function __construct() {
        $this->view = new View();
        $this->business = new EmployeeBusiness();
        $this->controllerName = 'Employee/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $data = $this->business->getAll();
        
        $newData = array();
        $positionBusiness = new PositionBusiness();
        foreach ($data as $value) {
            $value['position'] = $positionBusiness->get($value['idPosition']);
            array_push($newData, $value);
        }
        
        $vars['data'] = $newData;
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insertView() {
        $this->view->show($this->controllerName . 'insertView.php', null);
    }

    public function updateView() {
        $vars['data'] = $this->business->get($_GET['id']);
        
        $positionBusiness = new PositionBusiness();
        $vars['data']['position'] = $positionBusiness->get($vars['data']['idPosition']);
        
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }

    public function insert() {
        $entity = array(
            'card' => $_POST['card'],
            'firstLastName' => $_POST['firstLastName'],
            'secondLastName' => $_POST['secondLastName'],
            'name' => $_POST['name'],
            'gender' => isset($_POST['gender'])? $_POST['gender'] : 0,
            'birthdate' => $_POST['birthdate'],
            'idPosition' => isset($_POST['idPosition'])? $_POST['idPosition'] : 0,
            'location' => isset($_POST['location'])? $_POST['location'] : 0,
            'admissionDate' => $_POST['admissionDate'],
            'bankAccount' => $_POST['bankAccount'],
            'email' => $_POST['email'],
            'cssIns' => $_POST['cssIns'],
            'isAffiliated' => isset($_POST['isAffiliated'])? $_POST['isAffiliated'] : 0
        );
        
        $this->business->insert($entity);
    }
    
    public function update() {
        $entity = array(
            'id' => $_POST['id'],
            'card' => $_POST['card'],
            'firstLastName' => $_POST['firstLastName'],
            'secondLastName' => $_POST['secondLastName'],
            'name' => $_POST['name'],
            'gender' => isset($_POST['gender'])? $_POST['gender'] : 0,
            'birthdate' => $_POST['birthdate'],
            'idPosition' => isset($_POST['idPosition'])? $_POST['idPosition'] : 0,
            'location' => isset($_POST['location'])? $_POST['location'] : 0,
            'admissionDate' => $_POST['admissionDate'],
            'bankAccount' => $_POST['bankAccount'],
            'email' => $_POST['email'],
            'cssIns' => $_POST['cssIns'],
            'isAffiliated' => isset($_POST['isAffiliated'])? $_POST['isAffiliated'] : 0,
            'isLiquidated' => isset($_POST['isLiquidated'])? $_POST['isLiquidated'] : 0,
            'observations' => isset($_POST['observations'])? $_POST['observations'] : ''
        );
        
        $this->business->update($entity);
    }
    
    public function remove() {
        $this->business->remove($_POST['id']);
    }

}
