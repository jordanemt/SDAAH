<?php

require_once 'data/IncomeTaxData.php';

class IncomeTaxBusiness {

    private $data;

    function __construct() {
        $this->data = new IncomeTaxData();
    }
    
    public function get($id) {
        return $this->data->get($id);
    }
    
    public function getAll() {
        return $this->data->getAll();
    }

    public function insert($entity) {
        //Valid empty
        if (empty($entity['section'])) {
            throw new EmptyAttributeException();
        }
        
        if (empty($entity['percentage'])) {
            $entity['percentage'] = 0;
        } 

        $this->data->insert($entity);
    }

    public function remove($id) {
        if (empty($id)) {
            throw new AttributeConflictException();
        }

        $this->data->remove($id);
    }

}
