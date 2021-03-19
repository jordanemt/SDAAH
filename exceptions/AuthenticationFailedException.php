<?php

require_once 'exceptions/IControlledException.php';

class AuthenticationFailedException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Verifique la cédula y la contraseña');
        http_response_code(404);
    }

}
