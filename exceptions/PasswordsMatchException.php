<?php

class PasswordsMatchException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Las contraseñas no coinciden');
        http_response_code(409);
    }

}
