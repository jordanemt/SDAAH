<?php

class Filters {

    public static function getFloat() {
        return array(
            'filter' => FILTER_CALLBACK,
            'options' => function ($input) {
                $filtered = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                return $filtered ? $filtered : 0;
            });
    }

    public static function getInt() {
        return array(
            'filter' => FILTER_CALLBACK,
            'options' => function ($input) {
                $filtered = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                return $filtered ? $filtered : 0;
            });
    }

    public static function getString() {
        return array(
            'filter' => FILTER_CALLBACK,
            'options' => function ($input) {
                $filtered = filter_var($input, FILTER_SANITIZE_STRING);
                return $filtered ? $filtered : "";
            });
    }

    public static function getEmail() {
        return array(
            'filter' => FILTER_CALLBACK,
            'options' => function ($input) {
                $filtered = filter_var($input, FILTER_SANITIZE_EMAIL);
                return $filtered ? $filtered : "";
            });
    }

}
