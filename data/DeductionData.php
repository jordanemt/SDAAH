<?php

require_once 'exceptions/DataBaseException.php';

class DeductionData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_deduction` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_deduction` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }
    
    public function getAllByIdPayroll($id) {
        $query = $this->db->prepare("CALL `sp_get_all_by_idPayroll_payroll_deduction` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($name) {
        $query = $this->db->prepare("CALL `sp_insert_deduction` (?)");
        $query->bindParam(1, $name);
        
        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_deduction` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }
    
    public function isAssociatedWithPayroll($id) {
        $query = $this->db->prepare("CALL `sp_is_associated_with_payroll_deduction` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
        
        if (count($query->fetchAll()) > 0) {
            $query->closeCursor();
            return true;
        }

        $query->closeCursor();
        return false;
    }

}
