<?php

class Util {

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
        return round(((date('z') + 1) / 365) * 24);
    }

    public static function getSelectFortnightOptions() {
        $fortnight = $_SESSION['fortnight'];

        $str = '';
        for ($i = 1; $i < 25; $i++) {
            $str = $str . '<option ' . (($i == $fortnight) ? 'selected' : '') . ' value="' . $i . '">Q-' . $i . '</option>\n';
        }

        return $str;
    }

    public static function getSelectYearOptions() {
        $year = $_SESSION['year'];
        $end = intval(date('Y')) + 6;

        $str = '';
        for ($i = 2000; $i < $end; $i++) {
            $str = $str . '<option ' . (($i == $year) ? 'selected' : '') . ' value="' . $i . '">' . $i . '</option>\n';
        }

        return $str;
    }
    
    public static function getSelectLocationOptions() {
        $location = $_SESSION['location'];

        $str = '';
        $str = $str . '<option ' . (($location == 'Administrativo|Operativo') ? 'selected' : '') . ' value="Administrativo|Operativo">Todas</option>\n';
        $str = $str . '<option ' . (($location == 'Administrativo') ? 'selected' : '') . ' value="Administrativo">Administrativo</option>\n';
        $str = $str . '<option ' . (($location == 'Operativo') ? 'selected' : '') . ' value="Operativo">Operativo</option>\n';

        return $str;
    }

}
