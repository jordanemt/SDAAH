<?php

require_once 'exceptions/DataBaseException.php';

class IncomeTaxData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_incometax` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_incometax` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $query = $this->db->prepare("CALL `sp_insert_incometax` (?,?)");
        $query->bindParam(1, $entity['section']);
        $query->bindParam(2, $entity['percentage']);
        
        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_incometax` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

}
