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
        try {
            $this->sessionController->checkConsultant();
            $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_NUMBER_INT);
            if (empty($year)) {
                $year = date('Y');
            }
            $_SESSION['year'] = $year;

            $vars['data'] = $this->business->getBonuses($year);
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

    public function vaucher() {
        try {
            $this->sessionController->checkConsultant();
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
            $this->pushCalculatedPayments($payments, $input['id'], 23, $input['year'] - 1);
            $this->pushCalculatedPayments($payments, $input['id'], 24, $input['year'] - 1);

            for ($i = 1; $i < 23; $i++) {
                $this->pushCalculatedPayments($payments, $input['id'], $i, $input['year']);
            }
            $input['payments'] = $payments;

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'CA_' . $input['employee']['card']);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }
    
    private function pushCalculatedPayments(&$array, $idEmployee, $fortnight, $year) {
        $payrollBusiness = new PayrollBusiness();
        $data = array(
            'year' => $year,
            'net' => 0.0
        );
        $payments = $payrollBusiness->getAllByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year);
        
        if (count($payments) <= 0) {
            $array[] = array();
            return 0;
        }
        
        foreach ($payments as $payment) {
            $calculated = $payrollBusiness->calcPayment($payment);
            $data['net'] += $calculated['net'];
        }
        
        $array[] = $data;
    }

}
