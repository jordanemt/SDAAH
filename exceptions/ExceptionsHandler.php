<?php

class ExceptionsHandler {

    public function __construct() {
        set_exception_handler(array($this, 'handle'));
    }

    public function handle($exception) {
        if (is_a($exception, 'AuthenticationFailedException')) {
            echo $exception->getMessage();
        } else {
            http_response_code(500);
//            echo 'Error Inesperado';
            echo $exception->getMessage();
        }
    }

}
