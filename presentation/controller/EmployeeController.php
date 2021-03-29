<?php

require_once 'business/EmployeeBusiness.php';
require_once 'business/PositionBusiness.php';

class EmployeeController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new EmployeeBusiness();
        $this->controllerName = 'Employee/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->session->checkConsultant();
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
            $this->session->checkDigitizer();
            $this->view->show($this->controllerName . 'insertView.php', null);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function updateView() {
        try {
            $this->session->checkDigitizer();
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
        $this->session->checkConsultant();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $data = $this->business->get($id);
        $positionBusiness = new PositionBusiness();
        $data['position'] = $positionBusiness->get($data['idPosition']);

        echo json_encode($data);
    }

    public function insert() {
        $this->session->checkDigitizer();
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
        $this->session->checkDigitizer();
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
        $this->session->checkDigitizer();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

    public function insertAlimonyOnBonus() {
        $this->session->checkDigitizer();
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
        $this->session->checkDigitizer();
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
            $this->session->checkConsultant();
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
