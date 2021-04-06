<?php

require_once 'data/EmployeeData.php';

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
    
    public function getAllNotLiquidated() {
        return $this->data->getAllNotLiquidated();
    }

    public function getAllOnMonthBirthday() {
        $employees = $this->data->getAll();

        $month = date('m');
        $employeesOnBirthday = Array();
        foreach ($employees as $employee) {
            $employeeMonthBirthday = date_format(date_create($employee['birthdate']), 'm');
            if ($month == $employeeMonthBirthday) {
                array_push($employeesOnBirthday, $employee);
            }
        }

        return $employeesOnBirthday;
    }

    public function getAllDaysSpentOnVacation($cutoff) {
        $employees = $this->data->getAllNotLiquidated();
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
            $data['record'] = $interval->format('%y años, %m meses, %d días');
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
                empty($entity['bank']) ||
                empty($entity['bankAccount']) ||
                empty($entity['cssIns'])) {
            throw new EmptyAttributeException();
        }

        //Valid length
        if (strlen($entity['card']) !== 9 ||
                strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 50 ||
                ($entity['gender'] != 'Masculino' && $entity['gender'] != 'Femenino') ||
                ($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                (strlen($entity['bank']) < 1 || strlen($entity['bank']) > 30) ||
                (strlen($entity['bankAccount']) < 1 || strlen($entity['bankAccount']) > 30) ||
                (!empty($entity['email']) && strlen($entity['email']) > 100) ||
                strlen($entity['cssIns']) !== 4 ||
                (!empty($entity['observations']) && $entity['observations'] > 500)) {
            throw new AttributeConflictException();
        }
        
        $entity['isAffiliated'] = $entity['isAffiliated'] ? 1 : 0;
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
                empty($entity['bank']) ||
                empty($entity['bankAccount']) ||
                empty($entity['cssIns'])) {
            throw new EmptyAttributeException();
        }

        //Valid length
        if (strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 50 ||
                ($entity['gender'] != 'Masculino' && $entity['gender'] != 'Femenino') ||
                ($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                (strlen($entity['bank']) < 1 || strlen($entity['bank']) > 30) ||
                (strlen($entity['bankAccount']) < 1 || strlen($entity['bankAccount']) > 30) ||
                (!empty($entity['email']) && strlen($entity['email']) > 100) ||
                strlen($entity['cssIns']) !== 4 ||
                (!empty($entity['observations']) && $entity['observations'] > 500)) {
            throw new AttributeConflictException();
        }
        
        $entity['isAffiliated'] = $entity['isAffiliated'] ? 1 : 0;
        $entity['isLiquidated'] = $entity['isLiquidated'] ? 1 : 0;

        $this->data->update($entity);
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }
        
        $this->validAssociatedWithPayment($id);

        $this->data->remove($id);
    }

    private function validDuplicateCard($card) {
        if ($this->data->duplicateCard($card)) {
            throw new DuplicateCardException();
        }
    }
    
    private function validAssociatedWithPayment($id) {
        if ($this->data->isAssociatedWithPayment($id)) {
            throw new AssociatedException('Empleado se encuentra en nómina');
        }
    }

}
