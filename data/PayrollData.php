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
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }
    
    public function getByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year) {
        $query = $this->db->prepare("CALL `sp_get_by_idEmployee_and_fortnight_and_year_payroll` (?,?,?)");
        $query->bindParam(1, $idEmployee);
        $query->bindParam(2, $fortnight);
        $query->bindParam(3, $year);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
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

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAllByBiweeklyFilter($filter) {
        $query = $this->db->prepare("CALL `sp_get_all_by_filter_biweekly_payroll` (?,?,?)");
        $query->bindParam(1, $filter['fortnight']);
        $query->bindParam(2, $filter['year']);
        $query->bindParam(3, $filter['location']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAllByMonthlyFilter($filter) {
        $query = $this->db->prepare("CALL `sp_get_all_by_filter_monthly_payroll` (?,?)");
        $query->bindParam(1, $filter['month']);
        $query->bindParam(2, $filter['year']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAllOnBonusByYearByIdEmployee($year, $idEmployee) {
        $query = $this->db->prepare("CALL `sp_get_all_on_bonus_by_year_by_idEmployee` (?,?)");
        $query->bindParam(1, $idEmployee);
        $query->bindParam(2, $year);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $this->db->beginTransaction();
        try {
            $query = $this->db->prepare("CALL `sp_insert_payroll` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $entity['idEmployee']);
            $query->bindParam(2, $entity['position']);
            $query->bindParam(3, $entity['type']);
            $query->bindParam(4, $entity['salary']);
            $query->bindParam(5, $entity['location']);
            $query->bindParam(6, $entity['fortnight']);
            $query->bindParam(7, $entity['year']);
            $query->bindParam(8, $entity['workingDays']);
            $query->bindParam(9, $entity['ordinaryTimeHours']);
            $query->bindParam(10, $entity['extraTimeHours']);
            $query->bindParam(11, $entity['doubleTimeHours']);
            $query->bindParam(12, $entity['vacationsDays']);
            $query->bindParam(13, $entity['vacationAmount']);
            $query->bindParam(14, $entity['ccssDays']);
            $query->bindParam(15, $entity['ccssAmount']);
            $query->bindParam(16, $entity['insDays']);
            $query->bindParam(17, $entity['insAmount']);
            $query->bindParam(18, $entity['salaryBonus']);
            $query->bindParam(19, $entity['incentives']);
            $query->bindParam(20, $entity['surcharges']);
            $query->bindParam(21, $entity['maternityDays']);
            $query->bindParam(22, $entity['maternityAmount']);
            $query->bindParam(23, $entity['observations']);

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

    public function update($entity) {
        $this->db->beginTransaction();
        try {
            $query = $this->db->prepare("CALL `sp_update_payroll` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $entity['id']);
            $query->bindParam(2, $entity['idEmployee']);
            $query->bindParam(3, $entity['position']);
            $query->bindParam(4, $entity['type']);
            $query->bindParam(5, $entity['salary']);
            $query->bindParam(6, $entity['location']);
            $query->bindParam(7, $entity['fortnight']);
            $query->bindParam(8, $entity['year']);
            $query->bindParam(9, $entity['workingDays']);
            $query->bindParam(10, $entity['ordinaryTimeHours']);
            $query->bindParam(11, $entity['extraTimeHours']);
            $query->bindParam(12, $entity['doubleTimeHours']);
            $query->bindParam(13, $entity['vacationsDays']);
            $query->bindParam(14, $entity['vacationAmount']);
            $query->bindParam(15, $entity['ccssDays']);
            $query->bindParam(16, $entity['ccssAmount']);
            $query->bindParam(17, $entity['insDays']);
            $query->bindParam(18, $entity['insAmount']);
            $query->bindParam(19, $entity['salaryBonus']);
            $query->bindParam(20, $entity['incentives']);
            $query->bindParam(21, $entity['surcharges']);
            $query->bindParam(22, $entity['maternityDays']);
            $query->bindParam(23, $entity['maternityAmount']);
            $query->bindParam(24, $entity['observations']);

            if (!$query->execute()) {
                throw new DataBaseException();
            }

            $this->removeByIdPayrollPayrollDeduction($entity['id']);

            if (isset($entity['deductions']) && isset($entity['deductionsMounts'])) {
                $this->insertPayrollDeduction($entity['deductions'], $entity['deductionsMounts'], $entity['id']);
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_payroll` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function isInserted($idEmployee, $fortnight, $year) {
        $query = $this->db->prepare("CALL `sp_check_inserted_payroll` (?,?,?)");
        $query->bindParam(1, $idEmployee);
        $query->bindParam(2, $fortnight);
        $query->bindParam(3, $year);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        if (count($query->fetchAll(PDO::FETCH_ASSOC)) > 0) {
            $query->closeCursor();
            return true;
        }

        $query->closeCursor();
        return false;
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

    private function removeByIdPayrollPayrollDeduction($idPayroll) {
        $query = $this->db->prepare("CALL `sp_remove_by_idPayroll_payroll_deduction` (?)");
        $query->bindParam(1, $idPayroll);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

}
