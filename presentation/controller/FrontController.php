<?php

class FrontController {

    static function main() {
        require 'common/configuration.php';
        
        $controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        
        $controllerName = $controller ? ucfirst($controller) . 'Controller' : 'IndexController';
        $actionName = $action ? $action : 'index';

        $config = Config::singleton();
        $controllerFile = $config->get('controllerFolder') . $controllerName . '.php';

        if (!is_file($controllerFile)) {
            throw new ControllerNotFoundException();
        }
        
        require_once $controllerFile;

        if (!is_callable(array($controllerName, $actionName))) {
            throw new ActionNotFoundException();
        }
        
        $controllerClass = new $controllerName();
        $controllerClass->{$actionName}();
    }

}
