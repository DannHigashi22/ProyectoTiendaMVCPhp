<?php
class Categoria {
    private $id;
    private $nombre;
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

    public function getAll(){
        $sql="select * from categorias ORDER BY id desc;";
        $categorias=$this->db->query($sql);

        return $categorias;
    }

    public function createCat(){
        $sql="Insert INTO categorias Values(null,'{$this->getNombre()}');";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
          $res=true;  
        }
        return $res;
    }

}

?>