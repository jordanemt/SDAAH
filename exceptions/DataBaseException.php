<?php

require_once 'exceptions/IControlledException.php';

class DataBaseException extends Exception implements IControlledException {

    public function __construct($msg = 'Error en la persistencia de datos') {
        parent::__construct($msg);
        http_response_code(500);
    }

    public function control() {
        return $this->getMessage();
    }

}
