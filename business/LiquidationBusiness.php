<?php

require_once 'business/PaymentBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/VacationBusiness.php';
require_once 'business/BonusBusiness.php';

class LiquidationBusiness {

    function calcLiquidationAccrued($input) {
        $caculatedLiquidation = array();

        $caculatedLiquidation['vacations'] = $this->getCalcVacations($input);
        $caculatedLiquidation['preCen'] = $this->getCalcPreCen($input);
        $caculatedLiquidation['bonus'] = $this->getCalcBonus($input);
        $this->setToPay($caculatedLiquidation);

        return $caculatedLiquidation;
    }

    private function getCalcVacations($input) {
        $inputVacations = $input['vacations'];
        $inputVacations['idEmployee'] = $input['idEmployee'];
        $inputVacations['deductions'] = $input['deductions'];
        $inputVacations['deductionsMounts'] = $input['deductionsMounts'];

        $vacationBusiness = new VacationBusiness();
        $vacationCalculated = $vacationBusiness->calcVacationAccrued($inputVacations);

        return $vacationCalculated;
    }

    private function getCalcPreCen($input) {
        $inputPreCen = $input['preCen'];
        $inputPreCen['idEmployee'] = $input['idEmployee'];

        $calculatedPreCen = $this->calcPreCen($inputPreCen);

        return $calculatedPreCen;
    }

    private function getCalcBonus($input) {
        $bonusBusiness = new BonusBusiness();
        $calculatedBonus = $bonusBusiness->calcBonus($input['idEmployee'], $input['bonusYear']);

        return $calculatedBonus;
    }

    private function setToPay(&$caculatedLiquidation) {
        $vacationsNet = $caculatedLiquidation['vacations']['net'];
        $preCenNet = $caculatedLiquidation['preCen']['net'];
        $bonusNet = $caculatedLiquidation['bonus']['grossBonus'];

        $caculatedLiquidation['toPay'] = ($vacationsNet >= 0 ? $vacationsNet : 0.0) + $preCenNet + $bonusNet;
    }

    private function getInitAccrued() {
        $acrreud = array();
        $acrreud['accrueding'] = array();
        $acrreud['salaryTotal'] = 0.0;
        $acrreud['daysTotal'] = 0;
        $acrreud['avgSalary'] = 0.0;
        $acrreud['totalPre'] = 0.0;
        $acrreud['totalCen'] = 0.0;

        return $acrreud;
    }

    private function calcPreCen($input) {
        $acrreud = $this->getInitAccrued();
        $this->setPaymentsData($acrreud, $input);
        $this->setNet($acrreud);
        return $acrreud;
    }

    private function setPaymentsData(&$acrreud, $input) {
        $paymentBusiness = new PaymentBusiness();

        foreach ($input['fortnight'] as $key => $value) {
            $payments = $paymentBusiness->getAllByIdEmployeeAndFortnightAndYear($input['idEmployee'], $value, $input['year'][$key]);

            if (count($payments) > 0) {
                $net = Util::sumNetPayments($payments);
            } else {
                $net = 0.0;
            }

            $acrreud['accrueding'][] = $net;
            $acrreud['salaryTotal'] += $net;
            $acrreud['daysTotal'] += $input['days'][$key];
        }

        $acrreud['avgSalary'] = $acrreud['salaryTotal'] / $acrreud['daysTotal'];
        $acrreud['totalPre'] = $acrreud['avgSalary'] * $input['preDays'];
        $acrreud['totalCen'] = $acrreud['avgSalary'] * $input['cenDays'];
    }

    private function setNet(&$acrreud) {
        $acrreud['net'] = $acrreud['totalPre'] + $acrreud['totalCen'];
    }

    public function setBonusPayments(&$input) {
        $bonusBusiness = new BonusBusiness();
        $input['bonusPayments'] = $bonusBusiness->getFortnightsBonus($input['idEmployee'], $input['bonusYear']);
    }

}
