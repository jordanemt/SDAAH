<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/PositionBusiness.php';
require_once 'SessionController.php';
require_once 'common/Filters.php';

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
        $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
        
        $positionBusiness = new PositionBusiness();
        $vars['data']['position'] = $positionBusiness->get($vars['data']['idPosition']);
        
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }
    
    public function getPositionEmployee() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        echo json_encode($this->business->getPositionEmployee($id));
    }

    public function insert() {
        $filter = array(
            'card' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'gender' => Filters::getString(),
            'birthdate' => Filters::getString(),
            'idPosition' => Filters::getInt(),
            'location' => Filters::getString(),
            'admissionDate' => Filters::getString(),
            'bankAccount' => Filters::getInt(),
            'email' => Filters::getEmail(),
            'cssIns' => Filters::getInt(),
            'isAffiliated' => Filters::getInt()
        );
        $entity = filter_input_array(INPUT_POST, $filter);
        
        $this->business->insert($entity);
        exit();
    }
    
    public function update() {
        $filter = array(
            'id' => Filters::getInt(),
            'card' => Filters::getString(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'gender' => Filters::getString(),
            'birthdate' => Filters::getString(),
            'idPosition' => Filters::getInt(),
            'location' => Filters::getString(),
            'admissionDate' => Filters::getString(),
            'bankAccount' => Filters::getInt(),
            'email' => Filters::getEmail(),
            'cssIns' => Filters::getInt(),
            'isAffiliated' => Filters::getInt(),
            'isLiquidated' => Filters::getInt(),
            'observations' => Filters::getString()
        );
        $entity = filter_input_array(INPUT_POST, $filter);
        
        $this->business->update($entity);
        exit();
    }
    
    public function remove() {
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
