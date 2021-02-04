<?php

require_once 'exceptions/IControlledException.php';

class EmptyAttributeException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Existen atributos vacíos');
        http_response_code(409);
    }

}
