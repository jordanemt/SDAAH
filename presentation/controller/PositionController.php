<?php

require_once 'business/PositionBusiness.php';

class PositionController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new PositionBusiness();
        $this->controllerName = 'Position/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function index() {
        $this->session->checkConsultant();
        
        try {
            $vars['data'] = $this->business->getAll();
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function insertView() {
        $this->session->checkDigitizer();
        
        try {
            $this->view->show($this->controllerName . 'insertView.php', null);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function updateView() {
        $this->session->checkDigitizer();
        
        try {            
            $vars['data'] = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
            $this->view->show($this->controllerName . 'updateView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function getAllByType() {
        $this->session->checkConsultant();
        
        echo json_encode($this->business->getAllByType(filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING)));
    }

    public function insert() {
        $this->session->checkDigitizer();
        
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
        $this->session->checkDigitizer();
        
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
        $this->session->checkDigitizer();
        
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
