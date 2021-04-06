<?php

require_once 'business/LiquidationBusiness.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PaymentBusiness.php';
require_once 'business/VacationBusiness.php';
require_once 'business/BonusBusiness.php';

class LiquidationController {

    private $business;
    private $session;

    public function __construct() {
        $this->view = new View();
        $this->business = new LiquidationBusiness();
        $this->controllerName = 'Liquidation/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
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

    public function calcLiquidation() {
        $this->session->checkDigitizer();
        
        $filter = array(
            'idEmployee' => Filters::getInt(),
            'vacations' => Filters::getInt(),
            'preCen' => Filters::getInt(),
            'deductions' => Filters::getInt(),
            'deductionsMounts' => Filters::getFloat(),
            'bonusYear' => Filters::getInt()
        );
        $input = filter_input_array(INPUT_GET, $filter);
        
        $calculateLiquidation = $this->business->calcLiquidationAccrued($input);
        
        echo json_encode($calculateLiquidation);
        exit();
    }

    public function vaucher() {
        try {
            $this->session->checkDigitizer();
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
                'netVacation' => Filters::getFloat(),
                'bonusYear' => Filters::getInt()
            );
            $input = filter_input_array(INPUT_GET, $filter);

            Util::setDeduductionsArray($input);
            $this->business->setBonusPayments($input);

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'Liquidado_' . $input['card'] . '-' . date('Y', strtotime($input['departureDate'])));
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->index('Error al generar la boleta', 500);
        }
    }

}
