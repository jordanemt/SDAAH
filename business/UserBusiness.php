<?php

require 'data/UserData.php';
require_once 'exceptions/EmptyAttributeException.php';
require_once 'exceptions/AttributeConflictException.php';
require_once 'exceptions/PasswordsMatchException.php';
require_once 'exceptions/DuplicateCardException.php';

class UserBusiness {

    private $data;

    function __construct() {
        $this->data = new UserData();
    }

    public function get($id) {
        return $this->data->get($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function insert($entity) {
        //Valid empties
        if (empty($entity['id']) ||
                empty($entity['card']) ||
                empty($entity['firstLastName']) ||
                empty($entity['secondLastName']) ||
                empty($entity['name']) ||
                empty($entity['email']) ||
                empty($entity['role']) ||
                empty($entity['pass']) ||
                empty($entity['passConfirm'])) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (strlen($entity['card']) !== 9 ||
                strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 50 ||
                strlen($entity['email']) > 100 ||
                ($entity['role'] > 4 || $entity['role'] < 1) ||
                (strlen($entity['pass']) > 11 || strlen($entity['pass']) < 6) ||
                (strlen($entity['passConfirm']) > 11 || strlen($entity['passConfirm']) < 6)) {
            throw new AttributeConflictException();
        }

        $this->validPasswords($entity['pass'], $entity['passConfirm']);
        $this->validDuplicateCard($entity['card']);

        $this->data->insert($entity, md5($entity['pass']));
    }

    public function update($entity) {
        if ($entity['is_changed_password']) {
            //Valid empties
            if (empty($entity['id']) ||
                    empty($entity['firstLastName']) ||
                    empty($entity['secondLastName']) ||
                    empty($entity['name']) ||
                    empty($entity['email']) ||
                    empty($entity['role']) ||
                    empty($entity['pass']) ||
                    empty($entity['passConfirm'])) {
                throw new EmptyAttributeException();
            }

            //valid lentch
            if (strlen($entity['firstLastName']) > 25 ||
                    strlen($entity['secondLastName']) > 25 ||
                    strlen($entity['name']) > 50 ||
                    strlen($entity['email']) > 100 ||
                    ($entity['role'] > 4 || $entity['role'] < 1) ||
                    (strlen($entity['pass']) > 11 || strlen($entity['pass']) < 6) ||
                    (strlen($entity['passConfirm']) > 11 || strlen($entity['passConfirm']) < 6)) {
                throw new AttributeConflictException();
            }

            $this->validPasswords($entity['pass'], $entity['passConfirm']);

            $this->data->update($entity, md5($entity['pass']));
        } else {
            //Valid empties
            if (empty($entity['id']) ||
                    empty($entity['firstLastName']) ||
                    empty($entity['secondLastName']) ||
                    empty($entity['name']) ||
                    empty($entity['email']) ||
                    empty($entity['role'])) {
                throw new EmptyAttributeException();
            }

            //valid lentch
            if (strlen($entity['firstLastName']) > 25 ||
                    strlen($entity['secondLastName']) > 25 ||
                    strlen($entity['name']) > 50 ||
                    strlen($entity['email']) > 100 ||
                    ($entity['role'] > 4 || $entity['role'] < 1)) {
                throw new AttributeConflictException();
            }

            $this->data->update($entity, null);
        }
    }

    public function remove($id) {
        $this->data->remove($id);
    }

    private function validPasswords($pass, $passConfirm) {
        if ($pass !== $passConfirm) {
            throw new PasswordsMatchException();
        }
    }

    private function validDuplicateCard($card) {
        if ($this->data->duplicateCard($card)) {
            throw new DuplicateCardException();
        }
    }

}