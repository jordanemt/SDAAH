<?php

require_once 'data/DeductionData.php';

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
    
    public function getAllByIdPayment($id) {
        return $this->data->getAllByIdPayment($id);
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

        $this->validAssociatedWithPayment($id);

        $this->data->remove($id);
    }

    private function validAssociatedWithPayment($id) {
        if ($this->data->isAssociatedWithPayment($id)) {
            throw new AssociatedException();
        }
    }

}
