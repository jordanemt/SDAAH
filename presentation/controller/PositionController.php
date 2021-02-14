<?php

require 'SessionController.php';
require_once 'business/PositionBusiness.php';

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
        $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }

    public function getAllByType() {
        echo json_encode($this->business->getAllByType(filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING)));
    }

    public function insert() {
        $filter = array(
            'cod' => Filters::getString(),
            'name' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
    }

    public function update() {
        $filter = array(
            'id' => Filters::getInt(),
            'cod' => Filters::getString(),
            'name' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->update($entity);
    }

    public function remove() {
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    }

}
