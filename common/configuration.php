<?php
require 'Config.php';

//frontcontroller_pattern
$config = Config::singleton();
$config->set('controllerFolder', 'presentation/controller/');
$config->set('viewFolder', 'presentation/view/');

//pdo
$config->set('dbhost', 'localhost');
$config->set('dbname', 'sdaah');
$config->set('dbuser', 'root');
$config->set('dbpass', '');