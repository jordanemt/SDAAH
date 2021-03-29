<?php

require_once 'business/IncomeTaxBusiness.php';

class IncomeTaxController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new IncomeTaxBusiness();
        $this->controllerName = 'IncomeTax/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->session->checkAdmin();
            $vars['data'] = $this->business->getAll();
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }
    
    public function insertView() {
        try {
            $this->session->checkAdmin();
            $this->view->show($this->controllerName . 'insertView.php', null);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function insert() {
        $this->session->checkAdmin();
        $filter = array(
            'section' => Filters::getFloat(),
            'percentage' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);
        
        $this->business->insert($entity);
        exit();
    }

    public function remove() {
        $this->session->checkAdmin();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }

}
