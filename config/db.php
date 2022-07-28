<?php
class Database{
    public static function connect(){
        $db=new Mysqli("localhost","root","","tienda_master",3307);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}


?>