<?php

require_once 'exceptions/IControlledException.php';

class DuplicateCardException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('La identificación ya fue ingresada');
        http_response_code(409);
    }

}
