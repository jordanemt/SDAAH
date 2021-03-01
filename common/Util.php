<?php

class Util {

    const MONTHLY = 2;
    const BEWEEKLY = 1;

    public static function existOnSomeKey($array, $evaluate, $key) {
        foreach ($array as $keyArray => $value) {
            if ($value[$key] == $evaluate[$key]) {
                return $keyArray;
            }
        }

        return -1;
    }

    public static function getExtraTime($salary, $type) {
        $hourTime = ($type == 'Mensual') ? ($salary / 30) / 8 : $salary;
        $value = ((float) $hourTime) * 1.5;

        return number_format($value, 10, '.', '');
    }

    public static function getDoubleTime($salary, $type) {
        $hourTime = ($type == 'Mensual') ? ($salary / 30) / 8 : $salary;
        $value = ((float) $hourTime) * 2;

        return number_format($value, 10, '.', '');
    }

    public static function getFortnight() {
        return ceil(((date('z') + 1) / 365) * 24);
    }

    public static function restToCurrentFortnight($toRest, &$year = null) {
        $year = date('Y');
        $number = self::getFortnight() - $toRest;

        if ($number < 0) {
            $year -= intdiv(24 - $number, 24);
            return 24 + $number;
        }
        
        $year += intdiv($number, 24);
        $mod = $number % 24;

        if ($mod == 0) {
            $year -= 1;
            return 24;
        }

        return $mod;
    }

    public static function getSanitazeFilter($filter, $selector) {
        $filter['location'] = !empty($filter['location']) ? $filter['location'] : 'Administrativo|Operativo';
        $filter['year'] = !empty($filter['year']) ? $filter['year'] : date('Y');

        $_SESSION['location'] = $filter['location'];
        $_SESSION['year'] = $filter['year'];

        switch ($selector) {
            case self::MONTHLY:
                $filter['month'] = !empty($filter['month']) ? $filter['month'] : date('m');
                $_SESSION['month'] = $filter['month'];
                break;

            case self::BEWEEKLY:
                $filter['fortnight'] = !empty($filter['fortnight']) ? $filter['fortnight'] : self::getFortnight();
                $_SESSION['fortnight'] = $filter['fortnight'];
                break;
        }

        return $filter;
    }

    public static function getSelectFortnightOptions($fortnight = null) {
        if (empty($fortnight)) {
            $fortnight = $_SESSION['fortnight'];
        }

        $str = '';
        for ($i = 1; $i < 25; $i++) {
            $str = $str . '<option ' . (($i == $fortnight) ? 'selected' : '') . ' value="' . $i . '">Q-' . $i . '</option>\n';
        }

        return $str;
    }

    public static function getSelectYearOptions($year = null) {
        if (empty($year)) {
            $year = $_SESSION['year'];
        }
        $end = intval(date('Y')) + 6;

        $str = '';
        for ($i = 2000; $i < $end; $i++) {
            $str = $str . '<option ' . (($i == $year) ? 'selected' : '') . ' value="' . $i . '">' . $i . '</option>\n';
        }

        return $str;
    }

    public static function getSelectLocationOptions($location = null) {
        if (empty($location)) {
            $location = $_SESSION['location'];
        }

        $str = '';
        $str = $str . '<option ' . (($location == 'Administrativo|Operativo') ? 'selected' : '') . ' value="Administrativo|Operativo">Todas</option>\n';
        $str = $str . '<option ' . (($location == 'Administrativo') ? 'selected' : '') . ' value="Administrativo">Administrativo</option>\n';
        $str = $str . '<option ' . (($location == 'Operativo') ? 'selected' : '') . ' value="Operativo">Operativo</option>\n';

        return $str;
    }

    public static function getSelectMonthOptions($month = null) {
        if (empty($month)) {
            $month = $_SESSION['month'];
        }

        $str = '';
        $str = $str . '<option ' . (($month == 1) ? 'selected' : '') . ' value="1">Enero</option>\n';
        $str = $str . '<option ' . (($month == 2) ? 'selected' : '') . ' value="2">Febrero</option>\n';
        $str = $str . '<option ' . (($month == 3) ? 'selected' : '') . ' value="3">Marzo</option>\n';
        $str = $str . '<option ' . (($month == 4) ? 'selected' : '') . ' value="4">Abril</option>\n';
        $str = $str . '<option ' . (($month == 5) ? 'selected' : '') . ' value="5">Mayo</option>\n';
        $str = $str . '<option ' . (($month == 6) ? 'selected' : '') . ' value="6">Junio</option>\n';
        $str = $str . '<option ' . (($month == 7) ? 'selected' : '') . ' value="7">Julio</option>\n';
        $str = $str . '<option ' . (($month == 8) ? 'selected' : '') . ' value="8">Agosto</option>\n';
        $str = $str . '<option ' . (($month == 9) ? 'selected' : '') . ' value="9">Septiembre</option>\n';
        $str = $str . '<option ' . (($month == 10) ? 'selected' : '') . ' value="10">Octubre</option>\n';
        $str = $str . '<option ' . (($month == 11) ? 'selected' : '') . ' value="11">Noviembre</option>\n';
        $str = $str . '<option ' . (($month == 12) ? 'selected' : '') . ' value="12">Diciembre</option>\n';

        return $str;
    }

}
