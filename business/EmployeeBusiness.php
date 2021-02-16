<?php

require_once 'data/EmployeeData.php';
require_once 'business/PositionBusiness.php';
require_once 'exceptions/AttributeConflictException.php';
require_once 'exceptions/EmptyAttributeException.php';
require_once 'exceptions/DuplicateCardException.php';

class EmployeeBusiness {

    private $data;

    function __construct() {
        $this->data = new EmployeeData();
    }

    public function get($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        $data = $this->data->get($id);
        $positionBusiness = new PositionBusiness();
        $data['position'] =$positionBusiness->get($data['idPosition']);
        
        return $data;
    }

    public function getAll() {
        return $this->data->getAll();
    }
    
    public function getPositionEmployee($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        return $this->data->getPositionEmployee($id);
    }

    public function insert($entity) {
        //Valid empties
        if (empty($entity['card']) ||
                empty($entity['firstLastName']) ||
                empty($entity['secondLastName']) ||
                empty($entity['name']) ||
                empty($entity['gender']) ||
                empty($entity['birthdate']) ||
                empty($entity['idPosition']) ||
                empty($entity['location']) ||
                empty($entity['admissionDate']) ||
                empty($entity['bankAccount']) ||
                empty($entity['email']) ||
                empty($entity['cssIns'])) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (strlen($entity['card']) !== 9 ||
                strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 25 ||
                strlen($entity['gender']) > 25 ||
                strlen($entity['birthdate']) > 25 ||
                strlen($entity['idPosition']) > 25 ||
                strlen($entity['location']) > 25 ||
                strlen($entity['admissionDate']) > 25 ||
                strlen($entity['bankAccount']) !== 15 ||
                strlen($entity['email']) > 25 ||
                strlen($entity['cssIns']) !== 4 ||
                (!empty($entity['isAffiliated'])) && $entity['isAffiliated'] != 1) {
            throw new AttributeConflictException();
        }

        $this->validDuplicateCard($entity['card']);

        $this->data->insert($entity);
    }

    public function update($entity) {
        //Valid empties
        if (empty($entity['card']) ||
                empty($entity['firstLastName']) ||
                empty($entity['secondLastName']) ||
                empty($entity['name']) ||
                empty($entity['gender']) ||
                empty($entity['birthdate']) ||
                empty($entity['idPosition']) ||
                empty($entity['location']) ||
                empty($entity['admissionDate']) ||
                empty($entity['bankAccount']) ||
                empty($entity['email']) ||
                empty($entity['cssIns']) ||
                (!empty($entity['isLiquidated']) && empty($entity['observations']))) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (strlen($entity['card']) !== 9 ||
                strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 25 ||
                strlen($entity['gender']) > 25 ||
                strlen($entity['birthdate']) > 25 ||
                strlen($entity['idPosition']) > 25 ||
                strlen($entity['location']) > 25 ||
                strlen($entity['admissionDate']) > 25 ||
                strlen($entity['bankAccount']) !== 15 ||
                strlen($entity['email']) > 25 ||
                strlen($entity['cssIns']) !== 4 ||
                (!empty($entity['isAffiliated'])) && $entity['isAffiliated'] != 1 ||
                (!empty($entity['isLiquidated']) && $entity['isLiquidated'] != 1) ||
                (!empty($entity['isLiquidated']) && $entity['observations'] > 500)) {
            throw new AttributeConflictException();
        }

        $oldEntity = $this->data->get($entity['id']);
        if ($entity['card'] != $oldEntity['card']) {
            $this->validDuplicateCard($entity['card']);
        }

        $this->data->update($entity);
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        $this->data->remove($id);
    }

    private function validDuplicateCard($card) {
        if ($this->data->duplicateCard($card)) {
            throw new DuplicateCardException();
        }
    }

}
