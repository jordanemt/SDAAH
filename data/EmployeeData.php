<?php

require_once 'exceptions/DataBaseException.php';

class EmployeeData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function get($id) {
        $query = $this->db->prepare("CALL sp_get_employee (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL sp_get_all_employee ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll();
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $query = $this->db->prepare("CALL sp_insert_employee (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $entity['card']);
        $query->bindParam(2, $entity['firstLastName']);
        $query->bindParam(3, $entity['secondLastName']);
        $query->bindParam(4, $entity['name']);
        $query->bindParam(5, $entity['gender']);
        $query->bindParam(6, $entity['birthdate']);
        $query->bindParam(7, $entity['idPosition']);
        $query->bindParam(8, $entity['location']);
        $query->bindParam(9, $entity['admissionDate']);
        $query->bindParam(10, $entity['bankAccount']);
        $query->bindParam(11, $entity['email']);
        $query->bindParam(12, $entity['cssIns']);
        $query->bindParam(13, $entity['isAffiliated']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function update($entity) {
        $this->db->beginTransaction();

        $query = $this->db->prepare("CALL sp_update_employee (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $entity['id']);
        $query->bindParam(2, $entity['card']);
        $query->bindParam(3, $entity['firstLastName']);
        $query->bindParam(4, $entity['secondLastName']);
        $query->bindParam(5, $entity['name']);
        $query->bindParam(6, $entity['gender']);
        $query->bindParam(7, $entity['birthdate']);
        $query->bindParam(8, $entity['idPosition']);
        $query->bindParam(9, $entity['location']);
        $query->bindParam(10, $entity['admissionDate']);
        $query->bindParam(11, $entity['bankAccount']);
        $query->bindParam(12, $entity['email']);
        $query->bindParam(13, $entity['cssIns']);
        $query->bindParam(14, $entity['isAffiliated']);
        $query->bindParam(15, $entity['isLiquidated']);
        $query->bindParam(16, $entity['observations']);

        if (!$query->execute()) {
            $this->db->rollback();
            throw new DataBaseException();
        }

        $this->db->commit();
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL sp_remove_employee (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function duplicateCard($card) {
        $query = $this->db->prepare("CALL `sp_duplicate_card_employee` (?)");
        $query->bindParam(1, $card);
        if (!$query->execute()) {
            throw new DataBaseException();
        }

        if (count($query->fetchAll()) > 0) {
            return true;
        }

        return false;
    }

}
