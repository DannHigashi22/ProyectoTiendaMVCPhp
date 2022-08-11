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
        require_once 'views/pedido/complete.phtml';
    }

}


?>