<?php

class SPDO extends PDO {

    private static $instance;

    public function __construct() {
        $config = Config::singleton();
//       parent::__construct('mysql:host='.$config->get('dbhost').';dbname='.$config->get('dbname'),
//               $config->get('dbuser'), $config->get('dbpass'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'),
                $config->get('dbuser'));
    }

    public static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
