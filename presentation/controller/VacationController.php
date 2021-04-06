<?php

require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/VacationBusiness.php';

class VacationController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new VacationBusiness();
        $this->controllerName = 'Vacation/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();

        $_SESSION['fortnight'] = Util::getFortnight();
    }

    public function index() {
        $this->session->checkDigitizer();
        
        try {
            $employeeBusiness = new EmployeeBusiness();
            $vars['employees'] = $employeeBusiness->getAll();

            $deductionBusiness = new DeductionBusiness();
            $vars['deductions'] = $deductionBusiness->getAll();

            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function detail() {
        $this->session->checkDigitizer();
        
        try {
            $cutoff = filter_input(INPUT_GET, 'cutoff');

            $employeeBusiness = new EmployeeBusiness();
            $vars['data'] = $employeeBusiness->getAllDaysSpentOnVacation($cutoff);
            $vars['cutoff'] = !empty($cutoff) ? $cutoff : date('Y-m-d');

            $this->view->show($this->controllerName . 'detailView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function calcVacationAccrued() {
        $this->session->checkDigitizer();
        
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
        
        $calculatedVacationAccrued = $this->business->calcVacationAccrued($input);
        
        echo json_encode($calculatedVacationAccrued);
    }

    public function vaucher() {
        $this->session->checkDigitizer();
        
        try {
            $filter = array(
                'card' => Filters::getString(),
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

            Util::setDeduductionsArray($input);

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'Vacaciones_' . $input['card']);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index('Error al generar la boleta', 500);
        }
    }

}
