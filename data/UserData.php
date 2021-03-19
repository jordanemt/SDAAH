<?php

require_once 'exceptions/DataBaseException.php';

class UserData {

    protected $db;

    public function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }
    
    public function auth($card, $pass) {
        $query = $this->db->prepare("CALL `sp_auth` (?,?)");
        $query->bindParam(1, $card);
        $query->bindParam(2, $pass);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function get($id) {
        $query = $this->db->prepare("CALL `sp_get_user` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException(PDO::FETCH_ASSOC);
        }

        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    public function getAll() {
        $query = $this->db->prepare("CALL `sp_get_all_user` ()");

        if (!$query->execute()) {
            throw new DataBaseException();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data;
    }

    public function insert($entity, $pass) {
        $query = $this->db->prepare("CALL `sp_insert_user` (?,?,?,?,?,?,?)");
        $query->bindParam(1, $entity['card']);
        $query->bindParam(2, $pass);
        $query->bindParam(3, $entity['firstLastName']);
        $query->bindParam(4, $entity['secondLastName']);
        $query->bindParam(5, $entity['name']);
        $query->bindParam(6, $entity['email']);
        $query->bindParam(7, $entity['role']);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function update($entity, $pass) {
        try {
            $this->db->beginTransaction();

            $query = $this->db->prepare("CALL `sp_update_user` (?,?,?,?,?,?)");
            $query->bindParam(1, $entity['id']);
            $query->bindParam(2, $entity['firstLastName']);
            $query->bindParam(3, $entity['secondLastName']);
            $query->bindParam(4, $entity['name']);
            $query->bindParam(5, $entity['email']);
            $query->bindParam(6, $entity['role']);

            if (!$query->execute()) {
                throw new DataBaseException();
            }

            if (isset($pass)) {
                $this->updatePassword($entity['id'], $pass);
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function remove($id) {
        $query = $this->db->prepare("CALL `sp_remove_user` (?)");
        $query->bindParam(1, $id);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    private function updatePassword($id, $pass) {
        $query = $this->db->prepare("CALL `sp_update_pass_user` (?,?)");
        $query->bindParam(1, $id);
        $query->bindParam(2, $pass);

        if (!$query->execute()) {
            throw new DataBaseException();
        }
    }

    public function duplicateCard($card) {
        $query = $this->db->prepare("CALL `sp_duplicate_card_user` (?)");
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
