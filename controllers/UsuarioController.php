<?php
require_once 'models/Usuario.php';
class UsuarioController{
    public function index(){
        echo 'Controlador usuario, accion index';
    }
    public function register(){
        require_once 'views/usuario/registro.phtml';
    }
    public function insert(){
        if (!empty($_POST)) {
            
            $usuario = new Usuario();
            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellidos($_POST['apellidos']);
            $usuario->setEmail($_POST['email']);
            $usuario->setPass($_POST['pass']);

            $save=$usuario->createUser();
            if ($save) {
                $_SESSION['registro']='complete';
            }else {
                $_SESSION['registro']='failed';
            }
             
        }else {
            $_SESSION['registro']="failed";
        }
        header('Location:'.base_url.'usuario/register');
    }


}


?>