<?php

class View {

    public function show($viewName, $vars = array()) {
        $config = Config::singleton();
        $path = $config->get('viewFolder') . $viewName;

        if (!is_file($path)) {
            throw new LoadViewException();
        }
        
        include $path;
    }

}
