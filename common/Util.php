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

    public static function getFilterOfMonth() {
        $aux = date('m') * 2;
        return ($aux - 1) . '|' . $aux;
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

    public static function getSelectMonthOptions() {
        $month = round($_SESSION['fortnight'] / 2);

        $str = '';
        $str = $str . '<option ' . (($month == 1) ? 'selected' : '') . ' value="1|2">Enero</option>\n';
        $str = $str . '<option ' . (($month == 2) ? 'selected' : '') . ' value="3|4">Febrero</option>\n';
        $str = $str . '<option ' . (($month == 3) ? 'selected' : '') . ' value="5|6">Marzo</option>\n';
        $str = $str . '<option ' . (($month == 4) ? 'selected' : '') . ' value="7|8">Abril</option>\n';
        $str = $str . '<option ' . (($month == 5) ? 'selected' : '') . ' value="9|10">Mayo</option>\n';
        $str = $str . '<option ' . (($month == 6) ? 'selected' : '') . ' value="11|12">Junio</option>\n';
        $str = $str . '<option ' . (($month == 7) ? 'selected' : '') . ' value="13|14">Julio</option>\n';
        $str = $str . '<option ' . (($month == 8) ? 'selected' : '') . ' value="15|16">Agosto</option>\n';
        $str = $str . '<option ' . (($month == 9) ? 'selected' : '') . ' value="17|18">Septiembre</option>\n';
        $str = $str . '<option ' . (($month == 10) ? 'selected' : '') . ' value="19|20">Octubre</option>\n';
        $str = $str . '<option ' . (($month == 11) ? 'selected' : '') . ' value="21|22">Noviembre</option>\n';
        $str = $str . '<option ' . (($month == 12) ? 'selected' : '') . ' value="23|24">Diciembre</option>\n';

        return $str;
    }

}
