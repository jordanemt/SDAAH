<?php

require_once 'data/UserData.php';

class UserBusiness {

    private $data;

    function __construct() {
        $this->data = new UserData();
    }
    
    public function auth($card, $pass) {
        //Valid empties
        if (empty($card) || empty($pass)) {
            throw new EmptyAttributeException();
        }

        //Valid length
        if (strlen($card) !== 9 ||
                (strlen($pass) > 11 || strlen($pass) < 6)) {
            throw new AttributeConflictException();
        }

        $user = $this->data->auth($card, md5($pass));
        
        if (!empty($user)) {
            return $user;
        } else {
            throw new AuthenticationFailedException();
        }
    }

    public function get($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }

        return $this->data->get($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function insert($entity) {
        //Valid empty
        if (empty($entity['card']) ||
                empty($entity['firstLastName']) ||
                empty($entity['secondLastName']) ||
                empty($entity['name']) ||
                empty($entity['email']) ||
                empty($entity['role']) ||
                empty($entity['pass']) ||
                empty($entity['passConfirm'])) {
            throw new EmptyAttributeException();
        }

        //Valid length
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
        //Valid empties
        if (empty($entity['id']) ||
                empty($entity['firstLastName']) ||
                empty($entity['secondLastName']) ||
                empty($entity['name']) ||
                empty($entity['email']) ||
                empty($entity['role'])) {
            throw new EmptyAttributeException();
        }

        //valid length
        if (strlen($entity['firstLastName']) > 25 ||
                strlen($entity['secondLastName']) > 25 ||
                strlen($entity['name']) > 50 ||
                strlen($entity['email']) > 100 ||
                ($entity['role'] > 4 || $entity['role'] < 1)) {
            throw new AttributeConflictException();
        }

        if ($entity['is_changed_password']) {
            //Valid empties
            if (empty($entity['pass']) ||
                    empty($entity['passConfirm'])) {
                throw new EmptyAttributeException();
            }

            //valid length
            if ((strlen($entity['pass']) > 11 || strlen($entity['pass']) < 6) ||
                    (strlen($entity['passConfirm']) > 11 || strlen($entity['passConfirm']) < 6)) {
                throw new AttributeConflictException();
            }

            $this->validPasswords($entity['pass'], $entity['passConfirm']);

            $this->data->update($entity, md5($entity['pass']));
        } else {
            $this->data->update($entity, null);
        }
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }

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
