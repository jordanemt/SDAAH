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

        //get related entities
        $payment['employee'] = $employeeBusiness->get($payment['idEmployee']);
        $payment['employee']['position'] = $positionBusiness->get($payment['employee']['idPosition']);
        $payment['deductions'] = $deductionBusiness->getAllByIdPayment($payment['id']);

        return $payment;
    }

    public function getAllByIdEmployeeAndFortnightAndYear($idEmployee, $fortnight, $year) {
        //Valid empty
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

    //get payments for the year from an employee (bonus)
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
        //Valid empty
        if (empty($entity['idEmployee']) ||
                empty($entity['position']) ||
                empty($entity['type']) ||
                empty($entity['salary']) ||
                empty($entity['location']) ||
                empty($entity['fortnight']) ||
                empty($entity['year'])) {
            throw new EmptyAttributeException();
        }

        //Valid attr
        if (($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                ($entity['type'] != 'Mensual' && $entity['type'] != 'Diario')) {
            throw new AttributeConflictException();
        }

        $this->calcPayment($entity);
        $this->data->insert($entity);
    }

    public function update($entity) {
        //Valid empty
        if (empty($entity['id']) ||
                empty($entity['idEmployee']) ||
                empty($entity['position']) ||
                empty($entity['type']) ||
                empty($entity['salary']) ||
                empty($entity['location']) ||
                empty($entity['fortnight']) ||
                empty($entity['year'])) {
            throw new EmptyAttributeException();
        }

        //Valid attr
        if (($entity['location'] != 'Administrativo' && $entity['location'] != 'Operativo') ||
                ($entity['type'] != 'Mensual' && $entity['type'] != 'Diario')) {
            throw new AttributeConflictException();
        }

        $this->calcPayment($entity);
        $this->data->update($entity);
    }

    public function remove($id) {
        //Valid empty
        if (empty($id)) {
            throw new EmptyAttributeException();
        }

        $this->data->remove($id);
    }

    public function calcPayment(&$payment) {
        if (empty($payment)) {
            return 0;
        }
        
        $this->setOrdinary($payment);
        $this->setDeductions($payment);
        $this->setNet($payment);
    }

    private function setOrdinary(&$payment) {
        $type = $payment['type'];
        $salary = ($type == 'Mensual') ? ($payment['salary'] / 30) : $payment['salary'];
        $extraTime = ($type == 'Mensual') ? ($salary / 8) * 1.5 : $salary * 1.5;
        $doubleTime = ($type == 'Mensual') ? ($salary / 8) * 2 : $salary * 2;

        $ordinary = ($type == 'Mensual') ? $salary * $payment['workingDays'] : $salary * $payment['ordinaryTimeHours'];
        $extra = ($extraTime * $payment['extraTimeHours']);
        $double = ($doubleTime * $payment['doubleTimeHours']);

        $gross = ($ordinary +
                $extra +
                $double +
                $payment['vacationAmount'] +
                $payment['salaryBonus'] +
                $payment['incentives'] +
                $payment['surcharges'] +
                $payment['maternityAmount']
                );

        $payment['ordinary'] = $ordinary;
        $payment['extra'] = $extra;
        $payment['double'] = $double;
        $payment['gross'] = $gross;
    }

    private function setDeductions(&$payment) {
        $gross = $payment['gross'];

        $workerCss = $this->calcWorkerCCSS($gross);
        $incomeTax = $this->calcIncomeTax($gross);

        $deductionsTotal = 0;
        if (!empty($payment['deductionsMounts'])) {
            foreach ($payment['deductionsMounts'] as $deductionMount) {
                $deductionsTotal += $deductionMount;
            }
        }
        $deductionsTotal += $workerCss + $incomeTax;

        $payment['workerCCSS'] = $workerCss;
        $payment['incomeTax'] = $incomeTax;
        $payment['deductionsTotal'] = $deductionsTotal;
    }

    private function setNet(&$payment) {
        $gross = $payment['gross'];
        $deductionsTotal = $payment['deductionsTotal'];
        $ccssAmount = $payment['ccssAmount'];
        $insAmount = $payment['insAmount'];

        $net = $gross - $deductionsTotal + floatval($ccssAmount) + floatval($insAmount);

        if ($net < 0.0) {
            $net = 0.0;
        }

        $payment['net'] = $net;
    }

    public function calcWorkerCCSS($accrued) {
        $paramBusiness = new ParamBusiness();
        $param = $paramBusiness->get(1);
        $pr = $param['percentage'] / 100;
        return $accrued * $pr;
    }

    public function calcIncomeTax($gross) {
        $incomeTaxBusiness = new IncomeTaxBusiness();
        $taxes = $incomeTaxBusiness->getAll(); //ordered taxes ASC

        $ordinaryMonthly = $gross * 2;//assume monthly salary
        $incomeTax = 0;
        $excess = 0; //calc the excess if is needed

        foreach ($taxes as $key => $tax) {
            if ($ordinaryMonthly > $tax['section']) { //over excess
                $difference = ($ordinaryMonthly - $tax['section']);
                $rate = ($tax['percentage'] / 100);
                
                $incomeTax = ($difference * $rate);
            } else {//taxes is ordered, don't need more test
                break;
            }

            if ($key > 0) { //need sum excess
                $preKey = $key - 1;
                $previusTax = $taxes[$preKey];
                
                $difference = ($tax['section'] - $previusTax['section']);
                $rate = ($previusTax['percentage'] / 100);
                $currentExcess = ($difference * $rate);
                
                $excess += $currentExcess;
            }
        }

        return ($incomeTax + $excess) / 2;
    }

}
