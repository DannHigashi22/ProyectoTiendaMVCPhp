<?php
//controlador frontal
require_once 'autoload.php';
require_once 'views/layout/header.phtml';
require_once 'views/layout/sidebar.phtml';

if (isset($_GET['controller'])) {
    $nameController=$_GET['controller'].'Controller';
}else {
    echo '404 website';
    exit();
}
if (@class_exists($nameController)) {
    $controlador =new $nameController();

    if (isset($_GET['action']) && method_exists($controlador,$_GET['action'])) {
        $action=$_GET['action'];
        $controlador->$action();
    }else {
        echo "404 action";
        trigger_error('404 ERROR ACTION',E_USER_NOTICE);
    }

}else{
    echo "404 controllers";
    
}

require_once 'views/layout/footer.phtml';


?>