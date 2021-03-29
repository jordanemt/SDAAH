<?php

require_once 'exceptions/DataBaseException.php';

class ParamData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_param` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_param` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function update($entity) {
        $query = $this->db->prepare("CALL `sp_update_param` (?,?)");
        $query->bindParam(1, $entity['id']);
        $query->bindParam(2, $entity['percentage']);
        
        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

}
