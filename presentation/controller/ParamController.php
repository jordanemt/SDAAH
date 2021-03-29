<?php

require_once 'business/ParamBusiness.php';

class ParamController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new ParamBusiness();
        $this->controllerName = 'Param/';

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

    public function update() {
        $this->session->checkAdmin();
        $filter = array(
            'id' => Filters::getInt(),
            'percentage' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);
        
        $this->business->update($entity);
        exit();
    }

}
