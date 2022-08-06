<?php
class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
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

    public function getCategoria_id(){
        return $this->categoria_id;
    }
    public function setCategoria_id($categoria_id){
        $this->categoria_id=$categoria_id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion=$this->db->real_escape_string($descripcion);
    }

    public function getPrecio(){
        return $this->precio;
    }
    public function setPrecio($precio){
        $this->precio=$this->db->real_escape_string($precio);
    }

    public function getStock(){
        return $this->stock;
    }
    public function setStock($stock){
        $this->stock=$this->db->real_escape_string($stock);
    }

    public function getOferta(){
        return $this->oferta;
    }
    public function setOferta($oferta){
        $this->oferta=$oferta;
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha=$fecha;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen=$imagen;
    }

    public function getAll(){
        $sql="Select * from productos order by id desc";
        $productos=$this->db->query($sql);
        if ($productos) {
            return $productos;
        }else {
            return false;
        }
    }

    public function getAllByCat(){
        $sql="Select p.*, c.nombre as categoria_name from productos p 
        INNER JOIN categorias c ON c.id= p.categoria_id where categoria_id={$this->getCategoria_id()} 
        order by p.id desc";
        $productos=$this->db->query($sql);
        if ($productos) {
            return $productos;
        }else {
            return false;
        }
    }

    public function getRand($limit){
        $sql="Select * from productos order by rand() limit $limit";
        $productos=$this->db->query($sql);
        if ($productos) {
            return $productos;
        }else {
            return false;
        }
    }

    public function createProduct(){
        $sql="Insert INTO productos Values(null,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},null,curdate(),'{$this->getImagen()}')";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
          $res=true;  
        }
        return $res;
    }

    public function delete(){
        $sql="delete from productos where id={$this->getId()};";
        $delete=$this->db->query($sql);
        if ($delete) {
            return true;
        }else {
            return false;
        }
    }

    public function update(){
        $sql="Update productos SET categoria_id={$this->getCategoria_id()},nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio={$this->getPrecio()},stock={$this->getStock()}";
        if ($this->getImagen()!= null) {
            $sql.=",imagen='{$this->getImagen()}'";
        }
        $sql.=" where id={$this->getId()}";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
          $res=true;  
        }
        return $res;
    }

    public function getForId(){
        $sql="Select * from productos where id={$this->getId()}";
        $producto=$this->db->query($sql);
        if ($producto) {
            return $producto->fetch_object();
        }else {
            return false;
        }
    }


}





?>