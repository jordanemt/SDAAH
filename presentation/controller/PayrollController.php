<?php

require 'SessionController.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';

class PayrollController {

    public function __construct() {
        $this->view = new View();
        $this->business = new PayrollBusiness();
        $this->controllerName = 'Payroll/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $filter = array(
            'location' => Filters::getString(),
            'fortnight' => Filters::getString(),
            'year' => Filters::getInt()
        );
        $inputFilter = filter_input_array(INPUT_GET, $filter);
        
        $inputFilter['location'] = !empty($inputFilter['location']) ? $inputFilter['location'] : 'Administrativo|Operativo';
        $inputFilter['fortnight'] = !empty($inputFilter['fortnight']) ? $inputFilter['fortnight'] : Util::getFortnight();
        $inputFilter['year'] = !empty($inputFilter['year']) ? $inputFilter['year'] : date('Y');
        
        $_SESSION['location'] = $inputFilter['location'];
        $_SESSION['fortnight'] = $inputFilter['fortnight'];
        $_SESSION['year'] = $inputFilter['year'];

        $vars['data'] = $this->business->calcBiweeklyPayroll($this->business->getAllByFilter($inputFilter));
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function insertView() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $deductionBusiness = new DeductionBusiness();
        $vars['deductions'] = $deductionBusiness->getAll();

        $this->view->show($this->controllerName . 'insertView.php', $vars);
    }

//    public function updateView() {
//        $employeeBusiness = new EmployeeBusiness();
//        $vars['employees'] = $employeeBusiness->getAll();
//
//        $deductionBusiness = new DeductionBusiness();
//        $vars['deductions'] = $deductionBusiness->getAll();
//        
//        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//        
//        $vars['data'] = $this->business->get($id);
//        $vars['deductionsOnPayroll'] = $deductionBusiness->getAllByIdPayroll($id);
//        
//        $this->view->show($this->controllerName . 'updateView.php', $vars);
//    }

    public function monthlyView() {
        $filter = array(
            'location' => Filters::getString(),
            'fortnight' => Filters::getString(),
            'year' => Filters::getInt()
        );
        $inputFilter = filter_input_array(INPUT_GET, $filter);
        
        $inputFilter['location'] = !empty($inputFilter['location']) ? $inputFilter['location'] : 'Administrativo|Operativo';
        $inputFilter['fortnight'] = !empty($inputFilter['fortnight']) ? $inputFilter['fortnight'] : Util::getFilterOfMonth();
        $inputFilter['year'] = !empty($inputFilter['year']) ? $inputFilter['year'] : date('Y');
        
        $_SESSION['location'] = $inputFilter['location'];
        $_SESSION['fortnight'] = $inputFilter['fortnight'];
        $_SESSION['year'] = $inputFilter['year'];

        $vars['data'] = $this->business->calcMonthlyPayroll($this->business->getAllByFilter($inputFilter));
        print_r($vars['data']);
        $this->view->show($this->controllerName . 'monthlyView.php', $vars);
    }

    public function provisionReportView() {
        $this->view->show($this->controllerName . 'provisionReportView.php', null);
    }

    public function detailProvisionReportView() {
        $this->view->show($this->controllerName . 'detailProvisionReportView.php', null);
    }

    public function bncrReportView() {
        $this->view->show($this->controllerName . 'bncrReportView.php', null);
    }

    public function insert() {
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'location' => Filters::getString(),
            'fortnight' => Filters::getInt(),
            'year' => Filters::getInt(),
            'type' => Filters::getString(),
            'salary' => Filters::getFloat(),
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
    }
    
    public function remove() {
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    }

}
