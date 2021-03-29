<?php

require_once 'exceptions/IControlledException.php';
require_once 'presentation/controller/ErrorController.php';

class ActionNotFoundException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('La acción no fue encontrado', 404);
        http_response_code(404);
    }

    public function control() {
        $errorController = new ErrorController();
        $errorController->index($this->getMessage(), $this->getCode());
    }

}
