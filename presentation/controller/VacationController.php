<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/VacationBusiness.php';

class VacationController {

    public function __construct() {
        $this->view = new View();
        $this->business = new VacationBusiness();
        $this->controllerName = 'Vacation/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();

        $_SESSION['fortnight'] = Util::getFortnight();
    }

    public function index() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $deductionBusiness = new DeductionBusiness();
        $vars['deductions'] = $deductionBusiness->getAll();

        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function detail() {
        $cutoff = filter_input(INPUT_GET, 'cutoff');

        $employeeBusiness = new EmployeeBusiness();
        $vars['data'] = $employeeBusiness->getAllDaysSpentOnVacation($cutoff);
        $vars['cutoff'] = !empty($cutoff) ? $cutoff : date('Y-m-d');
        $this->view->show($this->controllerName . 'detailView.php', $vars);
    }

    public function calcVacationAccrued() {
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'vacationDays' => Filters::getInt(),
            'fortnight' => Filters::getInt(),
            'year' => Filters::getInt(),
            'days' => Filters::getInt(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat()
        );
        $input = filter_input_array(INPUT_GET, $filter);
        
        echo json_encode($this->business->calcVacationAccrued($input));
    }

}
