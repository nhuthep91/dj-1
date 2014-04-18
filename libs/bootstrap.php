<?php

class Libs_Bootstrap
{

    public function __construct()
    {
        $this->delegate();
    }

    public function paserUrl(&$controllers, &$action, &$modules)
    {
        $modules = "index";
        $controllers = 'index';
        $action = 'index';
        if (isset($_GET['url'])) {
            $arr_url = explode('/', rtrim($_GET['url'], '/'));
            $modules = isset($arr_url[0]) ? $arr_url[0] : $modules;
            $controllers = isset($arr_url[1]) ? $arr_url[1] : $controllers;
            $action = isset($arr_url[2]) ? $arr_url[2] : $action;
            $pathFile = 'application/modules/' . $modules . '/controllers/' . $controllers . '.php';
            if (file_exists($pathFile)) {
                $modules = $modules;
                $controllers = $controllers;
                $action = $action;
            } else {
                $modules = "index";
                $controllers = 'index';
                $action = 'index';
            }
        }
    }

    public function delegate()
    {
        $this->paserUrl($controllers, $action, $modules);
        $class = "application_modules_" . $modules . "_controllers_" . $controllers;
        $classNew = substr($class, 20,100);
        $controllers = new $classNew();
        $controllers->$action();
    }

}

?>