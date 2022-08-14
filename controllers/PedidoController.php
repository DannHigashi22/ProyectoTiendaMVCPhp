<?php
require_once 'models/Pedido.php';
class PedidoController{
    public function add(){
        require_once 'views/pedido/add.phtml';
    }

    public function create(){
        if(isset($_SESSION['user'])){
            //Guardar Pedido
            $ciudad=isset($_POST['ciudad'])?$_POST['ciudad']:false;
            $comuna=isset($_POST['comuna'])?$_POST['comuna']:false;
            $direccion=isset($_POST['direccion'])?$_POST['direccion']:false;
            $coste=Helper::statsCarrito();
            if ($ciudad && $comuna && $direccion) {
                $newP=new Pedido();
                $newP->setUsuario_id($_SESSION['user']->id);
                $newP->setCiudad($ciudad);
                $newP->setComuna($comuna);
                $newP->setDireccion($direccion);
                $newP->setCoste($coste['total']);

                $save=$newP->createPedido();

                //Guardar destalle pedido
                $save_detalle=$newP->createDetalle();

                if ($save && $save_detalle) {
                    $_SESSION['pedido']='Complete';
                }else {
                    $_SESSION['pedido']='Failed';
                }

            }
            header("location:".base_url."pedido/complete");
        }else {
            //Redirigir
            header("location:".base_url);
        }

    }

    public function complete(){
        if (isset($_SESSION['user'])) {
            $usuario_id=$_SESSION['user']->id;
            $pedido=new Pedido();
            $pedido->setUsuario_id($usuario_id);
            
            $lastPedido=$pedido->getLastUser();
            $detallePedido=$pedido->getOrderDetalle($lastPedido->id);
            Helper::deleteSession('carrito');
        }
        
        require_once 'views/pedido/complete.phtml';
    }

    public function myOrders(){
        Helper::isLogged();
        $usuario_id=$_SESSION['user']->id;
        $pedidos=new Pedido();
        $pedidos->setUsuario_id($usuario_id);
        $pedidos=$pedidos->getAllByUser();
        require_once 'views/pedido/orders.phtml';
    }

    public function detail(){
        Helper::isLogged();
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $pedido=new Pedido();
            $pedido->setId($id);
            
            $detallePedido=$pedido->getOrderDetalle($id);
            $pedido=$pedido->getForId();
            if ($detallePedido && $pedido) {
                require_once 'views/pedido/detail.phtml';
            }else {
                header("location:".base_url.'Error/index');
            }
            
        }else{
            header("location:".base_url."pedido/myOrders");
        }

        
    }

    public function gestion(){
        Helper::isAdmin();
        $gestion=true;
        $pedidos=new Pedido();
        $pedidos=$pedidos->getAll();
        require_once 'views/pedido/orders.phtml';
    }

    public function status(){
        Helper::isAdmin();
        if (isset($_POST)) {
            $pedido_id=isset($_POST['pedido_id'])?$_POST['pedido_id']:false;
            $estado=isset($_POST['estado'])?$_POST['estado']:false;
            //update del pedido
            $pedidoStatus=new Pedido();
            $pedidoStatus->setId($pedido_id);
            $pedidoStatus->setEstado($estado);
            $pedidoStatus->updateOne();

        }
        header("location:".base_url."pedido/gestion");
    }

}


?>