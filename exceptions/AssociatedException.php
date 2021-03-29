<?php

require_once 'exceptions/IControlledException.php';

class AssociatedException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Existe una relación con otra entidad');
        http_response_code(409);
    }
    
    public function control() {
        return $this->getMessage();
    }

}
