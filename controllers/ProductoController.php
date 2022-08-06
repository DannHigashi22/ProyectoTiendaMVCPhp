<?php
require_once 'models/producto.php';
class ProductoController{
    public function index(){
        $producto =new Producto();
        $productos=$producto->getRand(6);
        require_once 'views/producto/destacado.phtml';
    }

    public function product(){
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $producto=new Producto();
            $producto->setId($id);
            $producto=$producto->getForId();
            require_once 'views/producto/product.phtml';
        }
    }

    public function gestion(){
        Helper::isAdmin();
        $producto =new Producto();
        $productos=$producto->getAll();

        require_once 'views/producto/gestion.phtml';
    }

    public function create(){
        Helper::isAdmin();
        require_once 'views/producto/create.phtml';
    }

    public function insert(){
        Helper::isAdmin();
        if (isset($_POST)) {
            $categoria_id=isset($_POST['categoria'])?(int)$_POST['categoria']:false;
            $nombre=isset($_POST['nombre'])?$_POST['nombre']:false;
            $descripcion=isset($_POST['descripcion'])?$_POST['descripcion']:false;
            $precio=isset($_POST['precio'])?(int)$_POST['precio']:false;
            $stock=isset($_POST['stock'])?(int)$_POST['stock']:false;
            
            //if ($categoria_id || preg_match("/[A-Z]a-Z/",$categoria_id)):
            if ($nombre && $descripcion && $categoria_id && $precio && $stock) {
                $producto=new Producto();
                $producto->setCategoria_id($categoria_id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                //guardar imagen
                if (isset($_FILES['imagen'])) {
                    $file=$_FILES['imagen'];
                    $file_name=$file['name'];
                    $type=$file['type'];
                    if ($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images',0777,true);
                        }
                        move_uploaded_file($file['tmp_name'],'uploads/images/'.$file_name);
                        $producto->setImagen($file_name);
                    }
                }
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    $producto->setId($id);
                    $save=$producto->update();
                }else {
                    $save=$producto->createProduct();
                }
                if ($save) {
                    $_SESSION['producto']="Registrado completamente";
                }else {
                    $_SESSION['producto']="failed";
                }
            }else {
                $_SESSION['producto']="valores incorrectos";
            }
        }else {
            $_SESSION['producto']="No se ha realizado ninguna accion";
        }
        header("Location:".base_url."producto/gestion");
    }

    public function edit(){
        Helper::IsAdmin();
        if (isset($_GET['id'])) {
            $edit=true;
            $id=$_GET['id'];
            $producto=new Producto();
            $producto->setId($id);
            $prod=$producto->getForId();
            require_once 'views/producto/create.phtml';
        }else {
            header("location:".base_url."producto/gestion");
        }
    }

    public function delete(){
        Helper::isAdmin();
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $producto=new Producto();
            $producto->setId($id);
            $delete=$producto->delete();
            if ($delete) {
                $_SESSION['producto']="Producto eliminado Correctamente";
            }else {
                $_SESSION['producto']="Producto no eliminado";
            }
        }else {
            $_SESSION['producto']="failed";
        }
        header("location:".base_url."producto/gestion");
    }
}


?>