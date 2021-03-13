<?php

require 'SessionController.php';
require_once 'business/BonusBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/EmployeeBusiness.php';

class BonusController {

    public function __construct() {
        $this->view = new View();
        $this->business = new BonusBusiness();
        $this->controllerName = 'Bonus/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function detail() {
        $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_NUMBER_INT);
        if (empty($year)) {
            $year = date('Y');
        }
        $_SESSION['year'] = $year;

        $vars['data'] = $this->business->getBonuses($year);
        $this->view->show($this->controllerName . 'detailView.php', $vars);
    }
    
    public function vaucher() {
        $filter = array(
            'id' => Filters::getInt(),
            'year' => Filters::getInt(),
            'accruing' => Filters::getFloat(),
            'grossBonus' => Filters::getFloat(),
            'alimony' => Filters::getFloat(),
            'net' => Filters::getFloat()
        );
        $input = filter_input_array(INPUT_GET, $filter);
        
        $employeeBusiness = new EmployeeBusiness();
        $input['employee'] = $employeeBusiness->get($input['id']);
        
        $payments = array();
        $payrollBusines = new PayrollBusiness();
        array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['id'], 23, $input['year'] - 1)));
        array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['id'], 24, $input['year'] - 1)));
        
        for ($i = 1; $i < 23; $i++) {
            array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['id'], $i, $input['year'])));
        }
        $input['payments'] = $payments;
        
        Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'CA_' . $input['employee']['card']);
    }

}
