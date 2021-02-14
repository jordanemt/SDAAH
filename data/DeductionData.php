<?php

require_once 'exceptions/DataBaseException.php';

class DeductionData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_deduction` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll();
        $query->closeCursor();
        return $data;
    }
    
    public function getAllByIdPayroll($id) {
        $query = $this->db->prepare("CALL `sp_get_all_by_idPayroll_deduction` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll();
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

}