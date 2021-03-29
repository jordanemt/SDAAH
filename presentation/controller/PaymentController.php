<?php

require_once 'business/PaymentBusiness.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';

class PaymentController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new PaymentBusiness();
        $this->controllerName = 'Payment/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function insertView() {
        try {
            $this->session->checkDigitizer();
            $employeeBusiness = new EmployeeBusiness();
            $vars['employees'] = $employeeBusiness->getAll();

            $deductionBusiness = new DeductionBusiness();
            $vars['deductions'] = $deductionBusiness->getAll();

            $this->view->show($this->controllerName . 'insertView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function updateView() {
        try {
            $this->session->checkDigitizer();
            $employeeBusiness = new EmployeeBusiness();
            $vars['employees'] = $employeeBusiness->getAll();

            $deductionBusiness = new DeductionBusiness();
            $vars['deductions'] = $deductionBusiness->getAll();

            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $vars['data'] = $this->business->get($id);
            $this->view->show($this->controllerName . 'updateView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function get() {
        $this->session->checkDigitizer();
        $data = $this->business->get(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        echo json_encode($data);
        exit();
    }

    public function insert() {
        $this->session->checkDigitizer();
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'position' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat(),
            'location' => Filters::getString(),
            'fortnight' => Filters::getInt(),
            'year' => Filters::getInt(),
            'workingDays' => Filters::getInt(),
            'ordinaryTimeHours' => Filters::getInt(),
            'extraTimeHours' => Filters::getInt(),
            'doubleTimeHours' => Filters::getInt(),
            'vacationsDays' => Filters::getInt(),
            'vacationAmount' => Filters::getFloat(),
            'ccssDays' => Filters::getInt(),
            'ccssAmount' => Filters::getFloat(),
            'insDays' => Filters::getInt(),
            'insAmount' => Filters::getFloat(),
            'salaryBonus' => Filters::getFloat(),
            'incentives' => Filters::getFloat(),
            'surcharges' => Filters::getFloat(),
            'maternityDays' => Filters::getInt(),
            'maternityAmount' => Filters::getFloat(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat(),
            'observations' => Filters::getString()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->insert($entity);
        exit();
    }

    public function update() {
        $this->session->checkDigitizer();
        $filter = array(
            'id' => Filters::getInt(),
            'idEmployee' => Filters::getInt(),
            'position' => Filters::getString(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat(),
            'location' => Filters::getString(),
            'fortnight' => Filters::getInt(),
            'year' => Filters::getInt(),
            'workingDays' => Filters::getInt(),
            'ordinaryTimeHours' => Filters::getInt(),
            'extraTimeHours' => Filters::getInt(),
            'doubleTimeHours' => Filters::getInt(),
            'vacationsDays' => Filters::getInt(),
            'vacationAmount' => Filters::getFloat(),
            'ccssDays' => Filters::getInt(),
            'ccssAmount' => Filters::getFloat(),
            'insDays' => Filters::getInt(),
            'insAmount' => Filters::getFloat(),
            'salaryBonus' => Filters::getFloat(),
            'incentives' => Filters::getFloat(),
            'surcharges' => Filters::getFloat(),
            'maternityDays' => Filters::getInt(),
            'maternityAmount' => Filters::getFloat(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat(),
            'observations' => Filters::getString()
        );
        $entity = filter_input_array(INPUT_POST, $filter);

        $this->business->update($entity);
        exit();
    }

    public function remove() {
        $this->session->checkDigitizer();
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
        exit();
    }
    
    public function vaucher() {
        try {
            $this->session->checkConsultant();
            $data = $this->business->get(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

            Util::generatePDF($this->controllerName . 'vaucher.php', $data, 'CP_Q-' . $data['fortnight'] . '.' . $data['year'] . '.' . $data['employee']['card']);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

}
