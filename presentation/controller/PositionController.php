<?php

require 'SessionController.php';
require_once 'business/PositionBusiness.php';

class PositionController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->business = new PositionBusiness();
        $this->controllerName = 'Position/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->sessionController->checkConsultant();
            $vars['data'] = $this->business->getAll();
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
            $this->view->show($this->controllerName . 'updateView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function getAllByType() {
        $this->sessionController->checkConsultant();
        echo json_encode($this->business->getAllByType(filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING)));
    }

    public function insert() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'cod' => Filters::getString(),
            'name' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
        exit();
    }

    public function update() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'id' => Filters::getInt(),
            'cod' => Filters::getString(),
            'name' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat()
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

}
