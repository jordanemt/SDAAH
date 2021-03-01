<?php

class PaymentInsertedException extends Exception implements IControlledException {

    public function __construct() {
        parent::__construct('El empleado ya está en la nómina de la quincena y mes ingresados');
        http_response_code(409);
    }

}
