<?php

require_once 'exceptions/IControlledException.php';

class DuplicateCodException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('El código ya fue ingresado');
        http_response_code(409);
    }

}
