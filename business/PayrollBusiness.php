<?php

require_once 'data/PayrollData.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/PositionBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'exceptions/AttributeConflictException.php';
require_once 'exceptions/EmptyAttributeException.php';

class PayrollBusiness {

    private $data;

    function __construct() {
        $this->data = new PayrollData();
    }

    public function get($id) {
        $payroll = $this->data->get($id);

        $employeeBusiness = new EmployeeBusiness();
        $deductionBusiness = new DeductionBusiness();
        $positionBusiness = new PositionBusiness();
        $payroll['employee'] = $employeeBusiness->get($payroll['idEmployee']);
        $payroll['employee']['position'] = $positionBusiness->get($payroll['employee']['idPosition']);
        $payroll['deductions'] = $deductionBusiness->getAllByIdPayroll($payroll['id']);

        return $payroll;
    }
    
    public function getAllByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year) {
        //Valid empties
        if (empty($idEmployee) ||
                empty($fortnight) ||
                empty($year)) {
            throw new EmptyAttributeException();
        }
        
        return $this->data->getAllByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function getAllByBiweeklyFilter($filter) {
        return $this->data->getAllByBiweeklyFilter($filter);
    }

    public function getAllByMonthlyFilter($filter) {
        return $this->data->getAllByMonthlyFilter($filter);
    }

    public function getAllOnBonusByYearByIdEmployee($year, $idEmployee) {
        $payrolls = $this->data->getAllOnBonusByYearByIdEmployee($year, $idEmployee);

        $employeeBusiness = new EmployeeBusiness();
        $deductionBusiness = new DeductionBusiness();
        foreach ($payrolls as $key => $payroll) {
            $payrolls[$key]['employee'] = $employeeBusiness->get($payroll['idEmployee']);
            $payrolls[$key]['deductions'] = $deductionBusiness->getAllByIdPayroll($payroll['id']);
        }

        return $payrolls;
    }

    public function insert($entity) {
        //Valid empties
        if (empty($entity['idEmployee']) ||
                empty($entity['position']) ||
                empty($entity['type']) ||
                empty($entity['salary']) ||
                empty($entity['location']) ||
                empty($entity['fortnight']) ||
                empty($entity['year']) ||
                (empty($entity['workingDays']) && empty($entity['ordinaryTimeHours']))) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                strlen($entity['type']) > 7) {
            throw new AttributeConflictException();
        }

        $this->data->insert($entity);
    }

    public function update($entity) {
        //Valid empties
        if (empty($entity['id']) ||
                empty($entity['idEmployee']) ||
                empty($entity['position']) ||
                empty($entity['type']) ||
                empty($entity['salary']) ||
                empty($entity['location']) ||
                empty($entity['fortnight']) ||
                empty($entity['year']) ||
                (empty($entity['workingDays']) && empty($entity['ordinaryTimeHours']))) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                strlen($entity['type']) > 7) {
            throw new AttributeConflictException();
        }

        $this->data->update($entity);
    }

    public function remove($id) {
        $this->data->remove($id);
    }

    public function getBiweeklyPayroll($payments) {
        $biweeklyPayroll = array();
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $payment) {
            $calculatedPayment = $this->calcPayment($payment);

            $employee = $employeeBusiness->getWithDeleted($payment['idEmployee']);
            $calculatedPayment['card'] = $employee['card'];
            $calculatedPayment['completeName'] = $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'];
            $calculatedPayment['bankAccount'] = $employee['bankAccount'];

            array_push($biweeklyPayroll, $calculatedPayment);
        }

        return $biweeklyPayroll;
    }

    public function calcPayment($payment) {
        if (empty($payment)) {
            return 0;
        }
        $type = $payment['type'];
        $ordinarySalary = ($type == 'Mensual') ? ($payment['salary'] / 30) : $payment['salary'];
        $extraTime = ($type == 'Mensual') ? ($ordinarySalary / 8) * 1.5 : $ordinarySalary * 1.5;
        $doubleTime = ($type == 'Mensual') ? ($ordinarySalary / 8) * 2 : $ordinarySalary * 2;

        $ordinary = ($payment['type'] == 'Mensual') ? $ordinarySalary * $payment['workingDays'] : $ordinarySalary * $payment['ordinaryTimeHours'];
        $extra = (float) ($extraTime * $payment['extraTimeHours']);
        $double = (float) ($doubleTime * $payment['doubleTimeHours']);

        $accrued = (
                $ordinary +
                $extra +
                $double +
                floatval($payment['vacationAmount']) +
                floatval($payment['salaryBonus']) +
                floatval($payment['incentives']) +
                floatval($payment['surcharges']) +
                floatval($payment['maternityAmount'])
                );

        $workerCss = $this->calcWorkerCCSS($accrued);
        $incomeTax = $this->calcIncomeTax($accrued);

        $deductionBusiness = new DeductionBusiness();
        $deductions = $deductionBusiness->getAllByIdPayroll($payment['id']);

        $deductionsTotal = 0;
        foreach ($deductions as $deduction) {
            $deductionsTotal += floatval($deduction['mount']);
        }

        $deductionsTotal += $workerCss + $incomeTax;

        $net = $accrued - $deductionsTotal + floatval($payment['ccssAmount']) + floatval($payment['insAmount']);
        
        if ($net < 0.0) {
            $net = 0.0;
        }

        return array(
            'id' => $payment['id'],
            'fortnight' => $payment['fortnight'],
            'year' => $payment['year'],
            'ordinary' => $ordinary,
            'vacation' => $payment['vacationAmount'],
            'extra' => $extra,
            'double' => $double,
            'surcharges' => $payment['surcharges'],
            'accrued' => $accrued,
            'workerCss' => $workerCss,
            'incomeTax' => $incomeTax,
            'deductions' => $deductionsTotal,
            'type' => $payment['type'],
            'workingDays' => $payment['workingDays'],
            'ordinaryTimeHours' => $payment['ordinaryTimeHours'],
            'net' => $net
        );
    }
    
    public function calcWorkerCCSS($accrued) {
        return $accrued * 0.105;
    }
    
    public function calcIncomeTax($accrued) {
        $ordinaryMonthly = $accrued * 2;
        if ($ordinaryMonthly > 1226000) {
            $incomeTax = (($ordinaryMonthly - 1226000) * 0.15) / 2;
        } else if ($ordinaryMonthly > 817000) {
            $incomeTax = (($ordinaryMonthly - 817000) * 0.10) / 2;
        } else {
            $incomeTax = 0;
        }
        
        return $incomeTax;
    }

    public function getMonthlyPayroll($payments) {
        $monthlyPayroll = array();
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $payment) {
            $calculatedPayment = $this->calcPayment($payment);

            $employee = $employeeBusiness->getWithDeleted($payment['idEmployee']);
            $key = $this->employeeCardExistOnPayroll($employee['card'], $monthlyPayroll);
            if ($key == -1) {
                $calculatedPayment['card'] = $employee['card'];
                $calculatedPayment['completeName'] = $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'];
                $calculatedPayment['bankAccount'] = $employee['bankAccount'];
                $calculatedPayment['observations'][0]['fortnight'] = $payment['fortnight'];
                $calculatedPayment['observations'][0]['text'] = $payment['observations'] ? $payment['observations'] : null;

                array_push($monthlyPayroll, $calculatedPayment);
            } else {
                $monthlyPayroll[$key]['net'] += $calculatedPayment['net'];
                $monthlyPayroll[$key]['workingDays'] += $calculatedPayment['workingDays'];
                $monthlyPayroll[$key]['ordinaryTimeHours'] += $calculatedPayment['ordinaryTimeHours'];
                $monthlyPayroll[$key]['observations'][1]['fortnight'] = $payment['fortnight'];
                $monthlyPayroll[$key]['observations'][1]['text'] = $payment['observations'] ? $payment['observations'] : null;
            }
        }

        return $monthlyPayroll;
    }
    
    public function getProvisionReport($payments) {
        $provisionReport = array();

        foreach ($payments as $payment) {
            $calculatedPayment = $this->calcPayment($payment);

            $key = $this->locationExistOnPayroll($payment['location'], $provisionReport);
            if ($key == -1) {
                array_push($provisionReport, array(
                    'location' => $payment['location'],
                    'salary' => $calculatedPayment['net'],
                    'ccss' => $calculatedPayment['net'] * 0.2633,
                    'bonus' => $calculatedPayment['net'] * 0.0833,
                    'vacations' => $calculatedPayment['net'] * 0.0416,
                    'unemployment' => $calculatedPayment['net'] * 0.0833,
                    'pt' => $calculatedPayment['net'] * 0.0475,
                    'total' => $calculatedPayment['net'] * 0.519
                ));
            } else {
                $provisionReport[$key]['salary'] += $calculatedPayment['net'];
                $provisionReport[$key]['ccss'] = $provisionReport[$key]['salary'] * 0.2633;
                $provisionReport[$key]['bonus'] = $provisionReport[$key]['salary'] * 0.0833;
                $provisionReport[$key]['vacations'] = $provisionReport[$key]['salary'] * 0.0416;
                $provisionReport[$key]['unemployment'] = $provisionReport[$key]['salary'] * 0.0833;
                $provisionReport[$key]['pt'] = $provisionReport[$key]['salary'] * 0.0475;
                $provisionReport[$key]['total'] = $provisionReport[$key]['salary'] * 0.519;
            }
        }

        return $provisionReport;
    }
    
    public function getDetailProvisionReport($payments) {
        $provisionReport = array();
        $employeeBusiness = new EmployeeBusiness();

        foreach ($payments as $payment) {
            $calculatedPayment = $this->calcPayment($payment);

            $employee = $employeeBusiness->getWithDeleted($payment['idEmployee']);
            $key = $this->employeeCardExistOnPayroll($employee['card'], $provisionReport);
            if ($key == -1) {
                array_push($provisionReport, array(
                    'card' => $employee['card'],
                    'completeName' => $employee['firstLastName'] . ' ' . $employee['secondLastName'] . ' ' . $employee['name'],
                    'location' => $payment['location'],
                    'salary' => $calculatedPayment['net'],
                    'ccss' => $calculatedPayment['net'] * 0.2633,
                    'bonus' => $calculatedPayment['net'] * 0.0833,
                    'vacations' => $calculatedPayment['net'] * 0.0416,
                    'unemployment' => $calculatedPayment['net'] * 0.0833,
                    'pt' => $calculatedPayment['net'] * 0.0475,
                    'total' => $calculatedPayment['net'] * 0.519
                ));
            } else {
                $provisionReport[$key]['salary'] += $calculatedPayment['net'];
                $provisionReport[$key]['ccss'] = $provisionReport[$key]['salary'] * 0.2633;
                $provisionReport[$key]['bonus'] = $provisionReport[$key]['salary'] * 0.0833;
                $provisionReport[$key]['vacations'] = $provisionReport[$key]['salary'] * 0.0416;
                $provisionReport[$key]['unemployment'] = $provisionReport[$key]['salary'] * 0.0833;
                $provisionReport[$key]['pt'] = $provisionReport[$key]['salary'] * 0.0475;
                $provisionReport[$key]['total'] = $provisionReport[$key]['salary'] * 0.519;
            }
        }

        return $provisionReport;
    }

    private function employeeCardExistOnPayroll($card, $payrolls) {
        foreach ($payrolls as $key => $payroll) {
            if ($payroll['card'] == $card) {
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
