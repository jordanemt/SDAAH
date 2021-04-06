<?php

require_once 'exceptions/IControlledException.php';

class AssociatedException extends Exception implements IControlledException {

    public function __construct($msg = 'Existe una relación con otra entidad') {
        parent::__construct($msg);
        http_response_code(409);
    }
    
    public function control() {
        return $this->getMessage();
    }

}
