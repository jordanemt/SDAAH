<?php

require_once 'exceptions/DataBaseException.php';

class PaymentData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_payment` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }
    
    public function getAllByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year) {
        $query = $this->db->prepare("CALL `sp_get_all_by_idEmployee_and_fortnight_and_year_payment` (?,?,?)");
        $query->bindParam(1, $idEmployee);
        $query->bindParam(2, $fortnight);
        $query->bindParam(3, $year);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_payment` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAllByBiweeklyFilter($filter) {
        $query = $this->db->prepare("CALL `sp_get_all_by_filter_biweekly_payment` (?,?,?)");
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
        $query = $this->db->prepare("CALL `sp_get_all_by_filter_monthly_payment` (?,?)");
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
        $query = $this->db->prepare("CALL `sp_get_all_on_bonus_by_year_by_idEmployee_payment` (?,?)");
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
            $query = $this->db->prepare("CALL `sp_insert_payment` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
            $query->bindParam(24, $entity['ordinary']);
            $query->bindParam(25, $entity['extra']);
            $query->bindParam(26, $entity['double']);
            $query->bindParam(27, $entity['gross']);
            $query->bindParam(28, $entity['workerCCSS']);
            $query->bindParam(29, $entity['incomeTax']);
            $query->bindParam(30, $entity['deductionsTotal']);
            $query->bindParam(31, $entity['net']);

            if (!$query->execute()) {
                throw new DataBaseException();
            }

            $id = $data = $query->fetch()['id'];
            $query->closeCursor();

            if (isset($entity['deductions']) && isset($entity['deductionsMounts'])) {
                $this->insertPaymentDeduction($entity['deductions'], $entity['deductionsMounts'], $id);
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
            $query = $this->db->prepare("CALL `sp_update_payment` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
            $query->bindParam(25, $entity['ordinary']);
            $query->bindParam(26, $entity['extra']);
            $query->bindParam(27, $entity['double']);
            $query->bindParam(28, $entity['gross']);
            $query->bindParam(29, $entity['workerCCSS']);
            $query->bindParam(30, $entity['incomeTax']);
            $query->bindParam(31, $entity['deductionsTotal']);
            $query->bindParam(32, $entity['net']);


            if (!$query->execute()) {
                throw new DataBaseException();
            }

            $this->removeByIdPaymentDeduction($entity['id']);

            if (isset($entity['deductions']) && isset($entity['deductionsMounts'])) {
                $this->insertPaymentDeduction($entity['deductions'], $entity['deductionsMounts'], $entity['id']);
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_payment` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    private function insertPaymentDeduction($deductions, $mounts, $idPayment) {
        for ($i = 0; $i < count($mounts); $i++) {
            $mount = floatval($mounts[$i]);
            if ($mount == 0) {
                continue;
            }

            $query = $this->db->prepare("CALL `sp_insert_payment_deduction` (?,?,?)");
            $query->bindParam(1, $idPayment);
            $query->bindParam(2, $deductions[$i]);
            $query->bindParam(3, $mount);

            if (!$query->execute()) {
                print_r($this->db->errorInfo());
                throw new DataBaseException();
            }
        }
    }

    private function removeByIdPaymentDeduction($idPayment) {
        $query = $this->db->prepare("CALL `sp_remove_by_idPayment_payment_deduction` (?)");
        $query->bindParam(1, $idPayment);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

}
