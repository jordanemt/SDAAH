<?php

//require exceptions
require 'exceptions/ExceptionsHandler.php';
require 'exceptions/ControllerNotFoundException.php';
require 'exceptions/ActionNotFoundException.php';
require 'exceptions/DataBaseException.php';
require 'exceptions/AttributeConflictException.php';
require 'exceptions/EmptyAttributeException.php';
require 'exceptions/AssociatedException.php';
require 'exceptions/DuplicateCardException.php';
require 'exceptions/DuplicateCodException.php';
require 'exceptions/PasswordsMatchException.php';
require 'exceptions/AuthenticationFailedException.php';
require 'exceptions/LoadViewException.php';
new ExceptionsHandler();

//require common
require 'common/Util.php';
require 'common/Filters.php';
require 'common/Config.php';
require 'common/Session.php';

//view control
require 'presentation/View.php';

//frontcontroller
$config = Config::singleton();
$config->set('controllerFolder', 'presentation/controller/');
$config->set('viewFolder', 'presentation/view/');

//pdo
$config->set('dbhost', 'localhost');
$config->set('dbname', 'sdaah');
$config->set('dbuser', 'root');
$config->set('dbpass', '');

//produccion
//$config->set('dbuser', 'sdaah_db');
//$config->set('dbpass', '&bT%4F6wpBYs');

//set default timezone
date_default_timezone_set('America/Costa_Rica');