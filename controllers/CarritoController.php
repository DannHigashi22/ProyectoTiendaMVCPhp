<?php
require_once 'models/Producto.php';
class CarritoController{
    public function index(){
        $carrito=$_SESSION['carrito'];
        require_once 'views/carrito/index.phtml';
    }

    public function add(){
        if (isset($_GET['id'])) {
            $producto_id=$_GET['id'];
        }else {
            header("location:".base_url);
        }
        if (isset($_SESSION['carrito'])) {
            $counter=0;
            foreach ($_SESSION['carrito'] as $indice => $valor) {
                if($valor['id_producto']==$producto_id){
                    $_SESSION['carrito'][$indice]['unidad']++;
                    $counter++;
                }
            }
        }
        if(!isset($counter) || $counter==0) {
            //conseguir producto
            $producto=new Producto();
            $producto->setId($producto_id);
            $producto=$producto->getForId();
            //añadir al carrito
            if (is_object($producto)) {
                $_SESSION['carrito'][]=array(
                    "id_producto"=>$producto->id,
                    "precio"=>$producto->precio,
                    "unidad"=>1,
                    "producto"=>$producto
                );    
            }
            
        }
        header("location:".base_url."carrito/index");
    }

    public function remove(){
        if (isset($_GET['index'])) {
            $index=$_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("location:".base_url."carrito/index");
    }

    public function up(){
        if (isset($_GET['index'])) {
            $index=$_GET['index'];
            $_SESSION['carrito'][$index]['unidad']++;
        }
        header("location:".base_url."carrito/index");
    }

    public function down(){
        if (isset($_GET['index'])) {
            $index=$_GET['index'];
            $_SESSION['carrito'][$index]['unidad']--;
            if ($_SESSION['carrito'][$index]['unidad']==0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("location:".base_url."carrito/index");
    }

    public function delete_all(){
        if(isset($_SESSION['carrito'])){
            $_SESSION['carrito']=null;
        }
        header("location:".base_url."carrito/index");

    }
}
?>