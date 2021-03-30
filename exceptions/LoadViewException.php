<?php

require_once 'exceptions/IControlledException.php';
require_once 'presentation/controller/ErrorController.php';

class LoadViewException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('Error al cargar la vista', 500);
        http_response_code(500);
    }

    public function control() {
        $errorController = new ErrorController();
        $errorController->index($this->getMessage(), $this->getCode());
    }

}
