<?php
class Pedido{
    private $id;
    private $usuario_id;
    private $ciudad;
    private $comuna;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
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

    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }

    public function getCiudad(){
        return $this->ciudad;
    }
    public function setCiudad($ciudad){
        $this->ciudad=$this->db->real_escape_string($ciudad);
    }

    public function getComuna(){
        return $this->comuna;
    }
    public function setComuna($comuna){
        $this->comuna=$this->db->real_escape_string($comuna);
    }

    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($direccion){
        $this->direccion=$this->db->real_escape_string($direccion);
    }

    public function getCoste(){
        return $this->coste;
    }
    public function setCoste($coste){
        $this->coste=$coste;
    }

    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        $this->estado=$estado;
    }

    public function getAll(){
        $sql="Select * from pedidos order by id desc";
        $pedido=$this->db->query($sql);
        if ($pedido) {
            return $pedido;
        }else {
            return false;
        }
    }

    public function getAllByUser(){
        $sql="Select * from pedidos where usuario_id={$this->getUsuario_id()} order by id desc";
        $pedido=$this->db->query($sql);
        if ($pedido) {
            return $pedido;
        }else {
            return false;
        }
    }

    public function getForId(){
        $sql="Select * from pedidos where id={$this->getId()}";
        $pedido=$this->db->query($sql);
        if ($pedido) {
            return $pedido->fetch_object();
        }else {
            return false;
        }
    }

    public function getLastUser(){
        $sql="Select p.id,p.coste from pedidos p where p.usuario_id={$this->getUsuario_id()} order by id desc limit 1";
        $pedido=$this->db->query($sql);
        if ($pedido) {
            return $pedido->fetch_object();
        }else {
            return false;
        }
    }

    public function getOrderDetalle($id){
        $sql="SELECT p.*, dp.unidades from productos p inner join detalle_pedido dp ON p.id=dp.producto_id where dp.pedido_id=$id;";
        $detalleP=$this->db->query($sql);
        if ($detalleP) {
            return $detalleP;
        }else {
            return false;
        }
    }


    public function createPedido(){
        $sql="Insert INTO pedidos Values(null,{$this->getUsuario_id()},'{$this->getCiudad()}','{$this->getComuna()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',curdate(),curtime())";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
          $res=true;  
        }
        return $res;
    }

    public function createDetalle(){
        $sql="SELECT LAST_INSERT_ID() as 'pedido_id'";
        $query=$this->db->query($sql);
        $pedido_id=$query->fetch_object()->pedido_id;

        foreach ($_SESSION['carrito'] as $producto){
            $sql="INSERT INTO detalle_pedido Values(null,$pedido_id,{$producto['id_producto']},{$producto['unidad']});";
            $save=$this->db->query($sql);
        }
        if ($save) {
            return true;
        }else {
            return false;
        }
        
    }

    public function updateOne(){
        $sql="UPDATE pedidos SET estado='{$this->getEstado()}' where id={$this->getId()}";
        $save=$this->db->query($sql);
        $res=false;
        if ($save) {
            return true;
        }else {
            return false;
        }
    }


}
?>