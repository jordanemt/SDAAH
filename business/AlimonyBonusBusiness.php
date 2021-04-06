<?php

require_once 'data/AlimonyBonusData.php';

class AlimonyBonusBusiness {

    private $data;

    function __construct() {
        $this->data = new AlimonyBonuData();
    }

    public function getByIdEmployeeByYear($idEmploye, $year) {
        if (empty($idEmploye) || empty($year)) {
            throw new AttributeConflictException();
        }

        return $this->data->getByIdEmployeeByYear($idEmploye, $year);
    }

    public function insert($entity) {
        //Valid empties
        if (empty($entity['idEmployee']) ||
                empty($entity['year']) ||
                !isset($entity['mount'])) {
            throw new EmptyAttributeException();
        }

        $this->data->insert($entity);
    }

    public function update($entity) {
        //Valid empties
        if (empty($entity['id']) ||
                !isset($entity['mount'])) {
            throw new EmptyAttributeException();
        }

        $this->data->update($entity);
    }

}
