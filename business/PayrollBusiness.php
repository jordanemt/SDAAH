<?php

require_once 'data/PayrollData.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/EmployeeBusiness.php';
require_once 'exceptions/AttributeConflictException.php';
require_once 'exceptions/EmptyAttributeException.php';

class PayrollBusiness {

    private $data;

    function __construct() {
        $this->data = new PayrollData();
    }

    public function get($id) {
        return $this->data->get($id);
    }

    public function getAll() {
        return $this->data->getAll();
    }

    public function getAllByFilter($filter) {
        if (empty($filter['location']) ||
                empty($filter['fortnight']) ||
                empty($filter['year'])) {
            $filter = array(
                'location' => 'Administrativo|Operativo',
                'fortnight' => Util::getFortnight(),
                'year' => date('Y')
            );
        }
        
        $_SESSION['location'] = $filter['location'];
        $_SESSION['fortnight'] = $filter['fortnight'];
        $_SESSION['year'] = $filter['year'];
        
        return $this->data->getAllByFilter($filter);
    }

    public function insert($entity) {
        //Valid empties
        if (empty($entity['idEmployee']) ||
                empty($entity['location']) ||
                empty($entity['fortnight']) ||
                empty($entity['year']) ||
                empty($entity['type']) ||
                empty($entity['salary']) ||
                (empty($entity['workingDays']) && empty($entity['ordinaryTimeHours']))) {
            throw new EmptyAttributeException();
        }

        //Valid lentch
        if (strlen($entity['location']) > 14 ||
                strlen($entity['type']) > 7) {
            throw new AttributeConflictException();
        }

        $this->data->insert($entity);
    }

//    public function update($entity) {
//        //Valid empties
//        if (empty($entity['id']) ||
//                empty($entity['cod']) ||
//                empty($entity['name']) ||
//                empty($entity['type']) ||
//                empty($entity['salary'])) {
//            throw new EmptyAttributeException();
//        }
//
//        //Valid lentch
//        if (strlen($entity['cod']) !== 4 ||
//                strlen($entity['name']) > 25 ||
//                ($entity['type'] != 'Mensual' && $entity['type'] != 'Diario')) {
//            throw new AttributeConflictException();
//        }
//
//        $oldEntity = $this->data->get($entity['id']);
//        if ($entity['cod'] != $oldEntity['cod']) {
//            $this->validDuplicateCod($entity['cod']);
//        }
//
//        $this->data->update($entity);
//    }

    public function remove($id) {
        $this->data->remove($id);
    }

    public function calcBiweeklyPayroll($payrolls) {
        $employeeBusiness = new EmployeeBusiness();
        $deductionBusiness = new DeductionBusiness();

        $biweeklyPayroll = array();
        foreach ($payrolls as $payroll) {
            $type = $payroll['type'];
            $ordinarySalary = ($type == 'Mensual') ? ($payroll['salary'] / 30) : $payroll['salary'];
            $extraTime = ($type == 'Mensual') ? ($ordinarySalary / 8) * 1.5 : $ordinarySalary * 1.5;
            $doubleTime = ($type == 'Mensual') ? ($ordinarySalary / 8) * 2 : $ordinarySalary * 2;

            $ordinary = ($payroll['type'] == 'Mensual') ? $ordinarySalary * $payroll['workingDays'] : $ordinarySalary * $payroll['ordinaryTimeHours'];
            $extra = (float) ($extraTime * $payroll['extraTimeHours']);
            $double = (float) ($doubleTime * $payroll['doubleTimeHours']);

            $accrued = (
                    $ordinary +
                    $extra +
                    $double +
                    floatval($payroll['vacationAmount']) +
                    floatval($payroll['salaryBonus']) +
                    floatval($payroll['incentives']) +
                    floatval($payroll['surcharges']) +
                    floatval($payroll['maternityAmount'])
                    );

            $workerCss = $accrued * 0.105;

            $ordinaryMonthly = $accrued * 2;
            if ($ordinaryMonthly > 1226000) {
                $incomeTax = (($ordinaryMonthly - 1226000) * 0.15) / 2;
            } else if ($ordinaryMonthly > 817000) {
                $incomeTax = (($ordinaryMonthly - 817000) * 0.10) / 2;
            } else {
                $incomeTax = 0;
            }

            $deductions = $deductionBusiness->getAllByIdPayroll($payroll['id']);
            $deductionsTotal = 0;
            foreach ($deductions as $deduction) {
                $deductionsTotal += floatval($deduction['mount']);
            }

            $deductionsTotal += $workerCss + $incomeTax;

            $net = $accrued - $deductionsTotal + floatval($payroll['ccssAmount']) + floatval($payroll['insAmount']);

            $employee = $employeeBusiness->get($payroll['idEmployee']);

            array_push($biweeklyPayroll, array(
                'id' => $payroll['id'],
                'completeName' => $employee['name'] . ' ' . $employee['firstLastName'] . ' ' . $employee['secondLastName'],
                'ordinary' => $ordinary,
                'vacation' => $payroll['vacationAmount'],
                'extra' => $extra,
                'double' => $double,
                'surcharges' => $payroll['surcharges'],
                'accrued' => $accrued,
                'workerCss' => $workerCss,
                'incomeTax' => $incomeTax,
                'deductions' => $deductionsTotal,
                'net' => $net
            ));
        }

        return $biweeklyPayroll;
    }

}
