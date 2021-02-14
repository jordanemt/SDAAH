<?php

require_once 'exceptions/IControlledException.php';

class DataBaseException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Error en la persistencia de datos');
        http_response_code(500);
    }

}
