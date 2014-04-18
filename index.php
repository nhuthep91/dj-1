<?php
session_start();
ob_start();
include_once"configs/db.php";
include_once"configs/path.php";
function __autoLoad($class = '')
{
    if ($class == '')
        return FALSE;
    $file = strtolower(str_replace('_', '/', $class)) . '.php';
    $pos = strpos($file, "bootstrap");
    $pos2 = strpos($file, "libs");
    if ($pos !== false || $pos2 !== false) {
        
    } else {
        $file = "application/modules/" . $file;
    }
    @include_once"$file";
}
new Libs_Bootstrap();
?>