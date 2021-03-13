<?php

require_once 'data/DeductionData.php';
require_once 'exceptions/AttributeConflictException.php';
require_once 'exceptions/EmptyAttributeException.php';
require_once 'exceptions/AssociatedException.php';

class DeductionBusiness {

    private $data;

    function __construct() {
        $this->data = new DeductionData();
    }
    
    public function get($id) {
        return $this->data->get($id);
    }
    
    public function getAll() {
        return $this->data->getAll();
    }

    public function getAllByIdPayroll($id) {
        return $this->data->getAllByIdPayroll($id);
    }

    public function insert($name) {
        //Valid empties
        if (empty($name)) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (strlen($name) > 25) {
            throw new AttributeConflictException();
        }

        $this->data->insert($name);
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }

        $this->validAssociatedWithPayroll($id);

        $this->data->remove($id);
    }

    private function validAssociatedWithPayroll($id) {
        if ($this->data->isAssociatedWithPayroll($id)) {
            throw new AssociatedException();
        }
    }

}
