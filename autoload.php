<?php
function app_autoload($classname){
    require_once 'controllers/'.$classname.'.php';
}

spl_autoload_register('app_autoload');
?>