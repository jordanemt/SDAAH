<?php

require_once 'data/EmployeeData.php';
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

        return $this->data->get($id);
    }

    public function getWithDeleted($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }

        return $this->data->getWithDeleted($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function getAllDaysSpentOnVacation($cutoff) {
        $employees = $this->data->getAll();
        $date1 = !empty($cutoff) ? new DateTime($cutoff) : new DateTime('now');

        $array = array();
        foreach ($employees as $value) {
            $data = $this->data->getDaysSpentOnVacationById($value['id']);
            // calculing daysRight
            $date2 = new DateTime($data['admissionDate']);
            $interval = date_diff($date1, $date2);
            $daysDiff = intval($interval->format('%a'));
            $daysOnType = $data['type'] == 'Mensual' ? 14 : 12;
            $daysRight = round(($daysDiff / 365) * $daysOnType);

            $data['daysRight'] = $daysRight;
            $data['vacationBalance'] = 0;
            $data['vacationBalance'] = $daysRight - intval($data['vacationsDays']);
            $data['record'] = $interval->format('%y años, %m meses %d días');
            array_push($array, $data);
        }

        return $array;
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
        if (empty($entity['firstLastName']) ||
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
        if (strlen($entity['firstLastName']) > 25 ||
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

    public function getAlimonyOnBonusByIdEmployeeByYear($idEmploye, $year) {
        if (empty($idEmploye) || empty($year)) {
            throw new AttributeConflictException();
        }

        return $this->data->getAlimonyOnBonusByIdEmployeeByYear($idEmploye, $year);
    }

    public function insertAlimonyOnBonus($entity) {
        //Valid empties
        if (empty($entity['idEmployee']) ||
                empty($entity['year']) ||
                empty($entity['mount'])) {
            throw new EmptyAttributeException();
        }
        
        $this->data->insertAlimonyOnBonus($entity);
    }
    
    public function updateAlimonyOnBonus($entity) {
        //Valid empties
        if (empty($entity['id']) ||
                empty($entity['mount'])) {
            throw new EmptyAttributeException();
        }
        
        $this->data->updateAlimonyOnBonus($entity);
    }

}
