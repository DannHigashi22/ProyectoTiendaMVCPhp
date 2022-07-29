<?php
class Helper{
    public static function deleteSession($name){
        if (isset($_SESSION[$name])) {
            $_SESSION[$name]=null;
        }
        return $name;
    }

}
?>