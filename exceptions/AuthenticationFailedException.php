<?php

require_once 'exceptions/IControlledException.php';

class AuthenticationFailedException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('No se pudo autenticar');
        http_response_code(404);
    }

}
