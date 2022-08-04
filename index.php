<?php
//controlador frontal
session_start();

require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
require_once 'helpers/helper.php';
require_once 'views/layout/header.phtml';
require_once 'views/layout/sidebar.phtml';

function show_error(){
    $error=new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $nameController=$_GET['controller'].'Controller';
}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nameController=controller_default;
}else{
    show_error();
    //exit();
}
if (@class_exists($nameController)) {
    $controlador =new $nameController();

    if (isset($_GET['action']) && method_exists($controlador,$_GET['action'])) {
        $action=$_GET['action'];
        $controlador->$action();
    }elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action=action_default;
        $controlador->$action();
    }else {
        show_error();
        //trigger_error('404 ERROR ACTION',E_USER_NOTICE);
    }

}else{
    show_error();   
}
require_once 'views/layout/footer.phtml';


?>