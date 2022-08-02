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
        if (isset($_POST)) {
            $nombre=isset($_POST['nombre'])?$_POST['nombre']:false;
            $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:false;
            $email=isset($_POST['email'])?$_POST['email']:false;
            $pass=isset($_POST['pass'])?$_POST['pass']:false;

            $errores=array();
            if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $errores['nombre']="El nombre no es valido";
            }
            if(empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/",$apellidos)){
                $errores['apellidos']="Los apellidos no son validos";
            }
            if(empty($email) && !FILTER_VAR($email,FILTER_VALIDATE_EMAIL)){
                $errores['email']="El correo no es valido";
            }
            if(empty($pass)) {
              $errores['pass']="La contraseña esta vacia";  
            }

            if (count($errores)==0) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPass($pass);

                $save=$usuario->createUser();
                if ($save) {
                    $_SESSION['registro']='Se ha registrado Completamente';
                }else {
                    $_SESSION['registro']='failed';
                }
            }else {
                $_SESSION['errores']=$errores;
            }
        }else {
            $_SESSION['registro']="failed";
        }
        header('Location:'.base_url.'usuario/register');
    }

    public function login(){
        if (isset($_POST)) {
            //identificar al usuario
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            //consulta a la db
            $usuario=new Usuario();
            $usuario->setEmail($email);
            $usuario->setPass($pass);
            $identity=$usuario->loginUser();

            //crear session
            if ($identity && is_object($identity)) {
                $_SESSION['user']=$identity;
                if ($identity->rol== 'admin') {
                    $_SESSION['admin']=true;
                }
            }else{
                $_SESSION['login']="Identificacion Fallida, ingrese datos nuevamente.";
            } 
        }
        header("location:".base_url);
    }

    public function logout(){
        if (isset($_SESSION['user'])) {
            $_SESSION['user']=null;
        }
        if (isset($_SESSION['admin'])) {
            $_SESSION['admin']=null;
        }
        header("location:".base_url);
    }
}


?>