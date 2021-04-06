<?php

class AlimonyBonuData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function getByIdEmployeeByYear($idEmploye, $year) {
        $query = $this->db->prepare("CALL `sp_get_alimonybonus_by_idEmployee_and_year` (?,?)");
        $query->bindParam(1, $idEmploye);
        $query->bindParam(2, $year);

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($entity) {
        $query = $this->db->prepare("CALL `sp_insert_alimonybonus` (?,?,?)");
        $query->bindParam(1, $entity['idEmployee']);
        $query->bindParam(2, $entity['year']);
        $query->bindParam(3, $entity['mount']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function update($entity) {
        $query = $this->db->prepare("CALL `sp_update_alimonybonus` (?,?)");
        $query->bindParam(1, $entity['id']);
        $query->bindParam(2, $entity['mount']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

}
