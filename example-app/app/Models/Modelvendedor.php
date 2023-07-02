<?php

class Vendedor {
    
    private $vendedor;
    private $db;

    public function __construct() {
        $this->vendedor = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3308;dbname=db_pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getVendedores() {

        self::setNames();
        $sql = "SELECT id, nombre, precio FROM vendedor";
        foreach ($this->db->query($sql) as $res) {
            $this->vendedor[] = $res;
        }
        return $this->vendedor;
    }

    public function setvendedor($nombre, $precio) {

        self::setNames();
        $sql = "INSERT INTO vendedor(nombre, precio) VALUES ('" . $nombre . "', '" . $precio . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>