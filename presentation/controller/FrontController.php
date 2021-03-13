<?php

class FrontController {

    static function main() {
        require 'presentation/View.php';
        require 'common/configuration.php';
        require 'common/Util.php';
        require 'common/Filters.php';
        require 'exceptions/ExceptionsHandler.php';

        date_default_timezone_set('America/Costa_Rica');
        
        $controllerName = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING);
        $actionName = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

        if (!empty($controllerName)) {
            $controllerName = ucfirst($controllerName) . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }

        if (empty($actionName)) {
            $actionName = 'index';
        }

        $config = Config::singleton();
        $rutaControlador = $config->get('controllerFolder') . $controllerName . '.php';

        if (is_file($rutaControlador)) {
            require_once $rutaControlador;
        } else {
            die('Controller not found - 404 not found');
        }

        if (is_callable(array($controllerName, $actionName)) == FALSE) {
            trigger_error($controllerName . '->' . $actionName . ' does not exist', E_USER_NOTICE);
            return FALSE;
        }

        new ExceptionsHandler();
        $controller = new $controllerName();
        $controller->{$actionName}();
    }

}
