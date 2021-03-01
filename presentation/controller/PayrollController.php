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
        
        $_SESSION['location'] = 'Administrativo|Operativo';
        $_SESSION['fortnight'] = Util::getFortnight();
        $_SESSION['year'] = date('Y');
        $_SESSION['month'] = date('m');
    }

    public function index() {
        $inputFilter = array(
            'location' => Filters::getString(),
            'fortnight' => Filters::getInt(),
            'year' => Filters::getInt()
        );
        $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::BEWEEKLY);
        
        $vars['data'] = $this->business->getBiweeklyPayroll($this->business->getAllByBiweeklyFilter($filter));
        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function monthlyView() {
        $inputFilter = array(
            'month' => Filters::getInt(),
            'year' => Filters::getInt()
        );
        $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);
        
        $vars['data'] = $this->business->getMonthlyPayroll($this->business->getAllByMonthlyFilter($filter));
        $this->view->show($this->controllerName . 'monthlyView.php', $vars);
    }

    public function provisionReportView() {
        $inputFilter = array(
            'month' => Filters::getInt(),
            'year' => Filters::getInt()
        );
        $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

        $vars['data'] = $this->business->getProvisionReport($this->business->getAllByMonthlyFilter($filter));
        $this->view->show($this->controllerName . 'provisionReportView.php', $vars);
    }

    public function detailProvisionReportView() {
        $inputFilter = array(
            'month' => Filters::getInt(),
            'year' => Filters::getInt()
        );
        $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

        $vars['data'] = $this->business->getDetailProvisionReport($this->business->getAllByMonthlyFilter($filter));
        $this->view->show($this->controllerName . 'detailProvisionReportView.php', $vars);
    }

    public function bncrReportView() {
        $inputFilter = array(
            'month' => Filters::getInt(),
            'year' => Filters::getInt()
        );
        $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

        $vars['data'] = $this->business->getMonthlyPayroll($this->business->getAllByMonthlyFilter($filter));
        $this->view->show($this->controllerName . 'bncrReportView.php', $vars);
    }

    public function insertView() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $deductionBusiness = new DeductionBusiness();
        $vars['deductions'] = $deductionBusiness->getAll();

        $this->view->show($this->controllerName . 'insertView.php', $vars);
    }

    public function updateView() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $deductionBusiness = new DeductionBusiness();
        $vars['deductions'] = $deductionBusiness->getAll();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        $vars['data'] = $this->business->get($id);
        $this->view->show($this->controllerName . 'updateView.php', $vars);
    }

    public function insert() {
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
    }
    
    public function update() {
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
    }

    public function remove() {
        $this->business->remove(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    }

}
