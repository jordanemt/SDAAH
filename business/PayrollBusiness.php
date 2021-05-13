<?php

require_once 'business/EmployeeBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/PaymentBusiness.php';
require_once 'business/ParamBusiness.php';

class PayrollBusiness {

    public function getBiweeklyPayroll($filter) {
        $paymentBusiness = new PaymentBusiness();
        $payments = $paymentBusiness->getAllByBiweeklyFilter($filter);
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $key => $payment) {
            $employee = $employeeBusiness->get($payment['idEmployee']);
            $payments[$key]['card'] = $employee['card'];
            $payments[$key]['completeName'] = $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'];
            $payments[$key]['bankAccount'] = $employee['bankAccount'];
            $payments[$key]['bank'] = $employee['bank'];
        }

        return $payments;
    }

    public function getMonthlyPayroll($filter) {
        $paymentBusiness = new PaymentBusiness();
        $payments = $paymentBusiness->getAllByMonthlyFilter($filter);
        
        $monthlyPayroll = array();
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $payment) {
            $employee = $employeeBusiness->get($payment['idEmployee']);
            $key = $this->employeeCardExistOnPayroll($employee['card'], $monthlyPayroll);
            if ($key == -1) {
                $monthlyPayment = array(
                    'id' => $payment['id'],
                    'card' => $employee['card'],
                    'completeName' => $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'],
                    'bank' => $employee['bank'],
                    'bankAccount' => $employee['bankAccount'],
                    'type' => $payment['type'],
                    'days' => $payment['workingDays'],
                    'hours' => $payment['ordinaryTimeHours'] + $payment['extraTimeHours'] + $payment['doubleTimeHours'],
                    'net' => $payment['net']
                );

                $monthlyPayroll[] = $monthlyPayment;
            } else {
                $monthlyPayroll[$key]['net'] += $payment['net'];
                $monthlyPayroll[$key]['days'] += $payment['workingDays'];
                $monthlyPayroll[$key]['hours'] += $payment['ordinaryTimeHours'] + $payment['extraTimeHours'] + $payment['doubleTimeHours'];
            }
        }

        return $monthlyPayroll;
    }
    
    public function getProvisionReport($filter) {
        $paramBusiness = new ParamBusiness();
        
        $params = $paramBusiness->getProvisionReportParams();
        
        $paymentBusiness = new PaymentBusiness();
        $payments = $paymentBusiness->getAllByMonthlyFilter($filter);
        
        $provisionReport = array();

        foreach ($payments as $payment) {
            $key = $this->locationExistOnPayroll($payment['location'], $provisionReport);
            if ($key == -1) {
                $provisionReport[] = array(
                    'location' => $payment['location'],
                    'salary' => $payment['net'],
                    'ccss' => $payment['net'] * $params['ccss'],
                    'bonus' => $payment['net'] * $params['bonus'],
                    'vacations' => $payment['net'] * $params['vacations'],
                    'pre' => $payment['net'] * $params['pre'],
                    'unemployment' => $payment['net'] * $params['unemployment'],
                    'pt' => $payment['net'] * $params['pt'],
                    'total' => $payment['net'] * $params['total']
                );
            } else {
                $provisionReport[$key]['salary'] += $payment['net'];
                $provisionReport[$key]['ccss'] = $provisionReport[$key]['salary'] * $params['ccss'];
                $provisionReport[$key]['bonus'] = $provisionReport[$key]['salary'] * $params['bonus'];
                $provisionReport[$key]['vacations'] = $provisionReport[$key]['salary'] * $params['vacations'];
                $provisionReport[$key]['pre'] = $provisionReport[$key]['salary'] * $params['pre'];
                $provisionReport[$key]['unemployment'] = $provisionReport[$key]['salary'] * $params['unemployment'];
                $provisionReport[$key]['pt'] = $provisionReport[$key]['salary'] * $params['pt'];
                $provisionReport[$key]['total'] = $provisionReport[$key]['salary'] * $params['total'];
            }
        }

        return $provisionReport;
    }
    
    public function getDetailProvisionReport($filter) {
        $paramBusiness = new ParamBusiness();
        
        $params = $paramBusiness->getProvisionReportParams();
        
        $paymentBusiness = new PaymentBusiness();
        $payments = $paymentBusiness->getAllByMonthlyFilter($filter);
        
        $provisionReport = array();
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $payment) {
            $employee = $employeeBusiness->get($payment['idEmployee']);
            $key = $this->employeeCardExistOnPayroll($employee['card'], $provisionReport);
            if ($key == -1) {
                array_push($provisionReport, array(
                    'card' => $employee['card'],
                    'completeName' => $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'],
                    'location' => $payment['location'],
                    'salary' => $payment['net'],
                    'ccss' => $payment['net'] * $params['ccss'],
                    'bonus' => $payment['net'] * $params['bonus'],
                    'vacations' => $payment['net'] * $params['vacations'],
                    'pre' => $payment['net'] * $params['pre'],
                    'unemployment' => $payment['net'] * $params['unemployment'],
                    'pt' => $payment['net'] * $params['pt'],
                    'total' => $payment['net'] * $params['total']
                ));
            } else {
                $provisionReport[$key]['salary'] += $payment['net'];
                $provisionReport[$key]['ccss'] = $provisionReport[$key]['salary'] * $params['ccss'];
                $provisionReport[$key]['bonus'] = $provisionReport[$key]['salary'] * $params['bonus'];
                $provisionReport[$key]['vacations'] = $provisionReport[$key]['salary'] * $params['vacations'];
                $provisionReport[$key]['pre'] = $provisionReport[$key]['salary'] * $params['pre'];
                $provisionReport[$key]['unemployment'] = $provisionReport[$key]['salary'] * $params['unemployment'];
                $provisionReport[$key]['pt'] = $provisionReport[$key]['salary'] * $params['pt'];
                $provisionReport[$key]['total'] = $provisionReport[$key]['salary'] * $params['total'];
            }
        }

        return $provisionReport;
    }

    private function employeeCardExistOnPayroll($card, $payments) {
        foreach ($payments as $key => $payment) {
            if ($payment['card'] == $card) {
                return $key;
            }
        }

        return -1;
    }

    private function locationExistOnPayroll($location, $payrolls) {
        foreach ($payrolls as $key => $payroll) {
            if ($payroll['location'] == $location) {
                return $key;
            }
        }

        return -1;
    }

}
