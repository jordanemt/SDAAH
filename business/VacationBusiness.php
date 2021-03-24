<?php

require_once 'business/PayrollBusiness.php';

class VacationBusiness {

    function calcVacationAccrued($input) {
        $acrreud = array();
        $acrreud['accrueding'] = array();
        $acrreud['salaryTotal'] = 0.0;
        $acrreud['daysTotal'] = 0;
        $acrreud['avgSalary'] = 0.0;
        $acrreud['accruedVacation'] = 0.0;
        $acrreud['workerCCSS'] = 0.0;
        $acrreud['incomeTax'] = 0.0;
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
            $acrreud['accruedVacation'] = $acrreud['avgSalary'] * $input['vacationDays'];
            $acrreud['workerCCSS'] = $acrreud['accruedVacation'] * 0.105;
            $acrreud['incomeTax'] = $payrollBusiness->calcIncomeTax($acrreud['accruedVacation']);
        }

        $acrreud['deductionsTotal'] = 0.0;
        if (!empty($input['deductionsMounts'])) {
            foreach ($input['deductionsMounts'] as $mount) {
                $acrreud['deductionsTotal'] += $mount;
            }
        }
        $acrreud['deductionsTotal'] += $acrreud['incomeTax'] + $acrreud['workerCCSS'];

        $acrreud['net'] = $acrreud['accruedVacation'] - $acrreud['deductionsTotal'];

        return $acrreud;
    }

}
