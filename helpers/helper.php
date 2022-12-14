<?php
class Helper{
    public static function deleteSession($name){
        if (isset($_SESSION[$name])) {
            $_SESSION[$name]=null;
        }
        return $name;
    }

    public static function isAdmin(){
        if (!isset($_SESSION['admin'])) {
            header("Location:".base_url);
        }else {
            return true;
        }
    }

    public static function isLogged(){
        if (!isset($_SESSION['user'])) {
            header("Location:".base_url);
        }else {
            return true;
        }
    }

    public static function showCate(){
        require_once 'models/Categoria.php';
        $cat=new Categoria();
        $categorias=$cat->getAll();
        return $categorias;
    }

    public static function statsCarrito(){
        $stats=array(
            'productos'=> 0,
            'total'=>0
        );
        if (isset($_SESSION['carrito'])) {
            $stats['productos']=count($_SESSION['carrito']);
           foreach ($_SESSION['carrito'] as $producto) {
               $stats['total']+=$producto['precio']*$producto['unidad'];
           }
        }

        return $stats;
    }

    public static function showstatus($status){
        switch ($status) {
            case 'preparation':
                $status='En preparacion';
                break;
            case 'ready':
                $status='Preparado para envio';
                break;
            case 'sended':
                $status='Enviado';
                break;
            default:
                $status='Pendiente';
                break;
        }
        return $status;
    }
}
?>