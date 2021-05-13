<?php

require_once 'business/BonusBusiness.php';
require_once 'business/PaymentBusiness.php';
require_once 'business/EmployeeBusiness.php';

class BonusController {

    private $business;
    private $session;
    
    public function __construct() {
        $this->view = new View();
        $this->business = new BonusBusiness();
        $this->controllerName = 'Bonus/';

        $this->session = Session::singleton();
        $this->session->isNotLoggedThenRedirect();
    }

    public function index() {
        $this->session->checkConsultant();
        try {
            $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_NUMBER_INT);
            if (empty($year)) {
                $year = date('Y');
            }
            $_SESSION['year'] = $year;

            $vars['data'] = $this->business->getBonuses($year);
            
            $this->view->show($this->controllerName . 'indexView.php', $vars);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

    public function vaucher() {
        $this->session->checkConsultant();
        try {
            $filter = array(
                'idEmployee' => Filters::getInt(),
                'year' => Filters::getInt(),
                'accruing' => Filters::getFloat(),
                'grossBonus' => Filters::getFloat(),
                'alimony' => Filters::getFloat(),
                'net' => Filters::getFloat()
            );
            $input = filter_input_array(INPUT_GET, $filter);

            $employeeBusiness = new EmployeeBusiness();
            $input['employee'] = $employeeBusiness->get($input['idEmployee']);
            
            $input['payments'] = $this->business->getFortnightsBonus($input['idEmployee'], $input['year']);

            Util::generatePDF($this->controllerName . 'vaucher.php', $input, 'Aguinaldo_' . $input['employee']['card']);
        } catch (Exception $e) {
            throw new LoadViewException();
        }
    }

}
