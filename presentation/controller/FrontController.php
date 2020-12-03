<?php

class FrontController {

    static function main() {
        require 'presentation/View.php';
        require 'common/configuration.php';

        if (!empty($_GET['controller'])) {
            $controllerName = $_GET['controller'] . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }

        if (!empty($_GET['action'])) {
            $actionName = $_GET['action'];
        } else {
            $actionName = 'index';
        }

        $rutaControlador = $config->get('controllerFolder') . $controllerName . '.php';

        if (is_file($rutaControlador)) {
            require $rutaControlador;
        } else {
            die('Controller not found - 404 not found');
        }

        if (is_callable(array($controllerName, $actionName)) == FALSE) {
            trigger_error($controllerName . '->' . $actionName . ' does not exist', E_USER_NOTICE);
            return FALSE;
        }
        $controller = new $controllerName();
        $controller->$actionName();
    }

}
