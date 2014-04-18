<?php

/**
 * Created by Hungpv.
 * User: Hungpv
 * Date: 25/03/2014
 * Time: 13:49
 */
class DatabaseProvider
{

    function createProvider($type = "")
    {

        if (!isset($type) || $type == "") {
            echo "string";
        }
        $array = explode("/", $type);
        $base = $array[0];
        $module = $array[1];

        $link = "application/modules/{$base}/model/{$module}.php";

        if (file_exists($link)) {
            require_once $link;
            $modelName = "{$base}_Model_{$module}";
            $provider = new $modelName();
            return $provider;
        }else{
            return "File not found!";
        }
    }
} 