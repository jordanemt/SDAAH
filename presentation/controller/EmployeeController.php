<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/PositionBusiness.php';
require_once 'SessionController.php';
require_once 'common/Filters.php';

class EmployeeController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->business = new EmployeeBusiness();
        $this->controllerName = 'Employee/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->sessionController->checkConsultant();
            $vars['data'] = $this->business->getAll();

            $positionBusiness = new PositionBusiness();
            foreach ($vars['data'] as $key => $value) {
                $vars['data'][$key]['position'] = $positionBusiness->get($value['idPosition']);
            }

            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function insertView() {
        try {
            $this->sessionController->checkDigitizer();
            $this->view->show($this->controllerName . 'insertView.php', null);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function updateView() {
        try {
            $this->sessionController->checkDigitizer();
            $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

            $positionBusiness = new PositionBusiness();
            $vars['data']['position'] = $positionBusiness->get($vars['data']['idPosition']);

            $this->view->show($this->controllerName . 'updateView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function get() {
        $this->sessionController->checkConsultant();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $data = $this->business->get($id);
        $positionBusiness = new PositionBusiness();
        $data['position'] = $positionBusiness->get($data['idPosition']);

        echo json_encode($data);
    }

    public function insert() {
        $this->sessionController->checkDigitizer();
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
            'bankAccount' => Filters::getBankAccount(),
            'email' => Filters::getEmail(),
            'cssIns' => Filters::getInt(),
            'isAffiliated' => Filters::getInt(),
            'observations' => Filters::getString()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
        exit();
    }

    public function update() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'id' => Filters::getInt(),
            'firstLastName' => Filters::getString(),
            'secondLastName' => Filters::getString(),
            'name' => Filters::getString(),
            'gender' => Filters::getString(),
            'birthdate' => Filters::getString(),
            'idPosition' => Filters::getInt(),
            'location' => Filters::getString(),
            'admissionDate' => Filters::getString(),
            'bankAccount' => Filters::getBankAccount(),
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
        $this->sessionController->checkDigitizer();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

    public function insertAlimonyOnBonus() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'year' => Filters::getInt(),
            'mount' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insertAlimonyOnBonus($entity);
        exit();
    }

    public function updateAlimonyOnBonus() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'id' => Filters::getInt(),
            'mount' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->updateAlimonyOnBonus($entity);
        exit();
    }

    public function vaucher() {
        try {
            $this->sessionController->checkConsultant();
            $data = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

            $positionBusiness = new PositionBusiness();
            $data['position'] = $positionBusiness->get($data['idPosition']);

            Util::generatePDF($this->controllerName . 'vaucher.php', $data, 'CI_' . $data['card']);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

}
