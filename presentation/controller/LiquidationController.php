<?php

require 'SessionController.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PayrollBusiness.php';
require_once 'business/VacationBusiness.php';
require_once 'business/BonusBusiness.php';

class LiquidationController {

    private $business;
    private $sessionController;

    public function __construct() {
        $this->view = new View();
        $this->controllerName = 'Liquidation/';

        $this->sessionController = new SessionController;
        $this->sessionController->isNotLoggedThenRedirect();
    }

    public function index() {
        try {
            $this->sessionController->checkDigitizer();
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

    public function calcLiquidation() {
        $this->sessionController->checkDigitizer();
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'vacations' => Filters::getInt(),
            'preCen' => Filters::getInt(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat(),
            'bonusYear' => Filters::getInt()
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

        $bonusBusiness = new BonusBusiness();
        $bonus = $bonusBusiness->calcBonus($input['idEmployee'], $input['bonusYear']);

        $data = array();
        $data['vacations'] = $vacationAccrued;
        $data['preCen'] = $preCenAcrrued;
        $data['bonus'] = $bonus;
        $data['toPay'] = ($vacationAccrued['net'] >= 0 ? $vacationAccrued['net'] : 0.0) + $preCenAcrrued['net'] + $bonus['grossBonus'];

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
            $payments = $payrollBusiness->getAllByIdEmployeeAndFortnightAndYear($input['idEmployee'], $value, $input['year'][$key]);

            $net = 0.0;
            if (count($payments) > 0) {
                foreach ($payments as $payment) {
                    $calcultedPaymet = $payrollBusiness->calcPayment($payment);
                    $net += $calcultedPaymet['net'];
                }
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

    public function vaucher() {
        try {
            $this->sessionController->checkDigitizer();
            $filter = array(
                'idEmployee' => Filters::getInt(),
                'card' => Filters::getString(),
                'completeName' => Filters::getString(),
                'position' => Filters::getString(),
                'admissionDate' => Filters::getString(),
                'departureDate' => Filters::getString(),
                'record' => Filters::getString(),
                'reason' => Filters::getString(),
                'vacations' => Filters::getFloat(),
                'preCen' => Filters::getFloat(),
                'bonusYear' => Filters::getInt(),
                'totalSalariesBonus' => Filters::getFloat(),
                'totalBonus' => Filters::getFloat(),
                'toPay' => Filters::getFloat(),
                'deductions' => Filters::getInt(),
                'deductionsMounts' => Filters::getFloat(),
                'workerCCSS' => Filters::getFloat(),
                'incomeTax' => Filters::getFloat(),
                'deductionsTotal' => Filters::getFloat(),
                'netVacation' => Filters::getFloat()
            );
            $input = filter_input_array(INPUT_GET, $filter);

            $input['deductionsArray'] = array();
            $deductionBusiness = new DeductionBusiness();
            if (!empty($input['deductions'])) {
                foreach ($input['deductions'] as $deductionId) {
                    array_push($input['deductionsArray'], $deductionBusiness->get($deductionId));
                }
            }

            $payments = array();
            $payrollBusines = new PayrollBusiness();
            array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['idEmployee'], 23, $input['bonusYear'] - 1)));
            array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['idEmployee'], 24, $input['bonusYear'] - 1)));

            for ($i = 1; $i < 23; $i++) {
                array_push($payments, $payrollBusines->calcPayment($payrollBusines->getByIdEmployeeAndFortnightAndYear($input['idEmployee'], $i, $input['bonusYear'])));
            }
            $input['bonusPayments'] = $payments;

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'CL_' . $input['card'] . '-' . date('Y', strtotime($input['departureDate'])));
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index($e->getMessage());
        }
    }

}
