<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/VacationBusiness.php';
require_once 'business/BonusBusiness.php';

class LiquidationController {

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Liquidation/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        $employeeBusiness = new EmployeeBusiness();
        $vars['employees'] = $employeeBusiness->getAll();

        $deductionBusiness = new DeductionBusiness();
        $vars['deductions'] = $deductionBusiness->getAll();

        $this->view->show($this->controllerName . 'indexView.php', $vars);
    }

    public function calcLiquidation() {
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'vacations' => Filters::getInt(),
            'preCen' => Filters::getInt(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat()
        );
        $input = filter_input_array(INPUT_GET, $filter);
        $inputVacations = $input['vacations'];
        $inputVacations['idEmployee'] = $input['idEmployee'];
        $inputVacations['deductions'] = $input['deductions'];
        $inputVacations['deductionsMounts'] = $input['deductionsMounts'];

        $vacationBusiness = new VacationBusiness();
        $vacationAccrued = $vacationBusiness->calcVacationAccrued($inputVacations);

        $inputPreCen = $input['preCen'];
        $inputPreCen['idEmployee'] = $input['idEmployee'];
        
        $preCenAcrrued = $this->calcPreCenAcrrued($inputPreCen);
        
        $year = (date('m') != 12) ? date('Y') : date('Y') + 1;
        $bonusBusiness = new BonusBusiness();
        $bonus = $bonusBusiness->calcBonus($input['idEmployee'], $year);

        $data = array();
        $data['vacations'] = $vacationAccrued;
        $data['preCen'] = $preCenAcrrued;
        $data['bonus'] = $bonus;
        $data['toPay'] = $vacationAccrued['net'] + $preCenAcrrued['net'] + $bonus['grossBonus'];

        echo json_encode($data);
    }

    private function calcPreCenAcrrued($input) {
        $acrreud = array();
        $acrreud['accrueding'] = array();
        $acrreud['salaryTotal'] = 0.0;
        $acrreud['daysTotal'] = 0;
        $acrreud['avgSalary'] = 0.0;
        $acrreud['totalPre'] = 0.0;
        $acrreud['totalCen'] = 0.0;
        $payrollBusiness = new PayrollBusiness();
        foreach ($input['fortnight'] as $key => $value) {
            $payment = $payrollBusiness->getByIdEmployeeAndFortnightAndYear($input['idEmployee'], $value, $input['year'][$key]);

            if (!empty($payment)) {
                $calcultedPaymet = $payrollBusiness->calcPayment($payment);
                $net = $calcultedPaymet['net'];
            } else {
                $net = 0.0;
            }

            array_push($acrreud['accrueding'], $net);
            $acrreud['salaryTotal'] += $net;
            $acrreud['daysTotal'] += $input['days'][$key];
            $acrreud['avgSalary'] = $acrreud['salaryTotal'] / $acrreud['daysTotal'];
            $acrreud['totalPre'] = $acrreud['avgSalary'] * $input['preDays'];
            $acrreud['totalCen'] = $acrreud['avgSalary'] * $input['cenDays'];
        }

        $acrreud['net'] = $acrreud['totalPre'] + $acrreud['totalCen'];

        return $acrreud;
    }

}
