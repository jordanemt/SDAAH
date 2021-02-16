<?php

require_once 'exceptions/DataBaseException.php';

class PositionData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_position` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_position` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAllByType($type) {
        $query = $this->db->prepare("CALL `sp_get_all_by_type_position` (?)");
        $query->bindParam(1, $type);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $query = $this->db->prepare("CALL `sp_insert_position` (?,?,?,?)");
        $query->bindParam(1, $entity['cod']);
        $query->bindParam(2, $entity['name']);
        $query->bindParam(3, $entity['type']);
        $query->bindParam(4, $entity['salary']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function update($entity) {
        $this->db->beginTransaction();

        $query = $this->db->prepare("CALL `sp_update_position` (?,?,?,?,?)");
        $query->bindParam(1, $entity['id']);
        $query->bindParam(2, $entity['cod']);
        $query->bindParam(3, $entity['name']);
        $query->bindParam(4, $entity['type']);
        $query->bindParam(5, $entity['salary']);
        
        if (!$query->execute()) {
            $this->db->rollback();
            throw new DataBaseException();
        }

        $this->db->commit();
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_position` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function duplicateCod($cod) {
        $query = $this->db->prepare("CALL `sp_duplicate_cod_position` (?)");
        $query->bindParam(1, $cod);
        if (!$query->execute()) {
            throw new DataBaseException();
        }

        if (count($query->fetchAll()) > 0) {
            return true;
        }

        return false;
    }

}
