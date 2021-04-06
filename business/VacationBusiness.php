<?php

require_once 'business/PaymentBusiness.php';
require_once 'business/DeductionBusiness.php';

class VacationBusiness {

    private function getInitAccrued() {
        $acrreud = array();
        $acrreud['accrueding'] = array();
        $acrreud['salaryTotal'] = 0.0;
        $acrreud['daysTotal'] = 0;
        $acrreud['avgSalary'] = 0.0;
        $acrreud['accruedVacation'] = 0.0;
        $acrreud['workerCCSS'] = 0.0;
        $acrreud['incomeTax'] = 0.0;

        return $acrreud;
    }
    
    public function calcVacationAccrued($input) {
        $acrreud = $this->getInitAccrued();
        $this->setPaymentsData($acrreud, $input);
        $this->setDeductionsData($acrreud, $input);
        $this->setNet($acrreud);

        return $acrreud;
    }

    private function sumNetPayments($payments) {
        $net = 0.0;
        foreach ($payments as $payment) {
            $net += $payment['net'];
        }

        return $net;
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
        $acrreud['accruedVacation'] = $acrreud['avgSalary'] * $input['vacationDays'];
        $acrreud['workerCCSS'] = $paymentBusiness->calcWorkerCCSS($acrreud['accruedVacation']);
        $acrreud['incomeTax'] = $paymentBusiness->calcIncomeTax($acrreud['accruedVacation']);
    }

    private function setDeductionsData(&$acrreud, $input) {
        $acrreud['deductionsTotal'] = 0.0;
        if (!empty($input['deductionsMounts'])) {
            foreach ($input['deductionsMounts'] as $mount) {
                $acrreud['deductionsTotal'] += $mount;
            }
        }
        $acrreud['deductionsTotal'] += $acrreud['incomeTax'] + $acrreud['workerCCSS'];
    }

    private function setNet(&$acrreud) {
        $acrreud['net'] = $acrreud['accruedVacation'] - $acrreud['deductionsTotal'];
    }
    
    public function setDeduductionsArray(&$input) {
        $input['deductionsArray'] = array();
        $deductionBusiness = new DeductionBusiness();
        if (!empty($input['deductions'])) {
            foreach ($input['deductions'] as $deductionId) {
                array_push($input['deductionsArray'], $deductionBusiness->get($deductionId));
            }
        }
    }

}
