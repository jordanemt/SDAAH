<?php

require_once 'business/EmployeeBusiness.php';
require_once 'business/PaymentBusiness.php';
require_once 'business/AlimonyBonusBusiness.php';

class BonusBusiness {

    public function getBonuses($year) {
        $bonuses = array();

        //getting employees
        $employeeBusiness = new EmployeeBusiness();
        $employees = $employeeBusiness->getAllNotLiquidated();
        
        $alimonyBonusBusiness = new AlimonyBonusBusiness();

        foreach ($employees as $employee) {
            
            $alimony = $alimonyBonusBusiness->getByIdEmployeeByYear($employee['id'], $year);

            $bonus = $this->calcBonus($employee['id'], $year);
            $bonus['idEmployee'] = $employee['id'];
            $bonus['year'] = $year;
            $bonus['card'] = $employee['card'];
            $bonus['completeName'] = $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'];
            $bonus['bankAccount'] = $employee['bankAccount'];

            if (!empty($alimony)) {
                $bonus['alimonyId'] = $alimony['id'];
                $bonus['alimony'] = $alimony['mount'];
            } else {
                $bonus['alimonyId'] = 0;
                $bonus['alimony'] = 0;
            }
            $bonus['net'] = $bonus['grossBonus'] - $bonus['alimony'];
            $bonus['net'] = $bonus['net'] < 0 ? 0 : $bonus['net'];

            array_push($bonuses, $bonus);
        }

        return $bonuses;
    }

    public function calcBonus($idEmployee, $year) {
        $months = array(
            1 => 'january',
            2 => 'february',
            3 => 'march',
            4 => 'april',
            5 => 'may',
            6 => 'june',
            7 => 'july',
            8 => 'agoust',
            9 => 'september',
            10 => 'octuber',
            11 => 'january',
            12 => 'december',
        );

        $bonus = array(
            'december' => 0.0,
            'january' => 0.0,
            'february' => 0.0,
            'march' => 0.0,
            'april' => 0.0,
            'may' => 0.0,
            'june' => 0.0,
            'july' => 0.0,
            'agoust' => 0.0,
            'september' => 0.0,
            'octuber' => 0.0,
            'november' => 0.0,
            'grossBonus' => 0.0,
            'net' => 0.0
        );

        //getting payments on employee
        $paymentBusiness = new PaymentBusiness();
        $payments = $paymentBusiness->getAllOnBonusByYearByIdEmployee($year, $idEmployee);
        foreach ($payments as $payment) {
            $bonus[$months[ceil($payment['fortnight'] / 2)]] += $payment['net'];
        }

        $bonus['accruing'] = ($bonus['december'] +
                $bonus['january'] +
                $bonus['february'] +
                $bonus['march'] +
                $bonus['april'] +
                $bonus['may'] +
                $bonus['june'] +
                $bonus['july'] +
                $bonus['agoust'] +
                $bonus['september'] +
                $bonus['octuber'] +
                $bonus['november']);

        $bonus['grossBonus'] = $bonus['accruing'] / 12;

        return $bonus;
    }

    public function getFortnightsBonus($idEmployee, $year) {
        $payments = array();
        $paymentBusiness = new PaymentBusiness();
        
        $payments[] = $this->getSummary($paymentBusiness->getAllByIdEmployeeAndFortnightAndYear($idEmployee, 23, $year - 1));
        $payments[] = $this->getSummary($paymentBusiness->getAllByIdEmployeeAndFortnightAndYear($idEmployee, 24, $year - 1));
        for ($i = 1; $i < 23; $i++) {
            $payments[] = $this->getSummary($paymentBusiness->getAllByIdEmployeeAndFortnightAndYear($idEmployee, $i, $year));
        }
        
        return $payments;
    }

    private function getSummary($payments) {
        foreach ($payments as $key => $payment) {
            if ($key > 0) {
                $payments[0]['net'] += $payment['net'];
            }
        }

        if (empty($payments[0])) {
            return array();
        }

        return $payments[0];
    }

}
