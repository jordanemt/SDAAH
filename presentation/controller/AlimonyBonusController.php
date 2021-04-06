<?php

require_once 'business/AlimonyBonusBusiness.php';

class AlimonyBonusController {

    private $business;
    private $session;

    public function __construct() {
        $this->business = new AlimonyBonusBusiness();

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function insert() {
        $this->session->checkDigitizer();
        
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'year' => Filters::getInt(),
            'mount' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
        exit();
    }

    public function update() {
        $this->session->checkDigitizer();
        
        $filter = array(
            'id' => Filters::getInt(),
            'mount' => Filters::getFloat()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->update($entity);
        exit();
    }

}
