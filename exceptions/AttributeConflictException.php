<?php

require_once 'exceptions/IControlledException.php';

class AttributeConflictException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Se han encontrado conflictos en la información');
        http_response_code(409);
    }

    public function control() {
        return $this->getMessage();
    }

}
