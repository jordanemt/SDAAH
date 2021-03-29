<?php

require_once 'data/ParamData.php';

class ParamBusiness {

    private $data;

    function __construct() {
        $this->data = new ParamData();
    }

    public function get($id) {
        return $this->data->get($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function update($entity) {
        //Valid empties
        if (empty($entity['id'])) {
            throw new EmptyAttributeException();
        }

        if (empty($entity['percentage'])) {
            $entity['percentage'] = 0;
        }

        $this->data->update($entity);
    }

    public function getProvisionReportParams() {
        $param = array(
            'ccss' => $this->get(2)['percentage'] / 100,
            'bonus' => $this->get(3)['percentage'] / 100,
            'vacations' => $this->get(4)['percentage'] / 100,
            'pre' => $this->get(5)['percentage'] / 100,
            'unemployment' => $this->get(6)['percentage'] / 100,
            'pt' => $this->get(7)['percentage'] / 100,
        );
        $param['total'] = $param['ccss'] + $param['bonus'] + $param['vacations'] +
                $param['pre'] + $param['unemployment'] + $param['pt'];
        
        return $param;
    }

}
