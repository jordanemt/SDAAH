<?php

require_once 'business/PayrollBusiness.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/ParamBusiness.php';

class PayrollController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new PayrollBusiness();
        $this->controllerName = 'Payroll/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();

        $_SESSION['location'] = isset($_SESSION['location']) ? $_SESSION['location'] : 'Administrativo|Operativo';
        $_SESSION['fortnight'] = isset($_SESSION['fortnight']) ? $_SESSION['fortnight'] : Util::getFortnight();
        $_SESSION['year'] = isset($_SESSION['year']) ? $_SESSION['year'] : date('Y');
    }

    public function index() {
        $this->session->checkConsultant();
        
        try {
            $inputFilter = array(
                'location' => Filters::getString(),
                'fortnight' => Filters::getInt(),
                'year' => Filters::getInt()
            );
            $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::BEWEEKLY);

            $vars['data'] = $this->business->getBiweeklyPayroll($filter);
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function monthlyView() {
        $this->session->checkConsultant();
        
        try {
            $inputFilter = array(
                'month' => Filters::getInt(),
                'year' => Filters::getInt()
            );
            $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

            $vars['data'] = $this->business->getMonthlyPayroll($filter);
            $this->view->show($this->controllerName . 'monthlyView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function provisionReportView() {
        $this->session->checkConsultant();
        
        try {
            $inputFilter = array(
                'month' => Filters::getInt(),
                'year' => Filters::getInt()
            );
            $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);
            
            $businessParam = new ParamBusiness();
            $vars['params'] = $businessParam->getProvisionReportParams();

            $vars['data'] = $this->business->getProvisionReport($filter);
            $this->view->show($this->controllerName . 'provisionReportView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function detailProvisionReportView() {
        $this->session->checkConsultant();
        
        try {
            $inputFilter = array(
                'month' => Filters::getInt(),
                'year' => Filters::getInt()
            );
            $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

            $businessParam = new ParamBusiness();
            $vars['params'] = $businessParam->getProvisionReportParams();
            
            $vars['data'] = $this->business->getDetailProvisionReport($filter);
            $this->view->show($this->controllerName . 'detailProvisionReportView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function bankReportView() {
        $this->session->checkConsultant();
        
        try {
            $inputFilter = array(
                'month' => Filters::getInt(),
                'year' => Filters::getInt()
            );
            $filter = Util::getSanitazeFilter(filter_input_array(INPUT_GET, $inputFilter), Util::MONTHLY);

            $vars['data'] = $this->business->getMonthlyPayroll($filter);
            $this->view->show($this->controllerName . 'bankReportView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

}
