<?php

require_once 'data/PositionData.php';

class PositionBusiness {

    private $data;

    function __construct() {
        $this->data = new PositionData();
    }

    public function get($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        return $this->data->get($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function getAllByType($type) {
        if (!isset($type) && $type != 'Mensual' && $type != 'Diario') {
            throw new AttributeConflictException();
        }

        return $this->data->getAllByType($type);
    }

    public function insert($entity) {
        //Valid empty
        if (empty($entity['cod']) ||
                empty($entity['name']) ||
                empty($entity['type']) ||
                isset($entity['salary'])) {
            throw new EmptyAttributeException();
        }

        //Valid length
        if (strlen($entity['cod']) !== 4 ||
                strlen($entity['name']) > 25 ||
                ($entity['type'] != 'Mensual' && $entity['type'] != 'Diario')) {
            throw new AttributeConflictException();
        }

        $this->validDuplicateCod($entity['cod']);

        $this->data->insert($entity);
    }

    public function update($entity) {
        //Valid empty
        if (empty($entity['id']) ||
                empty($entity['cod']) ||
                empty($entity['name']) ||
                empty($entity['type']) ||
                isset($entity['salary'])) {
            throw new EmptyAttributeException();
        }

        //Valid length
        if (strlen($entity['cod']) !== 4 ||
                strlen($entity['name']) > 25 ||
                ($entity['type'] != 'Mensual' && $entity['type'] != 'Diario')) {
            throw new AttributeConflictException();
        }

        $oldEntity = $this->data->get($entity['id']);
        if ($entity['cod'] != $oldEntity['cod']) {
            $this->validDuplicateCod($entity['cod']);
        }

        $this->data->update($entity);
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        $this->validAssociatedWithEmployee($id);
        
        $this->data->remove($id);
    }

    private function validDuplicateCod($cod) {
        if ($this->data->duplicateCod($cod)) {
            throw new DuplicateCodException();
        }
    }
    
    private function validAssociatedWithEmployee($id) {
        if ($this->data->isAssociatedWithEmployee($id)) {
            throw new AssociatedException('Uno o más empleados tienen este Puesto');
        }
    }

}
