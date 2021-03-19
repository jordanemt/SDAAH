<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/VacationBusiness.php';

class VacationController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->business = new VacationBusiness();
        $this->controllerName = 'Vacation/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();

        $_SESSION['fortnight'] = Util::getFortnight();
    }

    public function index() {
        try {
            $this->sessionController->checkConsultant();
            $employeeBusiness = new EmployeeBusiness();
            $vars['employees'] = $employeeBusiness->getAll();

            $deductionBusiness = new DeductionBusiness();
            $vars['deductions'] = $deductionBusiness->getAll();

            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function detail() {
        try {
            $this->sessionController->checkConsultant();
            $cutoff = filter_input(INPUT_GET, 'cutoff');

            $employeeBusiness = new EmployeeBusiness();
            $vars['data'] = $employeeBusiness->getAllDaysSpentOnVacation($cutoff);
            $vars['cutoff'] = !empty($cutoff) ? $cutoff : date('Y-m-d');
            $this->view->show($this->controllerName . 'detailView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function calcVacationAccrued() {
        $this->sessionController->checkConsultant();
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

    public function vaucher() {
        try {
            $this->sessionController->checkConsultant();
            $filter = array(
                'card' => Filters::getInt(),
                'completeName' => Filters::getString(),
                'admissionDate' => Filters::getString(),
                'position' => Filters::getString(),
                'vacationDate' => Filters::getString(),
                'vacationDays' => Filters::getInt(),
                'vacationFortnight' => Filters::getInt(),
                'fortnight' => Filters::getInt(),
                'year' => Filters::getInt(),
                'days' => Filters::getInt(),
                'accruing' => Filters::getFloat(),
                'avgSalary' => Filters::getFloat(),
                'daysTotal' => Filters::getInt(),
                'salaryTotal' => Filters::getFloat(),
                'accruedVacation' => Filters::getFloat(),
                'deductions' => Filters::getInt(),
                'deductionsMounts' => Filters::getFloat(),
                'workerCCSS' => Filters::getFloat(),
                'incomeTax' => Filters::getFloat(),
                'deductionsTotal' => Filters::getFloat(),
                'net' => Filters::getFloat()
            );
            $input = filter_input_array(INPUT_GET, $filter);

            $input['deductionsArray'] = array();
            $deductionBusiness = new DeductionBusiness();
            if (!empty($input['deductions'])) {
                foreach ($input['deductions'] as $deductionId) {
                    array_push($input['deductionsArray'], $deductionBusiness->get($deductionId));
                }
            }

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'CV_' . $input['card']);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

}
