<?php

class Producto {
    
    private $producto;
    private $db;

    public function __construct() {
        $this->producto = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3308;dbname=pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getProductos() {

        self::setNames();
        $sql = "SELECT id, nombre, precio FROM producto";
        foreach ($this->db->query($sql) as $res) {
            $this->producto[] = $res;
        }
        return $this->producto;
    }

    public function setProducto($nombre, $precio) {

        self::setNames();
        $sql = "INSERT INTO producto(nombre, precio) VALUES ('" . $nombre . "', '" . $precio . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>