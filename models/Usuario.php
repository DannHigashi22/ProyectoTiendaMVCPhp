<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $pass;
    private $rol;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db=Database::connect();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }

    public function getApellidos(){
        return $this->apellidos;
    }
    public function setApellidos($apellidos){
        $this->apellidos=$this->db->real_escape_string($apellidos);
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$this->db->real_escape_string($email);
    }

    public function getPass(){
        return $this->pass;
    }
    public function setPass($pass){
        $this->pass=password_hash($this->db->real_escape_string($pass),PASSWORD_BCRYPT,['cost'=>4]);
    }

    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol=$rol;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen=$imagen;
    }

    public function createUser(){
        $sql="Insert INTO usuarios Values(null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPass()}','user',null)";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
          $res=true;  
        }
        return $res;
    }
}

?>