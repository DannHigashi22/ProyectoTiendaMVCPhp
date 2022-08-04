<?php
function app_autoload($classname){
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('app_autoload');
?>