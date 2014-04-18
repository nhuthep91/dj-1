<?php

/*
 * @Author:HoangDV
 * @Class Libs Views
 * @Since:20/3/2014
 * 
 */

class Libs_views {

    public $module = 'index';
    public $img;
    public $ary;
    public $aryPlug;

    /*
     * @Author:HoangDV
     * @Function: Construct
     * @Since:20/3/2014
     * 
     */

    function __construct() {
        $this->img = 'public/template/' . $this->module . '/images';
    }

    /*
     * @Author:HoangDV
     * @Function: Render to json
     * @Since:20/3/2014
     * 
     */

    function renderToJson($filename, $module = 'index') {
        $filename = 'application/modules/' . $module . '/views/' . $filename . '.php';
        if (is_file($filename)) {
            ob_start();
            @include $filename;
            return ob_get_clean();
        }
        return 'File is not found';
    }

    /*
     * @Author:HoangDV
     * @Function: Set layout
     * @Since:20/3/2014
     * 
     */

    function setLayOut($modules = 'index', $name) {
        $this->module = $modules;
        $this->img = 'public/template/' . $this->module . '/images';
        $fileName = "application/modules/" . $modules . "/views/$name.php";
        @require_once 'application/layout/masterlayout.php';
        @require_once'application/layout/' . $modules . '/top.php';
        if (is_file($fileName)) {
            @require_once"application/modules/" . $modules . "/views/$name.php";
        } else {
            return 'File is not found';
        }
        @require_once"application/layout/" . $modules . "/bottom.php";
    }

    /*
     * @Author:HoangDV
     * @Function: Load js to header
     * @Since:20/3/2014
     * 
     */

    function headScript($base = '') {
        if ($base == 'base') {
            $this->list_files('public/js');
            $arryFile = $this->ary;
            if ($arryFile == NULL)
                return false;
            foreach ($arryFile as $k => $v) {
                echo '<script type="text/javascript" src="' . PATH . '/public/js/' . $v . '"></script>';
            }
        } else {
            $this->list_files('public/template/' . $this->module . '/js');
            $arryFile = $this->ary;
            if ($arryFile == NULL)
                return false;
            $this->getJs($arryFile);
        }
    }

    /*
     * @Author:HoangDV
     * @Function: Get js
     * @Since:20/3/2014
     * 
     */

    public function getJs($arryFile) {
        foreach ($arryFile as $k => $v) {
            if (strpos($v, '.js') !== false) {
                echo '<script type="text/javascript" src="' . PATH . '/' . $v . '"></script>';
            }
        }
    }

    /*
     * @Author:HoangDV
     * @Function: Get css
     * @Since:20/3/2014
     * 
     */

    public function getCss($arryFile = array()) {
        if ($arryFile == NULL)
            return false;
        foreach ($arryFile as $k => $v) {
            if (strpos($v, '.css') !== false) {
                echo '<link rel="stylesheet" type="text/css" href="' . PATH . '/' . $v . '" /> ';
            }
        }
    }

    /*
     * @Author:HoangDV
     * @Function: Get css to header
     * @Since:20/3/2014
     * 
     */

    function headLink() {
        $this->list_files('public/template/' . $this->module . '/css');
        $arryFile = $this->ary;
        $this->getCss($arryFile);
    }

    /*
     * @Author:HoangDV
     * @Function: Load file
     * @Since:20/3/2014
     * 
     */

    function list_files($directory = '.') {
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    if (is_file($directory . '/' . $file)) {
                        if (strpos($file, '.css') !== false || strpos($file, '.js') !== false) {
                            if (strpos($directory, '.public/plugins') !== false) {
                                $this->ary[] = $directory . '/' . $file;
                            } else {
                                $this->aryPlug[] = $directory . '/' . $file;
                            }
                        }
                    } else {
                        $this->list_files($directory . '/' . $file);
                    }
                }
            }
            closedir($handle);
        }
    }

    /*
     * @Author:HoangDV
     * @Function: Get plugins
     * @Since:20/3/2014
     * 
     */

    public function getPlugin($dir = '') {
        if ($dir == '')
            $dir = 'public/plugins';
        $this->list_files($dir);
        $this->getJs($this->aryPlug);
        $this->getCss($this->aryPlug);
    }

}
