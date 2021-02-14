<?php

require_once 'exceptions/DataBaseException.php';

class PayrollData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_payroll` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_payroll` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll();
        $query->closeCursor();
        return $data;
    }
    
    public function getAllByFilter($filter) {
        $query = $this->db->prepare("CALL `sp_get_all_by_filter_payroll` (?,?,?)");
        $query->bindParam(1, $filter['fortnight']);
        $query->bindParam(2, $filter['year']);
        $query->bindParam(3, $filter['location']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll();
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $this->db->beginTransaction();
        try {
            $query = $this->db->prepare("CALL `sp_insert_payroll` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $entity['idEmployee']);
            $query->bindParam(2, $entity['location']);
            $query->bindParam(3, $entity['fortnight']);
            $query->bindParam(4, $entity['year']);
            $query->bindParam(5, $entity['type']);
            $query->bindParam(6, $entity['salary']);
            $query->bindParam(7, $entity['workingDays']);
            $query->bindParam(8, $entity['ordinaryTimeHours']);
            $query->bindParam(9, $entity['extraTimeHours']);
            $query->bindParam(10, $entity['doubleTimeHours']);
            $query->bindParam(11, $entity['vacationsDays']);
            $query->bindParam(12, $entity['vacationAmount']);
            $query->bindParam(13, $entity['ccssDays']);
            $query->bindParam(14, $entity['ccssAmount']);
            $query->bindParam(15, $entity['insDays']);
            $query->bindParam(16, $entity['insAmount']);
            $query->bindParam(17, $entity['salaryBonus']);
            $query->bindParam(18, $entity['incentives']);
            $query->bindParam(19, $entity['surcharges']);
            $query->bindParam(20, $entity['maternityDays']);
            $query->bindParam(21, $entity['maternityAmount']);
            $query->bindParam(22, $entity['observations']);

            if (!$query->execute()) {
                throw new DataBaseException();
            }

            $id = $data = $query->fetch()['id'];
            $query->closeCursor();

            if (isset($entity['deductions']) && isset($entity['deductionsMounts'])) {
                $this->insertPayrollDeduction($entity['deductions'], $entity['deductionsMounts'], $id);
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

//    public function update($entity) {
//        $this->db->beginTransaction();
//
//        $query = $this->db->prepare("CALL `sp_update_payroll` (?,?,?,?,?)");
//        $query->bindParam(1, $entity['id']);
//        $query->bindParam(2, $entity['cod']);
//        $query->bindParam(3, $entity['name']);
//        $query->bindParam(4, $entity['type']);
//        $query->bindParam(5, $entity['salary']);
//
//        if (!$query->execute()) {
//            $this->db->rollback();
//            throw new DataBaseException();
//        }
//
//        $this->db->commit();
//    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_payroll` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    private function insertPayrollDeduction($deductions, $mounts, $idPayroll) {
        for ($i = 0; $i < count($mounts); $i++) {
            $mount = floatval($mounts[$i]);
            if ($mount == 0) {
                continue;
            }
            
            $query = $this->db->prepare("CALL `sp_insert_payroll_deduction` (?,?,?)");
            $query->bindParam(1, $idPayroll);
            $query->bindParam(2, $deductions[$i]);
            $query->bindParam(3, $mount);

            if (!$query->execute()) {
                print_r($this->db->errorInfo());
                throw new DataBaseException();
            }
        }
    }

}
