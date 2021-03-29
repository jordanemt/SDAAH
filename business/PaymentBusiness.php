<?php

require_once 'data/PaymentData.php';
require_once 'business/EmployeeBusiness.php';
require_once 'business/PositionBusiness.php';
require_once 'business/ParamBusiness.php';
require_once 'business/DeductionBusiness.php';
require_once 'business/IncomeTaxBusiness.php';

class PaymentBusiness {

    private $data;

    function __construct() {
        $this->data = new PaymentData();
    }

    public function get($id) {
        $payment = $this->data->get($id);

        $employeeBusiness = new EmployeeBusiness();
        $deductionBusiness = new DeductionBusiness();
        $positionBusiness = new PositionBusiness();
        $payment['employee'] = $employeeBusiness->get($payment['idEmployee']);
        $payment['employee']['position'] = $positionBusiness->get($payment['employee']['idPosition']);
        $payment['deductions'] = $deductionBusiness->getAllByIdPayment($payment['id']);

        return $payment;
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
        $payments = $this->data->getAllOnBonusByYearByIdEmployee($year, $idEmployee);

        $employeeBusiness = new EmployeeBusiness();
        $deductionBusiness = new DeductionBusiness();
        foreach ($payments as $key => $payment) {
            $payments[$key]['employee'] = $employeeBusiness->get($payment['idEmployee']);
            $payments[$key]['deductions'] = $deductionBusiness->getAllByIdPayment($payment['id']);
        }

        return $payments;
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
        
        $this->calcPayment($entity);
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

        $this->calcPayment($entity);
        $this->data->update($entity);
    }

    public function remove($id) {
        $this->data->remove($id);
    }

    public function calcPayment(&$payment) {
        if (empty($payment)) {
            return 0;
        }
        
        $type = $payment['type'];
        $hourSalary = ($type == 'Mensual') ? ($payment['salary'] / 30) : $payment['salary'];
        $extraTime = ($type == 'Mensual') ? ($hourSalary / 8) * 1.5 : $hourSalary * 1.5;
        $doubleTime = ($type == 'Mensual') ? ($hourSalary / 8) * 2 : $hourSalary * 2;

        $ordinary = ($payment['type'] == 'Mensual') ? $hourSalary * $payment['workingDays'] : $hourSalary * $payment['ordinaryTimeHours'];
        $extra = ($extraTime * $payment['extraTimeHours']);
        $double = ($doubleTime * $payment['doubleTimeHours']);

        $accrued = (
                $ordinary +
                $extra +
                $double +
                $payment['vacationAmount'] +
                $payment['salaryBonus'] +
                $payment['incentives'] +
                $payment['surcharges'] +
                $payment['maternityAmount']
                );

        $workerCss = $this->calcWorkerCCSS($accrued);
        $incomeTax = $this->calcIncomeTax($accrued);

        $deductionsTotal = 0;
        if (!empty($payment['deductionsMounts'])) {
            foreach ($payment['deductionsMounts'] as $deductionMount) {
            $deductionsTotal += $deductionMount;
        }

        }
        $deductionsTotal += $workerCss + $incomeTax;

        $net = $accrued - $deductionsTotal + floatval($payment['ccssAmount']) + floatval($payment['insAmount']);
        
        if ($net < 0.0) {
            $net = 0.0;
        }

        $payment['ordinary'] = $ordinary;
        $payment['extra'] = $extra;
        $payment['double'] = $double;
        $payment['gross'] = $accrued;
        $payment['workerCCSS'] = $workerCss;
        $payment['incomeTax'] = $incomeTax;
        $payment['deductionsTotal'] = $deductionsTotal;
        $payment['net'] = $net;
    }
    
    public function calcWorkerCCSS($accrued) {
        $paramBusiness = new ParamBusiness();
        $param = $paramBusiness->get(1);
        $pr = $param['percentage'] / 100;
        return $accrued * $pr;
    }
    
    public function calcIncomeTax($accrued) {
        $incomeTaxBusiness = new IncomeTaxBusiness();
        $taxes = $incomeTaxBusiness->getAll(); //ord taxes
        
        $ordinaryMonthly = $accrued * 2;
        $incomeTax = 0;
        $excess = 0; //calc the excess if is needed
        
        foreach ($taxes as $key => $tax) {
            if ($ordinaryMonthly > $tax['section']) { //over excess
                $incomeTax = (($ordinaryMonthly - $tax['section']) * ($tax['percentage'] / 100));
            } else {
                break;
            }
            
            if ($key > 0) { //sum excess
                $preKey = $key - 1;
                $currentExcess = ($tax['section'] - $taxes[$preKey]['section']) * ($taxes[$preKey]['percentage'] / 100);
                $excess += $currentExcess;
            }
        }
        
        return ($incomeTax + $excess) / 2;
    }

}
