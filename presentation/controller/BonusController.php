<?php

require 'SessionController.php';
require_once 'business/BonusBusiness.php';

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

}
