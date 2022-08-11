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
        $productos=$this->db->query($sql);
        if ($productos) {
            return $productos;
        }else {
            return false;
        }
    }

    public function getForId(){
        $sql="Select * from pedidos where id={$this->getId()}";
        $producto=$this->db->query($sql);
        if ($producto) {
            return $producto->fetch_object();
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


}
?>