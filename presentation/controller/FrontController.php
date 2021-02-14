<?php

class FrontController {

    static function main() {
        require 'presentation/View.php';
        require 'common/configuration.php';
        require 'common/Util.php';
        require 'common/Filters.php';
        require 'exceptions/ExceptionsHandler.php';

        date_default_timezone_set('America/Costa_Rica');
        
        $url = parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'), PHP_URL_PATH);
        $urlTrim = trim($url, '/');
        $call = explode('/', $urlTrim);

        if (!empty($call[0])) {
            $controllerName = ucfirst($call[0]) . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }

        if (!empty($call[1])) {
            $actionName = $call[1];
        } else {
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
