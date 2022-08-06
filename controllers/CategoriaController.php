<?php
require_once 'models/Categoria.php';
require_once "models/Producto.php";
class CategoriaController{
    public function index(){
        Helper::isAdmin();
        $cat=new Categoria();
        $categorias=$cat->getAll();
        require_once "views/categoria/index.phtml";
    }

    public function read(){
        if (isset($_GET['id'])) {
            $id_cat=$_GET['id'];
            $categoria=new Categoria();
            $categoria->setId($id_cat);
            $Bycategoria=$categoria->getOne();

            $ProductByCat=new Producto();
            $ProductByCat->setCategoria_id($id_cat);
            $ProductByCat=$ProductByCat->getAllByCat();
        }
        
        require_once "views/categoria/category.phtml";
    }

    public function create(){
        Helper::isAdmin();
        require_once "views/categoria/create.phtml";
    }

    public function save(){
        Helper::isAdmin();
        if ($_POST) {
            $nombre=isset($_POST['nombre'])?$_POST['nombre'] :false;
            
            $errores=array();
            if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $errores['nombre']="El nombre no es valido";
            }
            if (count($errores)==0) {
                $newCat=new Categoria();
                $newCat->setNombre($nombre);
                
                $save=$newCat->createCat();
                if ($save) {
                    $_SESSION['categoria']='Categoria registrada correctamente ';
                }else {
                    $_SESSION['categoria']="Fallo al registrar categoria";
                }

            }else {
                $_SESSION['errores']=$errores;
            }
        
        }
        header("Location:".base_url."categoria/create");
    }
}


?>